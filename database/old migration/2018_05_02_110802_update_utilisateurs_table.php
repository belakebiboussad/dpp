<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            //
            // $table->tinyInteger('active',false,['lenght'=>1])->default(1);
            // $table->tinyInteger('active')->length(1)->default(0);
            $table->addColumn('tinyInteger', 'active', ['lenght' => 1, 'default' =>'1'])->unsigned();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('utilisateurs', function (Blueprint $table) {
            //
            $table->dropColumn('active');
        });
    }
}
