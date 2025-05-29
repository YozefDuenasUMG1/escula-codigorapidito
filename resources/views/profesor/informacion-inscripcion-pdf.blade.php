<html>
<head>
    <meta charset="utf-8">
    <title>Información de Inscripción - Profesor</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .titulo { color: #17a2b8; text-align: center; margin-bottom: 20px; }
        .info-list { width: 100%; border-collapse: collapse; margin: 0 auto; }
        .info-list td { padding: 8px 12px; border-bottom: 1px solid #eee; }
        .info-list td.label { font-weight: bold; background: #f8f9fa; width: 180px; }
    </style>
</head>
<body>
    <h2 class="titulo">Información de Inscripción - Profesor</h2>
    <table class="info-list">
        <tr><td class="label">Nombre:</td><td>{{ $profesor->nombre }}</td></tr>
        <tr><td class="label">Correo:</td><td>{{ $profesor->email }}</td></tr>
        <tr><td class="label">Teléfono:</td><td>{{ $profesor->telefono }}</td></tr>
        <tr><td class="label">Especialidad:</td><td>{{ $profesor->especialidad }}</td></tr>
        <tr><td class="label">Sucursal:</td><td>{{ $profesor->sucursal->nombre ?? '-' }}</td></tr>
        <tr><td class="label">Nivel:</td><td>{{ $profesor->nivel->nombre ?? '-' }}</td></tr>
    </table>
</body>
</html> 