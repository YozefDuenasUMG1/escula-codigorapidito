<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudInscripcion;
use App\Models\Sucursal;
use App\Models\Curso;
use App\Models\Nivel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SolicitudInscripcionRecibida;

class SolicitudInscripcionController extends Controller
{
    public function create()
    {
        $sucursales = Sucursal::all();
        $cursos = Curso::all();
        $niveles = Nivel::all();
        $user = Auth::user();
        return view('alumno.solicitud-inscripcion-form', compact('sucursales', 'cursos', 'niveles', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // Validar si ya está inscrito
        if ($user->alumno) {
            return redirect()->back()->with('error', 'Ya estás inscrito. No puedes enviar otra solicitud.');
        }
        $validated = $request->validate([
            'numero' => 'required|string|max:8',
            'direccion' => 'required|string',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'id_curso' => 'required|exists:cursos,id_curso',
            'id_nivel' => 'required|exists:niveles,id_nivel',
        ]);
        $solicitud = SolicitudInscripcion::create([
            'user_id' => $user->id,
            'nombre' => $user->name,
            'email' => $user->email,
            'numero' => $validated['numero'],
            'direccion' => $validated['direccion'],
            'id_sucursal' => $validated['id_sucursal'],
            'id_curso' => $validated['id_curso'],
            'id_nivel' => $validated['id_nivel'],
            'estado' => 'pendiente',
        ]);
        // Notificar al admin (puedes personalizar el correo de admin aquí)
        Notification::route('mail', config('mail.from.address'))
            ->notify(new SolicitudInscripcionRecibida($solicitud));
        return redirect()->route('dashboard')->with('success', 'Solicitud enviada correctamente. Un administrador revisará tu inscripción.');
    }

    // Mostrar todas las solicitudes para el admin
    public function index()
    {
        $solicitudes = \App\Models\SolicitudInscripcion::with(['sucursal', 'curso', 'nivel', 'user'])->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.solicitudes-inscripcion', compact('solicitudes'));
    }

    // Aceptar una solicitud e inscribir al usuario
    public function aceptar($id)
    {
        $solicitud = \App\Models\SolicitudInscripcion::findOrFail($id);
        // Verifica si ya existe un alumno con ese email
        if (\App\Models\Alumno::where('email', $solicitud->email)->exists()) {
            return redirect()->back()->with('error', 'Ya existe un alumno inscrito con este correo.');
        }
        $alumno = \App\Models\Alumno::create([
            'nombre' => $solicitud->nombre,
            'email' => $solicitud->email,
            'numero' => $solicitud->numero,
            'direccion' => $solicitud->direccion,
            'id_sucursal' => $solicitud->id_sucursal,
            'id_curso' => $solicitud->id_curso,
            'id_nivel' => $solicitud->id_nivel,
        ]);
        $solicitud->estado = 'aceptada';
        $solicitud->save();
        return redirect()->back()->with('success', 'El usuario ha sido inscrito correctamente.');
    }
}
