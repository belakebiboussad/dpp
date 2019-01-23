<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\colloque;
use App\modeles\consultation;
use App\modeles\employ;
use App\modeles\membre;
use App\modeles\DemandeHospitalisation;
use App\modeles\lit;
use App\modeles\salle;
use App\modeles\service;
use App\modeles\admission;
use App\modeles\dem_colloque;

class listeadmisColloqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \App\modeles\colloque
     * @return \App\modeles\consultation
     * @return \App\modeles\employ
     * @return \App\modeles\membre
     * @return \App\modeles\DemandeHospitalisation
     * @return \App\modeles\Lit
     * @return \App\modeles\salle
     * @return \App\modeles\service
     * @return \App\modeles\admission
     */
    public function index()
    {
   
     $d=admission::select('id_demande')->get();

     $demandes= colloque::join('dem_colloques','colloques.id','=','dem_colloques.id_colloque')->join('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')->join('patients','consultations.Patient_ID_Patient','=','patients.id')->select('demandehospitalisations.id as id_demande','demandehospitalisations.*','colloques.id as id_colloque','colloques.*','patients.Nom','patients.Prenom','consultations.Patient_ID_Patient','dem_colloques.ordre_priorite','dem_colloques.observation')->whereNotIn('demandehospitalisations.id',$d)->get();

    $lits = Lit::join('salles','lits.id_salle','=','salles.id')
                ->join('services','salles.id_service','=','services.id')->select('lits.*','salles.nom as nom_salle','services.id as id_service','services.nom as nom_service')->where([['lits.etat','=','1'],['lits.affectation','=','0'],['salles.etat','=','Non bloquée']])->get();


return view('colloques.listeadmiscolloque', compact('demandes','lits'));
         
    
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
    public function store(Request $request)
    {
        dd($request);
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
