@extends('layouts.app')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3>Bienvenido, {{ Auth::user()->name }}</h3>
                <p>Este es tu panel de alumno. Aquí puedes ver tus cursos, punteos y datos de inscripción.</p>
                <hr class="my-4">
                <h4>Mis cursos</h4>
                <ul>
                    @foreach($inscripciones as $inscripcion)
                        <li>{{ $inscripcion->curso->nombre ?? 'Sin curso' }}</li>
                    @endforeach
                </ul>
                <h4 class="mt-4">Mis punteos</h4>
                <ul>
                    @foreach($notas as $nota)
                        <li>{{ $nota->curso->nombre ?? 'Sin curso' }}: {{ $nota->valor }}</li>
                    @endforeach
                </ul>
                <h4 class="mt-4">Datos de inscripción</h4>
                <ul>
                    <li>Email: {{ Auth::user()->email }}</li>
                    <!-- Otros datos -->
                </ul>
                <div class="mt-4 alert alert-info">Recuerda revisar tus notas y comunicarte con tu profesor si tienes dudas.</div>
                @if(Auth::user()->role === 'alumno' && !Auth::user()->alumno)
                    <div class="alert alert-warning">
                        <strong>¿Aún no estás inscrito?</strong> Rellena este formulario para solicitar tu inscripción.
                    </div>
                    @include('alumno.solicitud-inscripcion-form', [
                        'sucursales' => \App\Models\Sucursal::all(),
                        'cursos' => \App\Models\Curso::all(),
                        'niveles' => \App\Models\Nivel::all(),
                    ])
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 