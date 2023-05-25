<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use Carbon\Carbon;
use App\Models\Club;
use App\Models\Fixture;

class FootballController extends Controller
{
    // ...

    public function updateDataFromAPI()
    {
        // Llama a la API para obtener la información de los equipos y los partidos
        $standingsResponse = Http::withoutVerifying()->withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => '2fb875568bmshfcc6ad0212f01bap1f3d03jsn2e47b3f1d929'
        ])->get('https://api-football-v1.p.rapidapi.com/v3/standings', [
            'league' => '265',
            'season' => '2023'
        ]);

        $fixturesResponse = Http::withoutVerifying()->withHeaders([
            'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
            'X-RapidAPI-Key' => '2fb875568bmshfcc6ad0212f01bap1f3d03jsn2e47b3f1d929'
        ])->get('https://api-football-v1.p.rapidapi.com/v3/fixtures', [
            'league' => 265,
            'season' => 2023,
        ]);

        $apiTeamsData = isset($standingsResponse->json()['response']) ? $standingsResponse->json()['response'][0]['league']['standings'][0] : [];
        $apiFixturesData = isset($fixturesResponse->json()['response']) ? $fixturesResponse->json()['response'] : [];

        // Actualiza la información de los equipos en la base de datos
        foreach ($apiTeamsData as $teamData) {
            Club::updateOrCreate(
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
            $date = Carbon::createFromFormat('Y-m-d\TH:i:sP', $fixtureData['fixture']['date']);

            Fixture::updateOrCreate(
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
}
