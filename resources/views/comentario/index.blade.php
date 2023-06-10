@extends('comentario')

@section('contentt')

<div class="row justify-content-center align-items-center g-2">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <br><br>
        <h3>Lista de comentarios</h3>
        <br>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
            Nuevo
        </button>
        <br>
        <div class="table-responsive">
            <br>
            <table class="table">
                <thead bg-dark text-white>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Mejora</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comentarios as $comentario)
                    <tr>
                        <td scope="row">{{$comentario->id}}</td>
                        <td>{{$comentario->nombre}}</td>
                        <td>{{$comentario->descripcion}}</td>
                        <td>{{$comentario->mejora}}</td>
                        <td>
                            @if($comentario->user_id == Auth::id())
                                <!-- Mostrar botones de edición y eliminación -->

                                <div class="col">
                                <button type="button" class="btn btn-success col-12" data-toggle="modal"
                                    data-target="#edit{{$comentario->id}}">
                                    Editar
                                </button>

                                <button type="button" class="btn btn-danger col-12" data-toggle="modal"
                                    data-target="#delete{{$comentario->id}}">
                                    Eliminar
                                </button>

                                </div>
                            @else
                                <!-- Mostrar mensaje indicando que el comentario es de otro usuario -->
                                <span>Este comentario pertenece a otro usuario</span>
                            @endif
                        </td>
                    </tr>
                    @include('comentario.info')
                    @endforeach
                </tbody>
            </table>
        </div>

        @include('comentario.modal')
    </div>
    <div class="col-md-2"></div>
</div>

@endsection
