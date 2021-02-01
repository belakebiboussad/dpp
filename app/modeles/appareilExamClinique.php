<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class appareilExamClinique extends Model
{
	 public $timestamps = false;
    	protected $fillable = ['appareil_id','examen_clinique_id','description'];
    	protected $table ="appareil_examen_cliniques";
}
