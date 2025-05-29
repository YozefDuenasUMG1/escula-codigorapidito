<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudInscripcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'email',
        'numero',
        'direccion',
        'id_sucursal',
        'id_curso',
        'id_nivel',
        'estado',
    ];

    public function sucursal() {
        return $this->belongsTo(\App\Models\Sucursal::class, 'id_sucursal');
    }
    public function curso() {
        return $this->belongsTo(\App\Models\Curso::class, 'id_curso');
    }
    public function nivel() {
        return $this->belongsTo(\App\Models\Nivel::class, 'id_nivel');
    }
    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
