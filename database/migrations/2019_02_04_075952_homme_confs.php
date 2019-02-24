<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HommeConfs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('homme_confs', function (Blueprint $table) {

            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('id_patient');
            $table->string('nom');
            $table->string('prénom');
            $table->date('date_naiss');
            $table->string('lien_par');
            $table->string('type_piece');
            $table->string('num_piece');
            $table->date('date_deliv');
            $table->string('adresse');
            $table->string('mob',10);
            $table->enum('etat_hc', ['actuel', 'archivé'])->default('actuel');
            $table->integer('updated_by',11);
            $table->integer('created_by',11);
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
        Schema::dropIfExists('homme_confs');
    }
}
