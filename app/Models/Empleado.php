<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombres',
        'apellidos',
        'identificacion',
        'direccion',
        'telefono',
        'pais_nacimiento',
        'ciudad_nacimiento',
        'jefe_id'
    ];
    
    // Relación muchos a muchos con cargos
    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'cargo_empleado');
    }

    // Relación recursiva: jefe
    public function jefe()
    {
        return $this->belongsTo(Empleado::class, 'jefe_id');
    }

    // Relación recursiva: subalternos
    public function subalternos()
    {
        return $this->hasMany(Empleado::class, 'jefe_id');
    }
}
