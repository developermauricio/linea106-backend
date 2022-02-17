<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('key_server')->nullable();
            $table->string('key')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('sisben')->nullable();
            $table->string('identificacion')->nullable();
            $table->unsignedSmallInteger('edad')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('como_conocio_descripcion')->nullable();

            $table->longText('errores')->nullable();

            $table->unsignedBigInteger('orientacion_sexual_id')->nullable();
            $table->foreign('orientacion_sexual_id')->references('id')->on('orientaciones_sexuales');

            $table->unsignedBigInteger('genero_id')->nullable();
            $table->foreign('genero_id')->references('id')->on('generos');

            $table->unsignedBigInteger('sexo_id')->nullable();
            $table->foreign('sexo_id')->references('id')->on('sexos');

            $table->unsignedBigInteger('etnia_id')->nullable();
            $table->foreign('etnia_id')->references('id')->on('etnias');

            $table->unsignedBigInteger('estado_civil_id')->nullable();
            $table->foreign('estado_civil_id')->references('id')->on('estados_civiles');

            $table->unsignedBigInteger('ocupacion_id')->nullable();
            $table->foreign('ocupacion_id')->references('id')->on('ocupaciones');

            $table->unsignedBigInteger('nivel_educacion_id')->nullable();
            $table->foreign('nivel_educacion_id')->references('id')->on('niveles_educacion');

            $table->unsignedBigInteger('zona_id')->nullable();
            $table->foreign('zona_id')->references('id')->on('zonas');

            $table->unsignedBigInteger('tipo_identificacion_id')->nullable();
            $table->foreign('tipo_identificacion_id')->references('id')->on('tipos_identificacion');

            $table->unsignedBigInteger('poblacion_interes_id')->nullable();
            $table->foreign('poblacion_interes_id')->references('id')->on('poblaciones_interes');

            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id')->references('id')->on('municipios');

            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id')->references('id')->on('departamentos');

            $table->unsignedBigInteger('vereda_id')->nullable();
            $table->foreign('vereda_id')->references('id')->on('veredas');

            $table->unsignedBigInteger('como_conocio_id')->nullable();
            $table->foreign('como_conocio_id')->references('id')->on('como_conocieron');

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
        Schema::dropIfExists('pacientes');
    }
}
