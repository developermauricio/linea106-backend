<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->string('key_server')->nullable();
            $table->string('key')->nullable();
            $table->longText('observaciones');
            $table->longText('narrativa');
            $table->string('fuente');
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
            $table->string('nombre_llama')->nullable();
            $table->string('documento_llama')->nullable();
            $table->text('descripcion_motivo')->nullable();
            // $table->string('respuesta')->nullable();
            // $table->string('radicado')->nullable();
            $table->longText('errores')->nullable();

            $table->unsignedBigInteger('paciente_id')->nullable();
            $table->foreign('paciente_id')->references('id')->on('pacientes');

            $table->unsignedBigInteger('motivo_consulta_id')->nullable();
            $table->foreign('motivo_consulta_id')->references('id')->on('motivo_consultas');

            $table->unsignedBigInteger('motivo_consulta_especifico_id')->nullable();
            $table->foreign('motivo_consulta_especifico_id')->references('id')->on('motivo_consulta_especificos');

            $table->unsignedBigInteger('quien_comunica_id')->nullable();
            $table->foreign('quien_comunica_id')->references('id')->on('quienes_comunican');

            $table->unsignedBigInteger('linea_intervencion_id');
            $table->foreign('linea_intervencion_id')->references('id')->on('lineas_intervencion');

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->unsignedBigInteger('tipo_paciente_id');
            $table->foreign('tipo_paciente_id')->references('id')->on('tipo_pacientes');

            $table->unsignedBigInteger('origen_id');
            $table->foreign('origen_id')->references('id')->on('origenes');

            $table->unsignedBigInteger('turno_id')->nullable();
            $table->foreign('turno_id')->references('id')->on('turnos');

            $table->unsignedBigInteger('etnicidad_id')->nullable();
            $table->foreign('etnicidad_id')->references('id')->on('etnicidades');

            $table->unsignedBigInteger('relacion_id')->nullable();
            $table->foreign('relacion_id')->references('id')->on('relaciones');

            $table->unsignedBigInteger('remision_id')->nullable();
            $table->foreign('remision_id')->references('id')->on('remisiones');

            $table->unsignedBigInteger('respuesta_id')->nullable();
            $table->foreign('respuesta_id')->references('id')->on('respuestas');

            $table->unsignedBigInteger('radicado_id')->nullable();
            $table->foreign('radicado_id')->references('id')->on('radicados');

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
        Schema::dropIfExists('casos');
    }
}
