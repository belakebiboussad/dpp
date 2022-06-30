<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColloquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colloques', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_colloque');
            $table->string('etat', 500);
            $table->dateTime('date_creation');
            $table->integer('type_colloque');
            $table->foreign('type_colloque')->references('id')->on('type_colloques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colloques');
    }
}
