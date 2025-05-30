@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Punteo</h1>
    <a href="{{ route('reportes.ingreso_punteos') }}" class="btn btn-info mb-3">Ver lista de punteos</a>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="window.location='{{ route('notas.create') }}'" ></button>
        </div>
        <a href="{{ route('notas.create') }}" class="btn btn-secondary mb-3">Volver</a>
    @endif
    <form method="POST" action="{{ route('notas.store') }}">
        @csrf
        <div class="mb-3">
            <label for="id_alumno" class="form-label">Alumno</label>
            <select name="id_alumno" id="id_alumno" class="form-select" required>
                <option value="">Seleccione un alumno</option>
                @foreach($alumnos as $alumno)
                    <option value="{{ $alumno->id_alumno }}" data-inscripciones='@json($alumno->inscripciones->map(function($i){return ["id_inscripcion"=>$i->id_inscripcion,"curso"=>$i->curso->nombre??"","id_curso"=>$i->id_curso];}))'>{{ $alumno->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_curso" class="form-label">Curso</label>
            <select name="id_curso" id="id_curso" class="form-select" required disabled>
                <option value="">Seleccione un curso</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="punteo" class="form-label">Punteo</label>
            <input type="number" name="punteo" id="punteo" class="form-control" min="0" max="100" required>
        </div>
        <div class="mb-3">
            <label for="observacion" class="form-label">Observación</label>
            <textarea name="observacion" id="observacion" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    @media (max-width: 600px) {
        .select2-container .select2-selection--single {
            font-size: 14px;
            padding: 8px 4px;
        }
        .select2-results__option {
            white-space: pre-line;
            font-size: 13px;
        }
    }
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#id_alumno').select2({
            width: '100%',
            placeholder: 'Seleccione un alumno',
            allowClear: true
        });
        $('#id_curso').select2({
            width: '100%',
            placeholder: 'Seleccione un curso',
            allowClear: true
        });
        $('#id_alumno').on('change', function() {
            var selected = $(this).find('option:selected');
            var inscripciones = selected.data('inscripciones') || [];
            var $curso = $('#id_curso');
            $curso.empty();
            $curso.append('<option value="">Seleccione un curso</option>');
            if(inscripciones.length > 0){
                inscripciones.forEach(function(i){
                    $curso.append('<option value="'+i.id_inscripcion+'">'+i.curso+'</option>');
                });
                $curso.prop('disabled', false);
            }else{
                $curso.prop('disabled', true);
            }
            $curso.val('').trigger('change');
        });
    });
</script>
@endpush
