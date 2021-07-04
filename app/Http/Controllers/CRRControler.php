<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\CRR;
use App\modeles\demandeexr;
use App\modeles\Etablissement;
use Response;
use PDF;
use HTML;
class CRRControler extends Controller
{
	public function __construct()
      {
            $this->middleware('auth');
      }
  public function store(Request $request)
  {
  	$crr = CRR::create($request->all());
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
  public function print(Request $request)
  {
        $opciones_ssl=array( "ssl"=>array( "verify_peer"=>false, "verify_peer_name"=>false,),);
        $indication = $request->indic;
        $techRea = $request->techRea;
        $result = $request->result;
        $conclusion = $request->conclusion;
        $etablissement = Etablissement::first();
        $img_path = 'img/' . $etablissement->logo;
        $extencion = pathinfo($img_path, PATHINFO_EXTENSION);
        $data = file_get_contents($img_path, false, stream_context_create($opciones_ssl));
         $img_base_64 = base64_encode($data);
         $path_img = 'data:image/' . $extencion . ';base64,' . $img_base_64;
         return view('examenradio.EtatsSortie.crr',compact('indication','techRea','result','conclusion','etablissement','path_img'))->render();
  }
      public function download($id)
      {
            $crr = CRR::find($id);
            $etablissement = Etablissement::first();
            $pdf = PDF::loadView('examenradio.EtatsSortie.crrPDf',compact('crr','etablissement'));
            return $pdf->stream("crr.pdf");
      }
}