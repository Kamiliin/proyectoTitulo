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


class FootballController extends Controller
{
    // ...

    public function updateDataFromAPI()
    {
        // Llama a la API para obtener la información de los equipos y los partidos
        $standingsResponse = Http::withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY')
        ])->get('https://api-football-v1.p.rapidapi.com/v3/standings', [
            'league' => '265',
            'season' => '2023'
        ]);

        $fixturesResponse = Http::withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY')
        ])->get('https://api-football-v1.p.rapidapi.com/v3/fixtures', [
            'league' => 265,
            'season' => 2023,
        ]);

        $stadiumResponse = Http::withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY')
        ])->get('https://api-football-v1.p.rapidapi.com/v3/teams', [
            'league' => 265,
            'season' => 2023,
        ]);




        $apiTeamsData = isset($standingsResponse->json()['response']) ? $standingsResponse->json()['response'][0]['league']['standings'][0] : [];
        $apiFixturesData = isset($fixturesResponse->json()['response']) ? $fixturesResponse->json()['response'] : [];
        $apiStadiumData = isset($stadiumResponse->json()['response']) ? $stadiumResponse->json()['response']: [];


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
    
}
