@extends('layouts.app')
@section('title', 'Lista de Cursos')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">Lista de Cursos</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>ID Profesor</th>
                                <th>ID Nivel</th>
                                <th>Fecha de Creación</th>
                                <th>Última Actualización</th>
                                <th>Nivel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cursos as $curso)
                            <tr>
                                <td>{{ $curso->id_curso }}</td>
                                <td>{{ $curso->nombre }}</td>
                                <td>{{ $curso->descripcion }}</td>
                                <td>{{ $curso->id_profesor }}</td>
                                <td>{{ $curso->id_nivel }}</td>
                                <td>{{ $curso->created_at }}</td>
                                <td>{{ $curso->updated_at }}</td>
                                <td>{{ $curso->nivel->nombre ?? 'Sin nivel' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(method_exists($cursos, 'links'))
                        {{ $cursos->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 