<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Alumno;
use App\Models\Inscripcion;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = Nota::paginate(10);
        return view('notas.index', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cargar todos los alumnos registrados
        $alumnos = \App\Models\Alumno::all();
        return view('notas.create', compact('alumnos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_alumno' => 'required|exists:alumnos,id_alumno',
            'punteo' => 'required|integer|min:0|max:100',
            'observacion' => 'nullable|string',
        ]);
        // Buscar la inscripción más reciente del alumno
        $inscripcion = \App\Models\Inscripcion::where('id_alumno', $validated['id_alumno'])
            ->orderByDesc('fecha_inscripcion')
            ->first();
        if (!$inscripcion) {
            return redirect()->back()->with('error', 'El alumno seleccionado no tiene inscripción.');
        }
        \App\Models\Nota::create([
            'id_inscripcion' => $inscripcion->id_inscripcion,
            'punteo' => $validated['punteo'],
            'observacion' => $validated['observacion'] ?? null,
        ]);
        return redirect()->route('notas.index')->with('success', 'Nota creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nota = Nota::with(['inscripcion.alumno.sucursal', 'inscripcion.curso', 'inscripcion.nivel'])->findOrFail($id);
        return view('notas.edit', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nota = Nota::findOrFail($id);
        $validated = $request->validate([
            'punteo' => 'required|integer|min:0|max:100',
            'observacion' => 'nullable|string',
        ]);
        $nota->update($validated);
        return redirect()->route('reportes.ingreso_punteos')->with('success', 'Nota actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nota = Nota::findOrFail($id);
        $nota->delete();
        return redirect()->route('notas.index')->with('success', 'Nota eliminada exitosamente.');
    }
}
