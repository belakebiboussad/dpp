<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membres', function (Blueprint $table) {

            $table->engine = "InnoDB";
            $table->integer('id_colloque');
            $table->integer('id_employ');
            $table->primary(array('id_colloque', 'id_employ'));
            $table->integer('id_colloque');
            $table->integer('id_employ');   

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membres');
    }
}
