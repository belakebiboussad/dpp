<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;//use App\modeles\consigne;
use App\modeles\Acte;
use Response;
// use Validator;
class ActeController extends Controller
{
    //
    public function __construct()
      {
          $this->middleware('auth');
      }
	  public function choixhospconsigne()
    {
            return view('consigne.choix_patient_consigne');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */

     public function edit($id)
    {
        $acte = Acte::find($id);//  $consignes = consigne::FindOrFail($id); // return view('consigne.edit_consigne',compact('consignes'));
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
        $acte->update($request->all()); // $acte->remember_token;// $acte->save();
        return Response::json(['acte'=>$acte,'visite'=>$acte->visite,'medecin'=>$acte->visite->medecin]); 
    }
    public function store(Request $request)
    { 
          $this->validate($request, [
            'nom'=> 'required|string|max:225',
             'id_visite'=> 'required',// 'duree'=> 'required', // 'description'=> 'required|string|max:225',// 'periodes'=> 'required'
        ]);
        $acte =Acte::create($request->all());    
        return Response::json(['acte'=>$acte,'visite'=>$acte->visite,'medecin'=>$acte->visite->medecin]); 
    }
    public function destroy($id)
    {
        $acte = Acte::FindOrFail($id);
        $acte -> update([
            "retire"=>1,
        ]);
        $acte->save();
        return Response::json($acte);
    }

}
