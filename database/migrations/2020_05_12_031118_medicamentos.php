<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Medicamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('associacao',    191)->nullable();
            $table->string('farmaco',       100)->nullable();
            $table->string('detentor',      100)->nullable(false);
            $table->string('medicamento',   100)->nullable(false);
            $table->integer('registro'         )->nullable(false);
            $table->string('concentracao',  20)->nullable(false);
            $table->string('forma',         50)->nullable(false);
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
        Schema::dropIfExists('medicamentos');
    }
}
