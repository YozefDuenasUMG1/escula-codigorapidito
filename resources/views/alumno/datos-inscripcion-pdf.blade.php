<h2>Datos de inscripción</h2>
@if($alumno)
    <ul>
        <li><strong>Nombre:</strong> {{ $alumno->nombre }}</li>
        <li><strong>Email:</strong> {{ $alumno->email }}</li>
        <li><strong>Número:</strong> {{ $alumno->numero }}</li>
        <li><strong>Dirección:</strong> {{ $alumno->direccion }}</li>
        <li><strong>Sucursal:</strong> {{ $alumno->sucursal->nombre ?? $alumno->id_sucursal }}</li>
        <li><strong>Curso:</strong> {{ $alumno->curso->nombre ?? $alumno->id_curso }}</li>
        <li><strong>Nivel:</strong> {{ $alumno->nivel->nombre ?? $alumno->id_nivel }}</li>
    </ul>
@else
    <p>No tienes datos de inscripción.</p>
@endif 