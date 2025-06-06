<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí se registran las rutas web de la aplicación.
| Se agrupan por tipo y funcionalidad para mejor mantenimiento.
*/

// Rutas públicas de vistas
// Route::view('/', 'welcome');
Route::redirect('/', '/login');
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('/sidebar-demo', 'sidebar-demo')->name('sidebar.demo');
// Reemplazar la vista directa por el método create del controlador para pasar sucursales, cursos y niveles
Route::get('/inscribir-alumno', [AlumnoController::class, 'create'])->name('alumnos.inscribir');
Route::get('/gestion-alumnos', [AlumnoController::class, 'gestion'])->name('alumnos.gestion');
Route::view('/inicio', 'dashboard')->name('inicio');
Route::get('/añadir-docente', [App\Http\Controllers\ProfesorController::class, 'create'])->name('docentes.añadir');

// Reemplazar la vista directa por el método index del controlador para pasar $docentes
Route::get('/gestion-docentes', [ProfesorController::class, 'index'])
    ->middleware(['auth', 'role:admin,profesor'])
    ->name('docentes.gestion');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de controladores
Route::post('/alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
Route::resource('docentes', ProfesorController::class);
Route::resource('grados', App\Http\Controllers\GradoController::class);
Route::resource('niveles', App\Http\Controllers\NivelController::class);
Route::resource('cursos', App\Http\Controllers\CursoController::class);
Route::resource('profesores', App\Http\Controllers\ProfesorController::class);
Route::resource('alumnos', App\Http\Controllers\AlumnoController::class);
Route::resource('inscripciones', App\Http\Controllers\InscripcionController::class);
Route::resource('notas', App\Http\Controllers\NotaController::class);
Route::resource('sucursales', App\Http\Controllers\SucursalController::class);

// Ruta explícita para el listado de alumnos (para el sidebar)
Route::get('/alumnos-lista', [AlumnoController::class, 'index'])->name('alumnos.lista');
// Ruta explícita para el listado de profesores (para el sidebar)
Route::get('/profesores-lista', [ProfesorController::class, 'index'])->name('profesores.lista');

// Rutas explícitas para ver y editar profesores
Route::get('/profesores/{id}', [ProfesorController::class, 'show'])->name('profesores.show');
Route::get('/profesores/{id}/editar', [ProfesorController::class, 'edit'])->name('profesores.edit');

// Rutas de autenticación
require __DIR__.'/auth.php';

// Ruta para la gestión de sucursales
Route::get('/gestion-sucursales', [\App\Http\Controllers\SucursalController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('sucursales.gestion');

// Ruta para la gestión de cursos
Route::get('/gestion-cursos', [\App\Http\Controllers\CursoController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('cursos.gestion');

Route::get('/reportes/alumnos-por-grado', [ReporteController::class, 'alumnosPorGrado'])->name('reportes.alumnos_por_grado');
Route::get('/reportes/ingreso-alumnos-registro', [ReporteController::class, 'ingresoAlumnosRegistro'])->name('reportes.ingreso_alumnos_registro');
Route::get('/reportes/ingreso-alumnos-registro/exportar', [ReporteController::class, 'exportarIngresoAlumnosRegistro'])->name('reportes.ingreso_alumnos_registro.exportar');
Route::get('/reportes/alumnos-por-grado/exportar', [ReporteController::class, 'exportarAlumnosPorGrado'])->name('reportes.alumnos_por_grado.exportar');
Route::get('/reportes/ingreso-punteos', [ReporteController::class, 'ingresoPunteos'])->name('reportes.ingreso_punteos');
Route::get('/reportes/ingreso-punteos/exportar', [ReporteController::class, 'exportarIngresoPunteos'])->name('reportes.ingreso_punteos.exportar');

Route::get('/dashboard-alumno', [\App\Http\Controllers\AlumnoDashboardController::class, 'index'])
    ->middleware(['auth', 'role:alumno'])->name('dashboard.alumno');

Route::get('/dashboard-profesor', [\App\Http\Controllers\ProfesorDashboardController::class, 'index'])
    ->middleware(['auth', 'role:profesor'])->name('dashboard.profesor');

// Rutas para menú de Alumno
Route::middleware(['auth', 'role:alumno'])->prefix('alumno')->group(function () {
    Route::view('info', 'alumno.info')->name('alumno.info');
    Route::get('punteos', [\App\Http\Controllers\AlumnoController::class, 'punteos'])->name('alumno.punteos');
    Route::get('datos-inscripcion', [\App\Http\Controllers\AlumnoController::class, 'datosInscripcion'])->name('alumno.datos-inscripcion');
    Route::get('datos-inscripcion/pdf', [\App\Http\Controllers\AlumnoController::class, 'exportarDatosInscripcionPdf'])->name('alumno.datos-inscripcion.pdf');
});

// Rutas para menú de Profesor
Route::middleware(['auth', 'role:profesor'])->prefix('profesor')->group(function () {
    Route::view('gestion-alumnos', 'profesor.gestion-alumnos')->name('profesor.gestion-alumnos');
    Route::view('ingresar-punteos', 'profesor.ingresar-punteos')->name('profesor.ingresar-punteos');
    Route::view('ingreso-alumno', 'profesor.ingreso-alumno')->name('profesor.ingreso-alumno');
    Route::view('gestion-alumno', 'profesor.gestion-alumno')->name('profesor.gestion-alumno');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/gestion-usuarios', [\App\Http\Controllers\UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{id}/editar', [\App\Http\Controllers\UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('usuarios.update');
    Route::get('/admin/solicitudes-inscripcion', [\App\Http\Controllers\SolicitudInscripcionController::class, 'index'])->name('solicitudes-inscripcion.index');
    Route::post('/admin/solicitudes-inscripcion/{id}/aceptar', [\App\Http\Controllers\SolicitudInscripcionController::class, 'aceptar'])->name('solicitudes-inscripcion.aceptar');
    Route::post('/usuarios/{id}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword'])->name('usuarios.reset-password');
    Route::delete('/usuarios/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('usuarios.destroy');
});

// Rutas para que los alumnos creen y envíen solicitudes de inscripción
Route::middleware(['auth', 'role:alumno'])->group(function () {
    Route::get('/solicitud-inscripcion', [App\Http\Controllers\SolicitudInscripcionController::class, 'create'])->name('solicitud-inscripcion.create');
    Route::post('/solicitud-inscripcion', [App\Http\Controllers\SolicitudInscripcionController::class, 'store'])->name('solicitud-inscripcion.store');
});

// Eliminar o comentar el grupo de rutas con 'verified'
// Route::middleware(['auth', 'verified'])->group(function () {
//     // Aquí van las rutas protegidas que requieren email verificado
// });

// Ruta para añadir profesor
Route::get('/añadir-profesor', [App\Http\Controllers\ProfesorController::class, 'create'])->name('profesores.create');
// Ruta para gestión de profesores
Route::get('/gestion-profesores', [ProfesorController::class, 'index'])->name('profesores.gestion');

// Ruta visual de todos los cursos y niveles
Route::get('/cursos-lista', [\App\Http\Controllers\CursoController::class, 'verListaVisual'])->name('cursos.lista.visual');

// Información de inscripción del profesor
Route::middleware(['auth', 'role:profesor'])->get('/profesor/informacion-inscripcion', [\App\Http\Controllers\ProfesorController::class, 'informacionInscripcion'])->name('profesor.informacion-inscripcion');
Route::middleware(['auth', 'role:profesor'])->get('/profesor/informacion-inscripcion/pdf', [\App\Http\Controllers\ProfesorController::class, 'exportarInformacionInscripcionPdf'])->name('profesor.informacion-inscripcion.pdf');
