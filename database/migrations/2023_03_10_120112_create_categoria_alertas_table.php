<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('udb_categoria_alertas');
        Schema::create('udb_categoria_alertas', function (Blueprint $table) {
            $table->id();
            $table->string('color')->length(50);
            $table->integer('rango_inicial')->length(3)->unsigned();
            $table->integer('rango_final')->length(3)->unsigned();
            $table->integer('estado')->length(1)->default(0)->unsigned();
            $table->timestamps();
            $table->string('created_by')->length(50);
            $table->string('updated_by')->length(50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('udb_categoria_alertas');
    }
}
