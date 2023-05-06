<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Traitement;
use App\modeles\visite;
use Carbon\Carbon;
class TraitementController extends Controller
{
    public function index(Request $request)
    {
      $visite = visite::find($request->visId);//with('medecin')->
      return $visite->traitements->load('medicament','medicament.specialite','visite.medecin');
    }
    public function edit($id)
    {
      return Traitement::with('medicament')->FindOrFail($id);
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
      //$this->validate($request, ['med_id'=> 'required|string|max:225','id_visite'=> 'required']);
      $visite = visite::find($request->id_visite);
      $trait = $visite->traitements()->create($request->all());
      return $trait->load('medicament','visite.medecin');
    }
    public function update(Request $request,$id)
    {
      $trait = Traitement::FindOrFail($id);
      $trait->update([
        'visite_id'=>$request->visite_id,
        'med_id'=>$request->med_id,
        'posologie'=>$request->posologie,
        'nbrPJ'=>$request->nbrPJ,
      ]);
      return $trait->load('medicament','visite.medecin');
    }
    public function destroy($id)
    {
      $trait = Traitement::destroy($id);
      return $trait;
    }
}
