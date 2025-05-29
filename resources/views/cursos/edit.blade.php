@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-dark">Editar Curso</div>
                <div class="card-body">
                    <form action="{{ route('cursos.update', $curso->id_curso) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('cursos.formulario', ['curso' => $curso, 'niveles' => $niveles, 'profesores' => $profesores])
                        <button type="submit" class="btn btn-success">Actualizar Curso</button>
                        <a href="{{ route('cursos.gestion') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 