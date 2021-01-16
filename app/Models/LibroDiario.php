<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroDiario extends Model
{
    use HasFactory;

    public function registroLibroDiario()
    {
        return $this->hasMany('App\Models\Registrold'); // Muchos a muchos
    }
}
