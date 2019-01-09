  <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
<<<<<<< HEAD:gestion_d_p/database/old migration/2018_04_19_131206_create_admissions_table.php
            $table->increments('id');
            $table->integer('id_demande');
            $table->integer('id_lit');
            $table->foreign('id_demande')->references('id')->on('demandehospitalisations');
            $table->foreign('id_lit')->references('id')->on('lits');
=======
           $table->increments('id');
           $table->integer('id_demande');
           $table->integer('id_lit');
           $table->foreign('id_demande')->references('id')->on('demandehospitalisations')->onDelete('cascade');
           $table->foreign('id_lit')->references('id')->on('lits')->onDelete('cascade');
            //$table->integer('id_lit',50);
>>>>>>> aad3bfc349023a03744f7a1118e33184bc7c5bbb:gestion_d_p/database/migrations/2018_04_19_131206_create_admissions_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admissions');
    }
}
