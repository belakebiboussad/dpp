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

           $table->increments('id');
           $table->integer('id_demande');
           $table->integer('id_lit');
           $table->foreign('id_demande')->references('id')->on('demandehospitalisations')->onDelete('cascade');
           $table->foreign('id_lit')->references('id')->on('lits')->onDelete('cascade');
            //$table->integer('id_lit',50);
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
