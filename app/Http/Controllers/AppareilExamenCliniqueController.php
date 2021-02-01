<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\appareilExamClinique;
class AppareilExamenCliniqueController extends Controller
{
    //
 	public function store($ExamClinID,$appareilID,$Desccrip)
 	{
 		$a =appareilExamClinique::firstOrCreate([
        "appareil_id"=>$appareilID,
        "examen_clinique_id"=>$ExamClinID,
        "description"=>$Desccrip,
     ]);
	}
    
}

