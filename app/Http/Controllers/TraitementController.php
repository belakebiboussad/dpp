<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Traitement;
use Response;
class TraitementController extends Controller
{
    public function edit($id)
    {
        //  $consignes = consigne::FindOrFail($id); // return view('consigne.edit_consigne',compact('consignes'));
        $trait = Traitement::with('medicament.specialite')->find($id);
        return Response::json($trait);
    }
  public function store(Request $request)
  { 
    $this->validate($request, [
        'med_id'=> 'required|string|max:225',
        'visite_id'=> 'required',
    ]);
    $trait =Traitement::create($request->all());//return Response::json($tait);    
    return Response::json(['trait'=>$trait,'medicament'=>$trait->medicament,'visite'=>$trait->visite,'medecin'=>$trait->visite->medecin]); 
  }
  public function destroy($id)
  {
    $trait = Traitement::destroy($id);
    return Response::json($trait);
  }

}
