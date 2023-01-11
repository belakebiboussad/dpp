<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\CRR;
use App\modeles\demandeexr;
use App\modeles\Demandeexr_Examenradio;
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
    $ex = Demandeexr_Examenradio::FindOrFail($request->exam_id); 
    $crr = CRR::create($request->all());
    $ex->update(["etat" =>1,'crr_id'=>$crr->id]);
    return ['exId'=>$ex->id,'crrId'=>$crr->id];
  }
 	public function edit($id)
 	{
 		return $crr = CRR::find($id);
  }
 	public function update(Request $request, $id)
  {
    $crr = CRR::find($id);
    $crr->update($request->all()); 
    $crr->save();
    return $crr;
  }
  public function print(Request $request)
  {
    $opciones_ssl=array( "ssl"=>array( "verify_peer"=>false, "verify_peer_name"=>false,),);
    $indication = $request->indic;
    $techRea = $request->techRea;
    $result = $request->result;
    $conclusion = $request->conclusion;
    $etab = Etablissement::first();
    $img_path = 'img/' . $etab->logo;
    $extencion = pathinfo($img_path, PATHINFO_EXTENSION);
    $data = file_get_contents($img_path, false, stream_context_create($opciones_ssl));
     $img_base_64 = base64_encode($data);
     $path_img = 'data:image/' . $extencion . ';base64,' . $img_base_64;
     return view('examenradio.EtatsSortie.crr',compact('indication','techRea','result','conclusion','etab','path_img'))->render();
  }
  public function download($id)
  {
    $date=\Carbon\Carbon::today()->format('d/m/Y');
    $crr = CRR::find($id);
    $demande = $crr->examenRadio->Demande;
    if(isset($demande->id_consultation))
    {
      $patient = $demande->consultation->patient;
      $medecin = $demande->consultation->medecin;
    }  
    else
    {
      $patient = $demande->visite->hospitalisation->patient ;
      $medecin = $demande->visite->medecin;
    }
    $pdf = PDF::loadView('examenradio.EtatsSortie.crrPDf',compact('crr','patient','medecin','date'));
    $filename = "CRR-".$patient->Nom."-".$patient->Prenom.".pdf";
    return $pdf->stream($filename);
  }
}