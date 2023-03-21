<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;//use App\modeles\consigne;
use App\modeles\Acte;
use App\modeles\visite;
//use App\modeles\consigne;
use App\modeles\ActeExec;// use Validator;
class ActeController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $visite = visite::find($request->visId);
      return $visite->actes()->active()->get();
    }
    public function edit(Acte $acte )
    { 
      return $acte;
    }
/*public function show($id)  {$consigne = consigne::FindOrFail($id);return view('consigne.show_consigne',compact('consigne')); }*/
    public function update(Request $request, $id )//Acte $acte
    {
      $acte = Acte::find($id);
      if($request->ajax())
      {
        $acte->update([
          'nom'=>$request->nom,
          'type'=>$request->type,
          'code_ngap'=>$request->code_ngap,     
          'description'=>$request->description,
          'nbrFJ'=>$request->nbrFJ,
        ]);
        return $acte->load('visite.medecin');
      }else
      {
        $acte->update($request->all());
        return(['acte'=>$acte,'visite'=>$acte->visite,'medecin'=>$acte->visite->medecin]);
      }
    }
    public function store(Request $request)
    { 
      $this->validate($request, [
        'nom'=> 'required|string|max:225',
        'id_visite'=> 'required',// 'duree'=> 'required','description'=> 'required|string|max:225','periodes'=> 'required'
      ]);
      $visite = visite::find($request->id_visite); 
      $acte = $visite->actes()->create($request->all());
      return $acte->load('visite.medecin');
    }
    public function destroy($id)
    { 
      $acte = Acte::find($id);
      $acte -> update([ "retire"=>1]);
      return $acte;
    }
    public function run($id)
    {
      $exec = ActeExec::FindOrFail($id);
    }


}
