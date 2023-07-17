<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Traitement;
use App\modeles\visite;
use Carbon\Carbon;
use Validator;
class TraitementController extends Controller
{
    public function index(Request $request)
    {
      $visite = visite::find($request->visId);
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
      return $request->all();
      $rule = array(
        'med_id'=> 'required|string|max:225',
        'visite_id'=> 'required',
        'posologie'=>'required',
        'nbrPJ'=>'required',  
      );
      $messages = [
        "required"     => "Le champ :attribute est obligatoire.", // ,
      ];
      $validator = Validator::make($request->all(), $rule,$messages);
      if($validator->fails())
          return response()->json(['errors'=>$validator->errors()->all()]);
      $visite = visite::find($request->visite_id);
      $trait = $visite->traitements()->create($request->all());
      return response()->json(['success' => "Traitement crée avec suuccés",'trait'=> $trait->load('medicament','visite.medecin')]);
    }
   
    public function update(Request $request,$id)
    {
      $rule = array(
        'med_id'=> 'required|string|max:225',
        'posologie'=>'required',
        'nbrPJ'=>'required'
      );
      $messages = [
        "required"   => "Le champ :attribute est obligatoire.",
      ];
      $validator = Validator::make($request->all(), $rule,$messages);
      if($validator->fails())
        return response()->json(['errors'=>$validator->errors()->all()]);
      $trait = Traitement::FindOrFail($id);
      $trait->update([
        'med_id'=>$request->med_id,
        'posologie'=>$request->posologie,
        'nbrPJ'=>$request->nbrPJ
      ]);
      return response()->json(['success' => "Traitement mis à jour avec suuccés",'trait'=> $trait->load('medicament','visite.medecin')]);
    }
    public function destroy($id)
    {
      $trait = Traitement::destroy($id);
      return $trait;
    }
}
