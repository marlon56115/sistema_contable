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
        $cuenta->nombre = "Activo corriente";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 120000;
        $cuenta->nombre = "Activo no corriente";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 210000;
        $cuenta->nombre = "Pasivo corriente";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 220000;
        $cuenta->nombre = "Pasivo no corriente";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 310000;
        $cuenta->nombre = "Capital";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 320000;
        $cuenta->nombre = "Resultado acumulado";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 410000;
        $cuenta->nombre = "Costos y gastos de operación";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 420000;
        $cuenta->nombre = "Gastos de no operación";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 430000;
        $cuenta->nombre = "Gastos de impuesto sobre la renta";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 510000;
        $cuenta->nombre = "Ingresos de operación";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 520000;
        $cuenta->nombre = "Ingresos de no operación";
        $cuenta->save();
        $cuenta = new Cuenta();
        $cuenta->id = 610000;
        $cuenta->nombre = "Cuentas liquidadoras de resultados";
        $cuenta->save();


        $subcuenta = new Subcuenta();
        $subcuenta->id = 110100;
        $subcuenta->nombre = "Efectivo y equivalentes";
        $subcuenta->cuenta_id = 110000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 110200;
        $subcuenta->nombre = "Inversiones financieras a corto plazo";
        $subcuenta->cuenta_id = 110000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 120100;
        $subcuenta->nombre = "Propiedades planta y equipo";
        $subcuenta->cuenta_id = 120000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 120200;
        $subcuenta->nombre = "Inversiones permanentes";
        $subcuenta->cuenta_id = 120000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 210100;
        $subcuenta->nombre = "Prestamos y sobregiros bancarios a corto plazo";
        $subcuenta->cuenta_id = 210000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 210200;
        $subcuenta->nombre = "Proveedores y otras cuentas por pagar";
        $subcuenta->cuenta_id = 210000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 220100;
        $subcuenta->nombre = "Prestamos bancarios a largo plazo";
        $subcuenta->cuenta_id = 220000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 220200;
        $subcuenta->nombre = "Obligaciones bajo arrendamiento financiero-largo plazo";
        $subcuenta->cuenta_id = 220000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 310100;
        $subcuenta->nombre = "Capital social";
        $subcuenta->cuenta_id = 310000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 320100;
        $subcuenta->nombre = "Utilidades restringidas";
        $subcuenta->cuenta_id = 320000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 320200;
        $subcuenta->nombre = "Utilidades no distribuidas";
        $subcuenta->cuenta_id = 320000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 410100;
        $subcuenta->nombre = "Costo de venta";
        $subcuenta->cuenta_id = 410000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 410200;
        $subcuenta->nombre = "Costo de producción";
        $subcuenta->cuenta_id = 410000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 420100;
        $subcuenta->nombre = "Gastos financieros";
        $subcuenta->cuenta_id = 420000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 420200;
        $subcuenta->nombre = "Gastos por cabio en valor razonable en inversiones financieras";
        $subcuenta->cuenta_id = 420000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 430100;
        $subcuenta->nombre = "Gastos de impuestos sobre la renta corriente";
        $subcuenta->cuenta_id = 430000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 430200;
        $subcuenta->nombre = "Gastos de impuestos sobre la renta diferido – activo";
        $subcuenta->cuenta_id = 430000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 510100;
        $subcuenta->nombre = "Ingresos por ventas";
        $subcuenta->cuenta_id = 510000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 510200;
        $subcuenta->nombre = "Otros ingresos de operación";
        $subcuenta->cuenta_id = 510000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 520100;
        $subcuenta->nombre = "-Ingresos por cambios en Valor Razonable de Inversiones Financieras";
        $subcuenta->cuenta_id = 520000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 520200;
        $subcuenta->nombre = "Reversión del Deterioro y Ganancia en los Instrumentos Financieros";
        $subcuenta->cuenta_id = 520000;
        $subcuenta->save();
        $subcuenta = new Subcuenta();
        $subcuenta->id = 610100;
        $subcuenta->nombre = "Pérdidas y ganancias";
        $subcuenta->cuenta_id = 610000;
        $subcuenta->save();


        $empresa = new Empresa();
        $empresa->nombre = "Gumarsall SA de CV";
        $empresa->rubro = "Venta de comida";
        $empresa->NIT = "102-5625120-101-4";
        $empresa->NCR = "100012";
        $empresa->direccion = "San Juan Opico, San Salvador #8";
        $empresa->save();
        $empresa = new Empresa();
        $empresa->nombre = "Super Selectos SA de CV";
        $empresa->rubro = "Venta de comida";
        $empresa->NIT = "102-5625120-101-4";
        $empresa->NCR = "100012";
        $empresa->direccion = "San Juan Opico, San Salvador #8";
        $empresa->save();
        $empresa = new Empresa();
        $empresa->nombre = "Almacenes Sandoval";
        $empresa->rubro = "Venta de comida";
        $empresa->NIT = "102-5625120-101-4";
        $empresa->NCR = "100012";
        $empresa->direccion = "San Juan Opico, San Salvador #8";
        $empresa->save();
        $empresa = new Empresa();
        $empresa->nombre = "Zona Digital";
        $empresa->rubro = "Venta de comida";
        $empresa->NIT = "102-5625120-101-4";
        $empresa->NCR = "100012";
        $empresa->direccion = "San Juan Opico, San Salvador #8";
        $empresa->save();
        $empresa = new Empresa();
        $empresa->nombre = "Aeon Computadoras";
        $empresa->rubro = "Venta de comida";
        $empresa->NIT = "102-5625120-101-4";
        $empresa->NCR = "100012";
        $empresa->direccion = "San Juan Opico, San Salvador #8";
        $empresa->save();
        
    }
}
