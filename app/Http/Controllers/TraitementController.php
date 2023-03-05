<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Traitement;
use App\modeles\visite;
use Carbon\Carbon;
class TraitementController extends Controller
{
    public function index($visId)
    {
      $visite = visite::find($visId);
      return $visite->traitements;
    }
    public function edit($id)
    {//  $consignes = consigne::FindOrFail($id);//return view('consigne.edit_consigne',compact('consignes'));
      $trait = Traitement::FindOrFail($id);
      return $trait->load('medicament');
    }
    public function show($id)
    {
      $date= Carbon::now()->format('d/m/Y'); 
      $trait = Traitement::FindOrFail($id);
      $view = view("soins.ajax_trait_details",compact('trait','date'))->render();
      return($view);
    }
    public function store(Request $request)
    { 
      $this->validate($request, ['med_id'=> 'required|string|max:225','visite_id'=> 'required']);
      $trait =Traitement::create($request->all());//return Response::json($tait);    
      return ['trait'=>$trait,'medicament'=>$trait->medicament,'visite'=>$trait->visite,'medecin'=>$trait->visite->medecin]; 
    }
    public function update(Request $request,$id)
    {
      $trait = Traitement::FindOrFail($id);
      $trait->update($request->all());
      return ['trait'=>$trait,'medicament'=>$trait->medicament,'visite'=>$trait->visite,'medecin'=>$trait->visite->medecin]; 
    }
    public function destroy($id)
    {
      $trait = Traitement::destroy($id);
      return $trait;
    }
}
