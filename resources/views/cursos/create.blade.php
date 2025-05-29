@extends('layouts.app')

@section('title', 'Nuevo Curso')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">Nuevo Curso</div>
                <div class="card-body">
                    <form action="{{ route('cursos.store') }}" method="POST">
                        @csrf
                        @include('cursos.formulario', ['niveles' => $niveles, 'profesores' => $profesores])
                        <button type="submit" class="btn btn-success">Crear Curso</button>
                        <a href="{{ route('cursos.gestion') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 