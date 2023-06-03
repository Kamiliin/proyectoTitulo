@php
$configData = Helper::appClasses();

@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
@php

@endphp



<div class="container mt-5">
    <h1>Datos de los Jugadores</h1>
    <table class="table table-striped">
        <thead>
            <tr>
            <th> foto</th>
                <th >Nombre</th>
                <th >Edad</th>
                <th>F. Nac.</th>
                <th>País</th>
                <th>Nal</th>
                <th>Alt.</th>
                <th>Peso</th>
                <th>Club</th>
                <th>Goles</th>
                <th>Asist.</th>
                <th>Duelos Tot.</th>
                <th>Duelos Gan.</th>
                <th>Faltas Rec.</th>
                <th>Faltas Com.</th>
                <th>T. Amar.</th>
                <th>T. Rojas</th>
                <th>P. Anot.</th>
                <th>P. Fall.</th>
                <th>P. Ataj.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
                <tr>
                    <td><img src="{{ $player->player_photo }}" alt="Logo" width="50" height="50"></td>

                    <td>{{ $player->player_firstname }} {{ $player->player_lastname }}</td>
                    <td>{{ $player->player_age }}</td>
                    <td>{{ $player->player_birthdate }}</td>
                    <td>{{ $player->player_countryorigin }}</td>
                    <td>{{ $player->player_nationality }}</td>
                    <td>{{ $player->player_height }}</td>
                    <td>{{ $player->player_weight }}</td>
                    <td>{{ $player->player_nameclub }}</td>
                    <td>{{ $player->player_goals }}</td>
                    <td>{{ $player->player_goalsassists }}</td>
                    <td>{{ $player->player_duels }}</td>
                    <td>{{ $player->player_duelswin }}</td>
                    <td>{{ $player->player_foulsdrawn }}</td>
                    <td>{{ $player->player_foulscommitted }}</td>
                    <td>{{ $player->player_yellow }}</td>
                    <td>{{ $player->player_red }}</td>
                    <td>{{ $player->player_penaltyscored }}</td>
                    <td>{{ $player->player_penaltymissed }}</td>
                    <td>{{ $player->player_penaltysaved }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
