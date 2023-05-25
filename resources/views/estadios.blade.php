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
                    <th>#</th>
                    <th>API ID</th>
                    <th>Rank</th>
                    <th>Club Name</th>
                    <th>Club Logo</th>
                    <th>Founded</th>
                    <th>Country</th>
                    <th>Stadium Name</th>
                    <th>Stadium Address</th>
                    <th>Stadium City</th>
                    <th>Stadium Capacity</th>
                    <th>Stadium Image</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stadiums as $stadium)
                    <tr>
                        <td>{{ $stadium->id }}</td>
                        <td>{{ $stadium->api_id }}</td>
                        <td>{{ $stadium->rank }}</td>
                        <td>{{ $stadium->name_club }}</td>
                        <td>{{ $stadium->logo_club }}</td>
                        <td>{{ $stadium->founded_club }}</td>
                        <td>{{ $stadium->country_club }}</td>
                        <td>{{ $stadium->stadium_name }}</td>
                        <td>{{ $stadium->stadium_address }}</td>
                        <td>{{ $stadium->stadium_city }}</td>
                        <td>{{ $stadium->stadium_capacity }}</td>
                        <td>{{ $stadium->stadium_image }}</td>
                        <td>{{ $stadium->created_at }}</td>
                        <td>{{ $stadium->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
