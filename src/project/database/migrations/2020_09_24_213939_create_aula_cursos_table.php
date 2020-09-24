<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulaCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula_cursos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aulas_id')->index();
            $table->foreign('aulas_id')->references('id')->on('aulas');
            $table->unsignedBigInteger('cursos_id')->index();
            $table->foreign('cursos_id')->references('id')->on('cursos');
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
        Schema::dropIfExists('aula_cursos');
    }
}
