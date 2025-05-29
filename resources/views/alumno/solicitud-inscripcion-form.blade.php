<div class="card shadow-lg border-0 mx-auto" style="max-width: 500px; margin-top: 30px;">
    <div class="card-body">
        <h4 class="mb-4 text-center text-primary">Solicitud de Inscripción</h4>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('solicitud-inscripcion.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Número</label>
                <input type="text" name="numero" class="form-control rounded-pill" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control rounded-pill" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Sucursal</label>
                <select name="id_sucursal" class="form-select rounded-pill" required>
                    @foreach($sucursales as $sucursal)
                        <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Curso</label>
                <select name="id_curso" class="form-select rounded-pill" required>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id_curso }}">{{ $curso->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nivel</label>
                <select name="id_nivel" class="form-select rounded-pill" required>
                    @foreach($niveles as $nivel)
                        <option value="{{ $nivel->id_nivel }}">{{ $nivel->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-3">
                <button type="submit" class="btn btn-primary rounded-pill">Enviar solicitud</button>
                <a href="{{ route('dashboard.alumno') }}" class="btn btn-secondary rounded-pill">Cancelar</a>
            </div>
        </form>
    </div>
</div> 