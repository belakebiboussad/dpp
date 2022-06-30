<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraitExecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trait_execs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('trait_id');
          $table->integer('employ_id');
          $table->boolean('does')->default(0);
          $table->text('obs');
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
        Schema::dropIfExists('trait_execs');
    }
}
