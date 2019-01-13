<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\lit;
use App\modeles\salle;
use App\modeles\service;

class LitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $lits=lit::join('salles','lits.id_salle','=','salles.id')->select('lits.*','salles.nom as nomSalle')->get();
        return view('lits.index_lit', compact('lits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createlit()
    {
        $services = service::all();
        return view('lits.create_lit_2', compact('services'));
    }

    public function create($id_salle)
    {
        return view('lits.create_lit',compact('id_salle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $etat = 1;
           if(isset($_POST['etat']) )
                 $etat = 0;  
           $l=  lit::create([
                    "num"=>$request->numlit,
                    "nom"=>$request->nom,
                    "etat"=>$etat,
                    "affectation"=>0,
                    "id_salle"=>$request->chambre,
        ]);
        return redirect()->action('LitsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lit = lit::FindOrFail($id);
        $salle = salle::FindOrFail($lit->id_salle);
        $service = service::FindOrFail($salle->id_service);
        return view('lits.show_lit', compact('lit','service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lit = lit::FindOrFail($id);
        $salles = salle::all();
        return view('lits.edit_lit', compact('lit','salles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $lit = lit::FindOrFail($id);
           $etat =$lit->etat ;
           if(isset($_POST['etat']) )
                 $etat = 0;   
           //dd($etat);  
           $lit->update([
                "num"=>$request->numlit,
                "nom"=>$request->nom,
                "etat"=>$etat,
                "affectation"=>$request->affectation,
                "id_salle"=>$request->salle,
        ]);
        return redirect()->action('LitsController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

/**
function ajax return lits
*/
public function getlits($salleid)
{
        $lits = lit::where('id_salle',$salleid)->get();
        return $lits;
}

}
