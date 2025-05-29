<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\Sucursal;
use App\Models\Nivel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\CredencialesUsuario;
use Illuminate\Support\Facades\Notification;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Profesor::with(['sucursal', 'nivel'])->paginate(10);
        // Para la vista profesores-lista
        if (request()->routeIs('profesores.lista')) {
            return view('profesores-lista', ['profesores' => $profesores]);
        }
        // Para la vista gestion-profesores
        if (request()->routeIs('profesores.gestion')) {
            return view('gestion-profesores', ['profesores' => $profesores]);
        }
        // Fallback
        return view('profesores-lista', ['profesores' => $profesores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sucursales = \App\Models\Sucursal::all();
        $niveles = \App\Models\Nivel::all();
        return view('añadir-profesor', compact('sucursales', 'niveles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:profesores,email',
            'telefono' => 'required|string|max:15',
            'especialidad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'id_nivel' => 'required|exists:niveles,id_nivel',
        ]);
        $profesor = Profesor::create($validated);
        $adminEmail = auth()->user()->email ?? config('mail.from.address');
        if (filter_var($profesor->email, FILTER_VALIDATE_EMAIL) && !User::where('email', $profesor->email)->exists()) {
            $password = Str::random(10);
            $user = User::create([
                'name' => $profesor->nombre,
                'email' => $profesor->email,
                'password' => Hash::make($password),
                'role' => 'profesor',
            ]);
            $profesor->id_user = $user->id;
            $profesor->save();
            $user->notify(new CredencialesUsuario($user->email, $password, 'profesor'));
            Notification::route('mail', $adminEmail)
                ->notify(new \App\Notifications\CredencialesUsuario($user->email, $password, 'profesor'));
        }
        return redirect()->route('profesores.lista')->with('success', 'Profesor agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $profesor = Profesor::with(['sucursal', 'nivel'])->findOrFail($id);
        return view('ver-profesor', ['docente' => $profesor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $profesor = Profesor::findOrFail($id);
        $sucursales = \App\Models\Sucursal::all();
        $niveles = \App\Models\Nivel::all();
        return view('editar-profesor', ['docente' => $profesor, 'sucursales' => $sucursales, 'niveles' => $niveles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:profesores,email,' . $profesor->id_profesor . ',id_profesor',
            'telefono' => 'required|string|max:15',
            'especialidad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'id_sucursal' => 'required|exists:sucursales,id_sucursal',
            'id_nivel' => 'required|exists:niveles,id_nivel',
        ]);
        $profesor->update($validated);
        return redirect()->route('profesores.gestion')->with('success', 'Profesor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();
        return redirect()->route('profesores.lista')->with('success', 'Profesor eliminado exitosamente.');
    }

    public function gestionAdmin()
    {
        $profesores = \App\Models\Profesor::with(['user'])->paginate(15);
        return view('admin.gestion-profesores', compact('profesores'));
    }

    public function resetPassword($id)
    {
        $profesor = \App\Models\Profesor::with('user')->findOrFail($id);
        if ($profesor->user) {
            $newPassword = \Str::random(10);
            $profesor->user->password = \Hash::make($newPassword);
            $profesor->user->save();
            $profesor->user->notify(new \App\Notifications\CredencialesUsuario($profesor->user->email, $newPassword, 'profesor'));
            return back()->with('success', 'Contraseña reseteada y enviada al profesor.');
        }
        return back()->with('error', 'No se encontró el usuario relacionado.');
    }

    public function toggleActive($id)
    {
        $profesor = \App\Models\Profesor::with('user')->findOrFail($id);
        if ($profesor->user) {
            $profesor->user->active = !$profesor->user->active;
            $profesor->user->save();
            return back()->with('success', 'Estado de la cuenta actualizado.');
        }
        return back()->with('error', 'No se encontró el usuario relacionado.');
    }

    public function destroyAdmin($id)
    {
        $profesor = \App\Models\Profesor::with('user')->findOrFail($id);
        if ($profesor->user) {
            $profesor->user->delete();
        }
        $profesor->delete();
        return back()->with('success', 'Profesor y usuario eliminados correctamente.');
    }
}
