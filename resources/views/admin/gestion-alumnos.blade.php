@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Gestión de Alumnos</h2>
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
                <th>Rol</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->id_alumno }}</td>
                    <td>{{ $alumno->nombre }}</td>
                    <td>{{ $alumno->user->email ?? $alumno->email }}</td>
                    <td>{{ $alumno->user->role ?? '-' }}</td>
                    <td>{{ ($alumno->user && $alumno->user->active) ? 'Sí' : 'No' }}</td>
                    <td>
                        @if($alumno->user)
                        <form action="{{ route('alumnos.reset-password', $alumno->id_alumno) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Resetear contraseña</button>
                        </form>
                        <form action="{{ route('alumnos.toggle-active', $alumno->id_alumno) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm">{{ $alumno->user->active ? 'Desactivar' : 'Activar' }}</button>
                        </form>
                        <form action="{{ route('alumnos.destroy-admin', $alumno->id_alumno) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                        @else
                        <span class="text-danger">Sin usuario</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $alumnos->links() }}
</div>
@endsection 