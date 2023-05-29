<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; 

use Carbon\Carbon;
use App\Models\Club;
use App\Models\Fixture;
use App\Models\Stadium;
use App\Models\Player;


class FootballController extends Controller
{
   

    public function updateDataFromAPI()
    {
        $standingsResponse = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY')
        ])->get('https://api-football-v1.p.rapidapi.com/v3/standings', [
            'league' => '265',
            'season' => '2023'
        ]);

        $fixturesResponse = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY')
        ])->get('https://api-football-v1.p.rapidapi.com/v3/fixtures', [
            'league' => 265,
            'season' => 2023,
        ]);

        $stadiumResponse = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY')
        ])->get('https://api-football-v1.p.rapidapi.com/v3/teams', [
            'league' => 265,
            'season' => 2023,
        ]);


        $playersResponse = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY')
        ])->get('https://api-football-v1.p.rapidapi.com/v3/players', [
            'league' => '265',
            'season' => '2023'
        ]);



        $apiTeamsData = isset($standingsResponse->json()['response']) ? $standingsResponse->json()['response'][0]['league']['standings'][0] : [];
        $apiFixturesData = isset($fixturesResponse->json()['response']) ? $fixturesResponse->json()['response'] : [];
        $apiStadiumData = isset($stadiumResponse->json()['response']) ? $stadiumResponse->json()['response']: [];
        $apiPlayersData = isset($playersResponse->json()['response']) ? $playersResponse->json()['response'] : [];


        // Actualiza la información de los equipos en la base de datos
        foreach ($apiTeamsData as $teamData) {
            Club::firstOrCreate(
                ['api_id' => $teamData['team']['id']],
                [
                    'name' => $teamData['team']['name'],
                    'logo' => $teamData['team']['logo'],
                    'rank' => $teamData['rank'],
                    'points' => $teamData['points'],
                    'goals_diff' => $teamData['goalsDiff'],
                    'played' => $teamData['all']['played'],
                    'win' => $teamData['all']['win'],
                    'draw' => $teamData['all']['draw'],
                    'lose' => $teamData['all']['lose'],
                ]
            );
        }

        // Actualiza la información de los partidos en la base de datos
        foreach ($apiFixturesData as $fixtureData) {
            //$date = Carbon::parse($fixtureData['fixture']['date'])->format('Y-m-d H:i:s');
            $date = Carbon::createFromFormat('Y-m-d\TH:i:sP', $fixtureData['fixture']['date']);

            Fixture::firstOrCreate(
                ['api_id' => $fixtureData['fixture']['id']],
                [
                    'home_team_name' => $fixtureData['teams']['home']['name'],
                    'home_team_logo' => $fixtureData['teams']['home']['logo'],
                    'away_team_name' => $fixtureData['teams']['away']['name'],
                    'away_team_logo' => $fixtureData['teams']['away']['logo'],
                    'date' => $date,
                    'status' => $fixtureData['fixture']['status']['short'],
                    'venue' => $fixtureData['fixture']['venue']['name'],
                ]
            );
        }


         // Actualiza la información de los equipos en la base de datos
         foreach ($apiStadiumData as $StadiumData) {
            Stadium::firstOrCreate(
                ['api_id' => $StadiumData['team']['id']],
                [
                    'name_club' => $StadiumData['team']['name'],
                    'logo_club' => $StadiumData['team']['logo'],
                    'founded_club' => $StadiumData['team']['founded'],
                    'country_club' => $StadiumData['team']['country'],
                    'stadium_name' => $StadiumData['venue']['name'],
                    'stadium_address' => $StadiumData['venue']['address'],
                    'stadium_city' => $StadiumData['venue']['city'],
                    'stadium_capacity' => $StadiumData['venue']['capacity'],
                    'stadium_image' => $StadiumData['venue']['image'],
                ]
            );
        }


        
        // Actualiza la información de los jugadores en la base de datos
        foreach ($apiPlayersData as $playerData) {
            Player::updateOrCreate(
                ['api_id' => $playerData['player']['id']],
                [
                    'player_firstname' => $playerData['player']['firstname'],
                    'player_lastname' => $playerData['player']['lastname'],
                    'player_age' => $playerData['player']['age'],
                    'player_birthdate' => $playerData['player']['birth']['date'],
                    'player_countryorigin' => $playerData['player']['birth']['country'],
                    'player_nationality' => $playerData['player']['nationality'],
                    'player_height' => (int) $playerData['player']['height'],
                    'player_weight' => (int) $playerData['player']['weight'],
                    'player_photo' => $playerData['player']['photo'],
                    'player_nameclub' => isset($playerData['statistics'][0]['team']['name']) ? $playerData['statistics'][0]['team']['name'] : '',
                    'player_logoclub' => isset($playerData['statistics'][0]['team']['logo']) ? $playerData['statistics'][0]['team']['logo'] : '',                      'player_position' => $playerData['statistics'][0]['position'] ?? '',
                    'player_position' => isset($playerData['statistics'][0]['position']) ? $playerData['statistics'][0]['position'] : '',
                    'player_captain' => $playerData['statistics'][0]['games']['captain'] ?? false,
                    'player_goals' => isset($playerData['statistics']['goals']['total']) ? $playerData['statistics']['goals']['total'] : 0,
                    'player_goalsassists' => isset($playerData['statistics']['goals']['assists']) ? $playerData['statistics']['goals']['assists'] : 0,
                    'player_duels' => isset($playerData['statistics']['duels']['total']) ? $playerData['statistics']['duels']['total'] : 0,
                    'player_duelswin' => isset($playerData['statistics']['duels']['won']) ? $playerData['statistics']['duels']['won'] : 0,
                    'player_foulsdrawn' => isset($playerData['statistics']['fouls']['drawn']) ? $playerData['statistics']['fouls']['drawn'] : 0,
                    'player_foulscommitted' => isset($playerData['statistics']['fouls']['committed']) ? $playerData['statistics']['fouls']['committed'] : 0,
                    'player_yellow' => isset($playerData['statistics']['cards']['yellow']) ? $playerData['statistics']['cards']['yellow'] : 0,
                    'player_red' => isset($playerData['statistics']['cards']['red']) ? $playerData['statistics']['cards']['red'] : 0,
                    'player_penaltyscored' => isset($playerData['statistics']['penalty']['scored']) ? $playerData['statistics']['penalty']['scored'] : 0,
                    'player_penaltymissed' => isset($playerData['statistics']['penalty']['missed']) ? $playerData['statistics']['penalty']['missed'] : 0,
                    'player_penaltysaved' => isset($playerData['statistics']['penalty']['saved']) ? $playerData['statistics']['penalty']['saved'] : 0,
                ]
            );
        }

        return redirect()->back()->with('message', 'La información se ha actualizado correctamente');
    }

    public function getChileanClubs()
    {
        $data = Club::orderBy('rank')->get();

        return view('principal', ['clubs' => $data]);

    }


    public function getUpcomingMatches()
    {
        $fixtures = Fixture::where('date', '>=', date('Y-m-d H:i:s'))->orderBy('date')->get();
        return view('encuentros', ['matches' => $fixtures]);
    }


    public function getStadium()
    {
        $stadiums = Stadium::orderBy('name_club', 'asc')->get();
    
        return view('estadios', ['stadiums' => $stadiums]);
    }
    

    public function getPlayer()
    {
        $players = Player::orderBy('player_nameclub', 'asc')->get();
    
        return view('jugadores', ['players' => $players]);
    }



}