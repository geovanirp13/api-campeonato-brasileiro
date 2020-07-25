<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('name');
            $table->Integer('age');
            $table->string('image')->nullable();
            $table->string('position');
            $table->Integer('number');
            $table->enum('status', ['Disponivel', 'Suspenso', 'Lesionado']);

            $table->bigInteger('club_id')->unsigned();
            $table->foreign('club_id')
                  ->references('id')
                  ->on('clubs');

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
        Schema::dropIfExists('players');
    }
}
