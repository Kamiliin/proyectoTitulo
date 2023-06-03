@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')


<div class="container mt-5">
        <h1>Tabla de Estadios</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Stadium Image</th>
                    <th>Club</th>
                    <th>Logo</th>
                    <th>Fundado</th>
                    <th>Nombre Estadio</th>
                    <th>Dirección estadio</th>
                    <th>Cuidad</th>
                    <th>Capacidad</th>
               
                </tr>
            </thead>
            <tbody>
                @foreach ($stadiums as $stadium)
                    <tr>
                    <td><img src="{{ $stadium->stadium_image }}" alt="Logo" width="150" height="150"></td>

                        <td>{{ $stadium->name_club }}</td>
                        <td><img src="{{ $stadium->logo_club }}" alt="Logo" width="70" height="70"></td>
                        <td>{{ $stadium->founded_club }}</td>
                        <td>{{ $stadium->stadium_name }}</td>
                        <td>{{ $stadium->stadium_address }}</td>
                        <td>{{ $stadium->stadium_city }}</td>
                        <td>{{ $stadium->stadium_capacity }}</td>
                     
                    </tr>
                @endforeach
            </tbody>
        </table> 
    </div>



@endsection
