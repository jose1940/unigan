<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';

    protected $fillable = ['nombre', 'cantidad', 'fecha_compra', 'fecha_vencimiento'];
}