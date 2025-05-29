@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h3>Mis punteos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Curso</th>
                <th>Nivel</th>
                <th>Sucursal</th>
                <th>Punteo</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notas as $nota)
                <tr>
                    <td>{{ $nota->inscripcion->curso->nombre ?? 'Sin curso' }}</td>
                    <td>{{ $nota->inscripcion->nivel->nombre ?? 'Sin nivel' }}</td>
                    <td>{{ $nota->inscripcion->sucursal->nombre ?? 'Sin sucursal' }}</td>
                    <td>{{ $nota->punteo }}</td>
                    <td>{{ $nota->observacion }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No tienes punteos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection 