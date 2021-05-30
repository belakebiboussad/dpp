<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\CRR;
use App\modeles\demandeexr;
use App\modeles\Etablissement;
use Response;
use PDF;
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
    return Response::json($crr);
 	}
 	public function edit($id)
 	{
 		$crr= CRR::find($id);
    return Response::json($crr);
 	}
 	public function update(Request $request, $id)
  {
      $crr = CRR::find($id);
      $crr->update($request->all()); 
      $crr->save();
      return Response::json($crr);  
  }
  public function download($id)
  {
    $crr = CRR::find($id);
    $etablissement = Etablissement::first();
    $pdf = PDF::loadView('examenradio.EtatsSortie.crrPDf',compact('crr','etablissement'));
    return $pdf->stream("crr.pdf");
  }
}
