@extends('layouts.app')
@section('title', 'Información de Inscripción')
@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center bg-light py-4">
    <div class="card shadow-lg border-0" style="max-width: 420px; width: 100%; border-radius: 1rem;">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <div class="bg-info p-3 rounded-circle d-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-white" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 14v-2a4 4 0 10-8 0v2H6v6h12v-6h-2zM12 2a5 5 0 00-5 5h2a3 3 0 016 0h2a5 5 0 00-5-5z"/>
                    </svg>
                </div>
                <h4 class="mt-3 mb-1 text-info fw-bold">Información de Inscripción</h4>
                <p class="text-muted small">Estos son tus datos de inscripción como profesor</p>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('profesor.informacion-inscripcion.pdf') }}" class="btn btn-outline-danger btn-sm" target="_blank">
                    <i class="bx bxs-file-pdf"></i> Exportar a PDF
                </a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Nombre:</strong> {{ $profesor->nombre }}</li>
                <li class="list-group-item"><strong>Correo:</strong> {{ $profesor->email }}</li>
                <li class="list-group-item"><strong>Teléfono:</strong> {{ $profesor->telefono }}</li>
                <li class="list-group-item"><strong>Especialidad:</strong> {{ $profesor->especialidad }}</li>
                <li class="list-group-item"><strong>Sucursal:</strong> {{ $profesor->sucursal->nombre ?? '-' }}</li>
                <li class="list-group-item"><strong>Nivel:</strong> {{ $profesor->nivel->nombre ?? '-' }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection 