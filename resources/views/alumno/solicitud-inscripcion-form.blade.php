@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<form action="{{ route('solicitud-inscripcion.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label>Número</label>
        <input type="text" name="numero" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Dirección</label>
        <input type="text" name="direccion" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Sucursal</label>
        <select name="id_sucursal" class="form-control" required>
            @foreach($sucursales as $sucursal)
                <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-2">
        <label>Curso</label>
        <select name="id_curso" class="form-control" required>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id_curso }}">{{ $curso->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-2">
        <label>Nivel</label>
        <select name="id_nivel" class="form-control" required>
            @foreach($niveles as $nivel)
                <option value="{{ $nivel->id_nivel }}">{{ $nivel->nombre }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enviar solicitud</button>
</form> 