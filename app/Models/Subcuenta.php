<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcuenta extends Model
{
    use HasFactory;

    public function cuenta()
    {
        return $this->belongsTo('App\Models\Cuenta');
    }
    public function registro(){
        return $this->hasMany(Registrold::class);
    }
}
