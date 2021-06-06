<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\LettreOrientation;
class LettreOrientationController extends Controller
{
	public function __construct()
      {
          $this->middleware('auth');
      }
    public function store(Request $request ,$consultID)
    { 
        LettreOrientation::create([
        "motif"=>$request->motifOr,
        "specialite"=>$request->specialite,
        "medecin"=>$request->medecin,
        "consultation_id"=>$consultID,
        ]);
    }
}
