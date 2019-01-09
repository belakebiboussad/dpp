<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\LettreOrientation;
class LettreOrientationController extends Controller
{
    //
      public function store(Request $request ,$consultID)
    { 
           
    	 LettreOrientation::create([
            "motif"=>$request->motifOrient,
            "specialite"=>$request->specialite,
            "medecin"=>$request->medecin,
            "Consultation_ID_Consultation"=>$consultID,
            ]);
    }
}
