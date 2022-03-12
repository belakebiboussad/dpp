<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->integer('id_visite')->unsigned();
            $table->string('description');
            $table->json('periodes');   
            $table->integer('duree');
            $table->foreign('id_visite')->reference('id')->on('visites');
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
        Schema::dropIfExists('actes');
    }
}
