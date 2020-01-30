<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consigne;
use App\modeles\Acte;
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
        $consignes = consigne::FindOrFail($id);

     return view('consigne.edit_consigne',compact('consignes'));
    }

     public function show($id)
    {
        $consigne = consigne::FindOrFail($id);
        return view('consigne.show_consigne',compact('consigne'));
    }
    public function update(Request $request,$id)
    {
        $consigne = consigne::FindOrFail($id);

        $consigne -> update([
            "app"=>$request->app,
            "consigne"=>$request->consigne,
           
        ]);
        
        return redirect(Route('consigne.show',$consigne->id));
    }
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nom'=> 'required|string|max:225',
        //     'id_visite'=> 'required',
        //     'duree'=> 'required',
        //     'description'=> 'required|string|email|max:225|unique:users',
        //     'periodes'=> 'required|array'
        // ]);

        // $acte =Acte::create($request->all());
        // return Response::json($acte);
        $acte = new Acte;
        $acte->nom = $request->nom;
        $acte->id_visite = $request->id_visite;
        $acte->duree = $request->duree;
        $acte->description = $request->description;
        $acte->periodes = json_encode($request->periodes);
        $acte->remember_token;
        $acte->save();
    }

}
