<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\salle;
use App\modeles\lit;
use App\modeles\service;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsalles($id)
    {
        $salles = salle::where('id_service',$id)->get();
        return $salles;
    }
    public function index()
    {
        $salles = salle::all();
        return view('Salles.index_salle', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createsalle()
    {
        $services = service::all();
        return view('Salles.create_salle_2', compact('services'));
    }

    public function create($id)
    {
        $idservice = $id;
        return view('Salles.create_salle', compact('idservice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        salle::create([
            "num"=>$request->numsalle,
            "nom"=>$request->nomsalle,
            "max_lit"=>$request->maxlits,
            "bolc"=>$request->bloc,
            "etage"=>$request->etage,
            "etat"=>"bloquée",
            "id_service"=>$request->idservice,
        ]);
        return redirect()->action('SalleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salle = salle::FindOrFail($id);
        $lits = lit::where("id_salle", $salle->id)->get()->all();
        return view('Salles.show_salle', compact('salle','lits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salle = salle::FindOrFail($id);
        $services = service::all();
        return view('Salles.edit_salle', compact('salle','services'));
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
        $salle = salle::FindOrFail($id);
        $salle->update([
            "num"=>$request->numsalle,
            "nom"=>$request->nomsalle,
            "max_lit"=>$request->maxlits,
            "bolc"=>$request->bloc,
            "etage"=>$request->etage,
            "etat"=>$request->etat,
            "id_service"=>$request->service,
        ]);
        return redirect()->action('SalleController@index');
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
}
