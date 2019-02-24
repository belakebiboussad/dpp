<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consigne;

class ConsigneController extends Controller
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
}
