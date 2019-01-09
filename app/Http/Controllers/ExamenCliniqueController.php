<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\examen_cliniqu;
use Illuminate\Support\Facades\Auth;
class ExamenCliniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, $consultID)
    {

             examen_cliniqu::firstOrCreate([
                    "taille"=>$request->taille,
                    "poids"=>$request->poids,
                    "temp"=>$request->temp,
                    "autre" =>$request->autre,
                    "IMC"=>$request->imc,
                    "Etat"=>$request->etatgen,
                    "peaupha" =>$request->peaupha,
                    "id_consultation"=>$consultID,
             ]);
    }
    public function storeOlD(Request $request, $id)
    {
  
        examen_cliniqu::firstOrCreate([
            "taille"=>$request->taille,
            "poids"=>$request->poids,
            "IMC"=>$request->imc,
            "Etat"=>$request->etatgen,
            "id_consultation"=>$request->cons_id,
        ]);
        return redirect()->action('ConsultationsController@show',['id'=>$request->cons_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
