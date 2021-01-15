<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrolds', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('subcuenta_id'); // Relación con categorias
            $table->foreign('subcuenta_id')->references('id')->on('subcuentas');

            $table->unsignedBigInteger('libro_diario_id'); // Relación con categorias
            $table->foreign('libro_diario_id')->references('id')->on('libro_diarios');

            $table->float('debe');
            $table->float('haber');
            $table->string('concepto');
            $table->boolean('ajuste');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrolds');
    }
}
