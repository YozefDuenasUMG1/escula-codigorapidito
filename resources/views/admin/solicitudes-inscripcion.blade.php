@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Solicitudes de Inscripción</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Número</th>
                <th>Dirección</th>
                <th>Sucursal</th>
                <th>Rol</th>
                <th>Curso</th>
                <th>Nivel</th>
                <th>Especialidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id }}</td>
                    <td>{{ $solicitud->nombre }}</td>
                    <td>{{ $solicitud->email }}</td>
                    <td>{{ $solicitud->numero }}</td>
                    <td>{{ $solicitud->direccion }}</td>
                    <td>{{ $solicitud->sucursal->nombre ?? $solicitud->id_sucursal }}</td>
                    <td>
                        @if($solicitud->curso && $solicitud->nivel)
                            Alumno
                        @else
                            Profesor
                        @endif
                    </td>
                    <td>{{ $solicitud->curso->nombre ?? $solicitud->id_curso }}</td>
                    <td>{{ $solicitud->nivel->nombre ?? $solicitud->id_nivel }}</td>
                    <td>{{ $solicitud->especialidad ?? '-' }}</td>
                    <td>{{ ucfirst($solicitud->estado) }}</td>
                    <td>
                        @if($solicitud->estado === 'pendiente')
                        <form action="{{ route('solicitudes-inscripcion.aceptar', $solicitud->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                        </form>
                        @else
                        <span class="text-success">Inscrito</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $solicitudes->links() }}
</div>
@endsection 