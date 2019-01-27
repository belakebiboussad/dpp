<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\DemandeHospitalisation;
use App\modeles\hospitalisation;
use App\modeles\consultation;
use App\modeles\dem_colloque;
use App\modeles\employ;
use Illuminate\Support\Facades\Auth;
class HospitalisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitalisations = consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                                                        ->join('hospitalisations','hospitalisations.id_demande','=','demandehospitalisations.id')
                                                        ->select('demandehospitalisations.*','hospitalisations.*','consultations.Employe_ID_Employe','Patient_ID_Patient')
                                                        ->get();
        return view('Hospitalisations.index_hospitalisation', compact('hospitalisations'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $demande = DemandeHospitalisation::FindOrFail($id);
        return view('Hospitalisations.create_hospitalisation', compact('demande'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       hospitalisation::create([
        "Date_entree"=>$request->date,
        "Date_Prevu_Sortie"=>$request->dateprevu,
        "Date_Sortie"=>null,
        "id_demande"=>$request->id_demande,
       ]);
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
    public function updatep(Request $request, $id)
    {
        //
       dd("update");
    }
     public function update(Request $request)
    {
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
    public function getlisteRDVs()
    {
           $employe = employ::where("id",Auth::user()->employee_id)->get()->first();  
           $demandes= dem_colloque::join('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')->join('patients','consultations.Patient_ID_Patient','=','patients.id')->select('dem_colloques.*','demandehospitalisations.*','consultations.Date_Consultation','patients.Nom','patients.Prenom')->where('demandehospitalisations.service',$employe->Service_Employe )->where('demandehospitalisations.etat','programme')->get();
           // dd("erezr"); 
          return view('Hospitalisations.listRDVs_hospitalisation', compact('demandes'));

    }
}
