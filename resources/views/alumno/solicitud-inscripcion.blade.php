@extends('layouts.app')
@section('content')
    @if(Auth::user()->alumno)
        <div class="alert alert-warning mt-4 text-center">
            Ya estás inscrito. No puedes enviar otra solicitud.
        </div>
    @else
        @include('alumno.solicitud-inscripcion-form', [
            'sucursales' => $sucursales,
            'cursos' => $cursos,
            'niveles' => $niveles,
            'user' => $user
        ])
    @endif
@endsection 