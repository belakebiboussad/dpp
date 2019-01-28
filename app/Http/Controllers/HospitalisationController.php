<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\DemandeHospitalisation;
use App\modeles\hospitalisation;
use App\modeles\consultation;
use App\modeles\dem_colloque;
use App\modeles\employ;
use App\modeles\rdv_hospitalisation;
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
           // ->where('demandehospitalisations.etat','programme')
           $employe = employ::where("id",Auth::user()->employee_id)->get()->first();  
           $rdvHospitalisation=rdv_hospitalisation::join('admissions','rdv_hospitalisations.id_admission','=','admissions.id')->join('lits','admissions.id_lit','=','lits.id')->join('salles','lits.salle_id','=','salles.id')->join('demandehospitalisations','admissions.id_demande','=','demandehospitalisations.id')->join('dem_colloques','demandehospitalisations.id','=','dem_colloques.id_demande')->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')->join('patients','consultations.Patient_ID_Patient','=','patients.id')->join('employs','employs.id','=','dem_colloques.id_medecin')->select('rdv_hospitalisations.*','rdv_hospitalisations.id as idRDV','admissions.id_lit','salles.nom as nomsalle','dem_colloques.observation','dem_colloques.ordre_priorite','consultations.Date_Consultation','patients.Nom','patients.Prenom','employs.Nom_Employe','employs.Prenom_Employe','demandehospitalisations.etat','demandehospitalisations.id as iddemande')->where('rdv_hospitalisations.etat_RDVh','en attente')->where('demandehospitalisations.etat','programme')->get();        
          // dd($rdvHospitalisation);
          return view('Hospitalisations.listRDVs_hospitalisation', compact('rdvHospitalisation'));
    }
    public function ajouterRDV()
    {
                $demandes= dem_colloque::join('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')->join('patients','consultations.Patient_ID_Patient','=','patients.id')->select('dem_colloques.*','demandehospitalisations.*','consultations.Date_Consultation','patients.Nom','patients.Prenom')->where('demandehospitalisations.service',$employe->Service_Employe )->where('demandehospitalisations.etat','valide')->get();
                     return view('home.home_surv_med', compact('demandes'));
    }
}
