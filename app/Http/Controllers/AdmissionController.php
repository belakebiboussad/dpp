<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\colloque;
use App\modeles\DemandeHospitalisation;
use App\modeles\Lit;
use App\modeles\admission;
use App\modeles\rdv_hospitalisation;
use App\modeles\service;


class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \App\modeles\colloque
     * @return \App\modeles\DemandeHospitalisation
     * @return \App\modeles\Lit
     * @return \App\modeles\admission
     * @return \App\modeles\rdv_hospitalisation
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
    public function create($id)
    {   
        $demande=demandehospitalisation::join('dem_colloques','demandehospitalisations.id','=','dem_colloques.id_demande')->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')->join('patients','consultations.Patient_ID_Patient','=','patients.id')->select('demandehospitalisations.id as id_demande','demandehospitalisations.*','patients.Nom','patients.Prenom','dem_colloques.ordre_priorite','dem_colloques.observation','consultations.Employe_ID_Employe','consultations.Date_Consultation')->where('demandehospitalisations.id',$id)->get()->first();       
        $services = service::all();
        return view('admission.create_admission', compact('demande','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $adm=admission::create([
            
        "id_demande"=>$request->id_demande,       
        "id_lit"=>$request->lit,
      
       ]);
          rdv_hospitalisation::create([
             "date_RDVh"=>$request->date,
             "heure_RDVh"=>$request->heure_rdvh,   
             "id_admission"=>$adm->id,       
             "etat_RDVh"=>"en attente",
      
       ]);
            $lit = Lit::FindOrFail($request->lit);          
            $lit-> update([
            "affectation"=>1,
            ]);
    $d=admission::select('id_demande')->get();
     $demandes= colloque::join('dem_colloques','colloques.id','=','dem_colloques.id_colloque')->join('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')->join('patients','consultations.Patient_ID_Patient','=','patients.id')->select('demandehospitalisations.id as id_demande','demandehospitalisations.*','colloques.id as id_colloque','colloques.*','patients.Nom','patients.Prenom','dem_colloques.ordre_priorite','dem_colloques.observation')->whereNotIn('demandehospitalisations.id',$d)->get();
      return view('home.home_surv_med', compact('demandes'));    
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
