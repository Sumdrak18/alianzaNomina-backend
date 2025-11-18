<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('identificacion')->unique();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('pais_nacimiento');
            $table->string('ciudad_nacimiento');
            $table->unsignedBigInteger('jefe_id')->nullable(); // relación recursiva
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('jefe_id')->references('id')->on('empleados')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
