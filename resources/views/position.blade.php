@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')



<div class="container mt-5">
    <h1>Tabla de Posiciones Liga Chilena 2023</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>N°</th>
                <th>Club</th>
                <th>Escudo</th>
                <th>Puntos</th>
                <th>Diferencia de Goles</th>
                <th>Partidos Jugados</th>
                <th>Partidos Ganados</th>
                <th>Partidos Empatados</th>
                <th>Partidos Perdidos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clubs as $club)
                <tr>
                    
                    <td>{{ $club->rank }}</td>
                    <td>{{ $club->name }}</td>
                    <td><img src="{{ $club->logo }}" alt="Logo" width="50" height="50"></td>
                    <td>{{ $club->points }}</td>
                    <td>{{ $club->goals_diff }}</td>
                    <td>{{ $club->played }}</td>
                    <td>{{ $club->win }}</td>
                    <td>{{ $club->draw }}</td>
                    <td>{{ $club->lose }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
