<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\CredencialesUsuario;

class UserController extends Controller
{
    // Mostrar listado de usuarios
    public function index()
    {
        $usuarios = User::paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $usuario->id,
            'role' => 'required|in:admin,profesor,alumno',
        ]);
        $usuario->update($validated);
        // Manejo de registros extendidos según el rol
        if ($validated['role'] === 'profesor') {
            // Crear en profesores si no existe
            if (!\App\Models\Profesor::where('id_user', $usuario->id)->exists()) {
                \App\Models\Profesor::create([
                    'nombre' => $usuario->name,
                    'email' => $usuario->email,
                    'id_user' => $usuario->id,
                    'telefono' => '',
                    'especialidad' => '',
                    'id_sucursal' => null,
                    'id_nivel' => null,
                ]);
            }
            // Eliminar en alumnos si existe
            \App\Models\Alumno::where('id_user', $usuario->id)->delete();
        } elseif ($validated['role'] === 'alumno') {
            // Crear en alumnos si no existe
            if (!\App\Models\Alumno::where('id_user', $usuario->id)->exists()) {
                \App\Models\Alumno::create([
                    'nombre' => $usuario->name,
                    'email' => $usuario->email,
                    'numero' => '',
                    'direccion' => '',
                    'id_sucursal' => null,
                    'id_nivel' => null,
                    'id_curso' => null,
                    'id_user' => $usuario->id,
                ]);
            }
            // Eliminar en profesores si existe
            \App\Models\Profesor::where('id_user', $usuario->id)->delete();
        } elseif ($validated['role'] === 'admin') {
            // Eliminar en ambas si existen
            \App\Models\Profesor::where('id_user', $usuario->id)->delete();
            \App\Models\Alumno::where('id_user', $usuario->id)->delete();
        }
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Resetear contraseña de usuario
    public function resetPassword($id)
    {
        $usuario = User::findOrFail($id);
        $newPassword = Str::random(10);
        $usuario->password = Hash::make($newPassword);
        $usuario->save();
        $usuario->notify(new CredencialesUsuario($usuario->email, $newPassword, $usuario->role));
        return back()->with('success', 'Contraseña reseteada y enviada al usuario.');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        // Eliminar registro de profesor si existe
        \App\Models\Profesor::where('id_user', $usuario->id)->delete();
        // Eliminar registro de alumno y sus inscripciones si existe
        $alumno = \App\Models\Alumno::where('id_user', $usuario->id)->first();
        if ($alumno) {
            \App\Models\Inscripcion::where('id_alumno', $alumno->id_alumno)->delete();
            $alumno->delete();
        }
        $usuario->delete();
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
