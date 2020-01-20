<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CretaTableViste extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('heure');
            $table->integer('id_hosp')->unsigned();
            $table->integer('id_employe')->unsigned();
            $table->foreign('id_hosp')->references('id')->on('hospitalisations')->onDelete('cascade');
            $table->foreign('id_employe')->references('id')->on('employs');
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
        Schema::dropIfExists('visites');
    }
}
