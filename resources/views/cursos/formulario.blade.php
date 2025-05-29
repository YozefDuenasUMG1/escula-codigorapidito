@props(['curso' => null, 'niveles', 'profesores'])
<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $curso->nombre ?? '') }}" required>
</div>
<div class="mb-3">
    <label for="id_nivel" class="form-label">Nivel</label>
    <select name="id_nivel" class="form-control" required>
        <option value="">Seleccione un nivel</option>
        @foreach($niveles as $nivel)
            <option value="{{ $nivel->id_nivel }}" @if(old('id_nivel', $curso->id_nivel ?? '') == $nivel->id_nivel) selected @endif>{{ $nivel->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control" required>{{ old('descripcion', $curso->descripcion ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label for="id_profesor" class="form-label">Profesor</label>
    <select name="id_profesor" class="form-control" required>
        <option value="">Seleccione un profesor</option>
        @foreach($profesores as $profesor)
            <option value="{{ $profesor->id_profesor }}" @if(old('id_profesor', $curso->id_profesor ?? '') == $profesor->id_profesor) selected @endif>{{ $profesor->nombre }}</option>
        @endforeach
    </select>
</div> 