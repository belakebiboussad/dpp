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
      return $visite->traitements->load('medicament','visite.medecin');
    }
    public function edit($id)
    {
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
