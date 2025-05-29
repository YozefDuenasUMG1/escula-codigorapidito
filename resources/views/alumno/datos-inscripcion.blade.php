@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Datos de inscripción</h2>
    @if($alumno)
        <form action="{{ route('alumno.datos-inscripcion.pdf') }}" method="GET" class="mb-3">
            <button type="submit" class="btn btn-danger">Exportar PDF</button>
        </form>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nombre:</strong> {{ $alumno->nombre }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $alumno->email }}</li>
            <li class="list-group-item"><strong>Número:</strong> {{ $alumno->numero }}</li>
            <li class="list-group-item"><strong>Dirección:</strong> {{ $alumno->direccion }}</li>
            <li class="list-group-item"><strong>Sucursal:</strong> {{ $alumno->sucursal->nombre ?? $alumno->id_sucursal }}</li>
            <li class="list-group-item"><strong>Curso:</strong> {{ $alumno->curso->nombre ?? $alumno->id_curso }}</li>
            <li class="list-group-item"><strong>Nivel:</strong> {{ $alumno->nivel->nombre ?? $alumno->id_nivel }}</li>
        </ul>
    @else
        <div class="alert alert-warning mt-3">Aún no estás inscrito. Solicita tu inscripción desde el formulario correspondiente.</div>
    @endif
</div>
@endsection 