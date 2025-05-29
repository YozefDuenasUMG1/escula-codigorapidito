@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Gestión de Profesores</h2>
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
            @foreach($profesores as $profesor)
                <tr>
                    <td>{{ $profesor->id_profesor }}</td>
                    <td>{{ $profesor->nombre }}</td>
                    <td>{{ $profesor->user->email ?? $profesor->email }}</td>
                    <td>{{ $profesor->user->role ?? '-' }}</td>
                    <td>{{ ($profesor->user && $profesor->user->active) ? 'Sí' : 'No' }}</td>
                    <td>
                        @if($profesor->user)
                        <form action="{{ route('profesores.reset-password', $profesor->id_profesor) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Resetear contraseña</button>
                        </form>
                        <form action="{{ route('profesores.toggle-active', $profesor->id_profesor) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm">{{ $profesor->user->active ? 'Desactivar' : 'Activar' }}</button>
                        </form>
                        <form action="{{ route('profesores.destroy-admin', $profesor->id_profesor) }}" method="POST" style="display:inline-block;">
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
    {{ $profesores->links() }}
</div>
@endsection 