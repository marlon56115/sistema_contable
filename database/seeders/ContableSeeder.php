<?php

namespace Database\Seeders;

use App\Models\Cuenta;
use App\Models\Empresa;
use App\Models\Subcuenta;
use Illuminate\Database\Seeder;

class ContableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // User::factory()->times(5)->create();


        $cuenta = new Cuenta();
        $cuenta->id = 110000;
        $cuenta->nombre = "activo corriente";
        $cuenta->save();


        $subcuenta = new Subcuenta();
        $subcuenta->id = 1101000;
        $subcuenta->nombre = "efectivo y equivalente";
        $subcuenta->cuenta_id = 110000;
        $subcuenta->save();


        $empresa = new Empresa();
        $empresa->nombre = "Gumarsall SA de CV";
        $empresa->rubro = "Comida rapida";
        $empresa->NIT = "123567";
        $empresa->NCR = "1234567";
        $empresa->direccion = "puto el que lo lea";
        $empresa->save();
    }
}
