<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\CRR;
use App\modeles\demandeexr;
use Response;
class CRRControler extends Controller
{
	public function __construct()
  {
    $this->middleware('auth');
  }
  public function store(Request $request)
  {
  	$crr =CRR::create($request->all());
    $demande = demandeexr::with('examensradios')->FindOrFail($request->demande_id);
    foreach ($demande->examensradios as $key => $exam)
    {
    	if( $exam->pivot->id_examenradio == $request->exam_id)
      {
      	$exam->pivot->crr_id = $crr->id;
      	$exam->pivot->save();
      }
    }
    // return Response()->json([
    //   "rowID" => "Bonj",
    // ]);
 		return Response::json($crr->id);
 		//return Response::json("sdf");

  }
}
