<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bedReservation', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('id_rdvHosp')->unsigned();
            $table->integer('id_lit')->unsigned();
            $table->foreign('id_rdvHosp')->references('id')->on('rdv_hospitalisations');
             $table->foreign('id_lit')->references('id')->on('lits');
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
        Schema::dropIfExists('bedReservation');
    }
}
