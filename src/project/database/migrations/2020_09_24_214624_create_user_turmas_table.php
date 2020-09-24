<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTurmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_turmas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turmas_id')->index();
            $table->foreign('turmas_id')->references('id')->on('turmas');
            $table->unsignedBigInteger('users_id')->index();
            $table->foreign('users_id')->references('id')->on('users');
            $table->enum('tipo', [1,2])->index();// 1=> Aluno, 2=> Professor
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
        Schema::dropIfExists('user_turmas');
    }
}
