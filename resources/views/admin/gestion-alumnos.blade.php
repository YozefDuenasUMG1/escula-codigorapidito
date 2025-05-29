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
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $alumnos->links() }}
</div>
@endsection 