<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrold extends Model
{
    use HasFactory;

    //un registro libro diario solo tiene una subcuenta
    public function subcuenta(){
        return $this->belongsTo('App\Models\Subcuenta'); //Pertenece a una categoría.
    }
    public function libro(){
        return $this->belongsTo('App\Models\LibroDiario','libro_diario_id');
    }


}
