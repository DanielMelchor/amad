<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedienteProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('udb_expediente_procesos');
        Schema::create('udb_expediente_procesos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->length(225);
            $table->integer('interno')->length(1)->unsigned()->default(0);
            $table->integer('horas')->length(3)->unsigned();
            $table->BigInteger('expediente_proceso_id')->length(20)->unsigned()->nullable();
            $table->integer('tipo_tarea_id')->length(20)->unsigned()->nullable();
            $table->integer('estado')->length(1)->unsigned()->default(0);
            $table->integer('orden')->length(3)->unsigned()->default(0);
            $table->timestamps();
            $table->string('created_by')->length(50);
            $table->string('updated_by')->length(50);
            $table->foreign('expediente_proceso_id')->references('id')->on('udb_expediente_procesos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expediente_procesos');
    }
}
