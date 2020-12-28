<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Traitement;
use Response;
class TraitementController extends Controller
{
  public function store(Request $request)
  { 
    $this->validate($request, [
        'med_id'=> 'required|string|max:225',
        'visite_id'=> 'required',
    ]);
    $tait =Traitement::create($request->all());    
    //return Response::json($tait);
     return Response::json(['acte'=>$acte,'visite'=>$acte->visite,'medecin'=>$acte->visite->medecin]); 
  }

}
