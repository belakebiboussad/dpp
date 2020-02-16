<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use App\modeles\consigne;
use App\modeles\Acte;
use Response;
// use Validator;
class ActeController extends Controller
{
    //
	  public function choixhospconsigne()
    {
    	   
         
     return view('consigne.choix_patient_consigne');
     //   return view('visite.choix_patient_visite');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */

     public function edit($id)
    {
        //  $consignes = consigne::FindOrFail($id); // return view('consigne.edit_consigne',compact('consignes'));
        $acte = Acte::find($id);
        return Response::json($acte);
    }

     public function show($id)
    {
        $consigne = consigne::FindOrFail($id);
        return view('consigne.show_consigne',compact('consigne'));
    }
    public function update(Request $request,$id)
    {
        $acte = Acte::FindOrFail($id);
        $acte -> update([
            "nom"=>$request->nom,
            "id_visite"=>$request->id_visite,
            "description"=>$request->description,
            "periodes"=>json_encode($request->periodes),
            "duree"=>$request->duree,         
        ]);
        $acte->remember_token;
        $acte->save();
      
        return Response::json($acte);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom'=> 'required|string|max:225',
             'id_visite'=> 'required',
            // 'duree'=> 'required',
            // 'description'=> 'required|string|max:225',
            // 'periodes'=> 'required'
        ]); // $acte =Acte::create($request->all());    
        $acte = new Acte;
        $acte->nom = $request->nom;
        $acte->id_visite = $request->id_visite;
        $acte->duree = $request->duree;
        $acte->description = $request->description;
        $acte->periodes = json_encode($request->periodes);
        $acte->remember_token;
        $acte->save();
        return Response::json($acte);
    }
    public function destroy($id)
    {
       $acte = Acte::FindOrFail($id);
        $acte -> update([
            "retire"=>1,
        ]);
        $acte->remember_token;
        $acte->save();
        return Response::json($homme);
    }

}
