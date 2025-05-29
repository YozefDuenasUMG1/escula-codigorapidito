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
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $profesores->links() }}
</div>
@endsection 