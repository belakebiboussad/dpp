<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\dem_colloque;
use App\modeles\service;

class RdvHospiController extends Controller
{
    //
	 public function create($id)
    {
      //
    	$demande = dem_colloque::where('dem_colloques.id_demande','=',$id)->first();
      $services = service::all();
      return view('rdvHospi.create', compact('demande','services'));
		}
		public function store(Request $request)
    {
    	$rdv = rdv_hospitalisation::firstOrCreate([
	            "date_RDVh"=>$request->dateEntree,
	            "heure_RDVh"=>$request->heure_rdvh,   
	            "id_admission"=>$adm->id,       
	            "etat_RDVh"=>"en attente",
	            "date_Prevu_Sortie"=>$request->dateSortiePre,
	            "heure_Prevu_Sortie" =>$request->heureSortiePrevue,
        ]); 
    }
}
