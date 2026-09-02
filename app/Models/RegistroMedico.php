<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroMedico extends Model
{
    use HasFactory;

 
    protected $table = 'registro_medicos';

    // Campos permitidos para guardar
    protected $fillable = [
        'animal_id',
        'tipo_atencion',
        'fecha',
        'fecha_proxima',
        'diagnostico',
        'atendido_por',
    ];

    // Relación con la tabla animales
    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}