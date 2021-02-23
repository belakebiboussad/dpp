<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\appareilExamClinique;
class AppareilExamenCliniqueController extends Controller
{
    	public function __construct()
      {
          $this->middleware('auth');
      }
 	public function store($ExamClinID,$appareilID,$Desccrip)
 	{
 		$a =appareilExamClinique::firstOrCreate([
        "appareil_id"=>$appareilID,
        "examen_clinique_id"=>$ExamClinID,
        "description"=>$Desccrip,
     ]);
	}
    
}

