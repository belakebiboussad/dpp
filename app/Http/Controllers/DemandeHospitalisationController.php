<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\patient;
use App\modeles\DemandeHospitalisation;
use App\User;
use App\modeles\employ;
use Auth;
use Jenssegers\Date\Date;

class DemandeHospitalisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeID= employ::where("id",Auth::user()->employee_id)->get()->first()->id ;           
        $demandehospitalisations = DemandeHospitalisation::whereHas('consultation.docteur', function ($q) use ($employeID) {
                        $q->where('id',$employeID);
                    })->get();
        // foreach ($demandehospitalisations as $key => $demande) {
        //     dd($demande);
        // }                    
        return view('demandehospitalisation.index_demande',compact('demandehospitalisations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        $consultation = consultation::FindOrFail($id);
        $patient = patient::FindOrFail($consultation->Patient_ID_Patient); 
        return view('demandehospitalisation.create_demande', compact('patient','consultation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$consultID)
    { 
          
           $a =  DemandeHospitalisation::create([
            "modeAdmission"=>$request->modeAdmission,
            "service"=>$request->service,
            "specialite"=>$request->specialiteDemande,
           // "degree_urgence"=>$request->degreurg,
            "id_consultation"=>$consultID,
            "etat " =>"en attente",
            ]);  
   }
    public function storeOLD(Request $request)
    {
        $date = Date::Now();
        DemandeHospitalisation::create([
            "motif"=>$request->motif,
            "service"=>$request->service,
            "description"=>$request->description,
            "degree_urgence"=>$request->degreeurg,
            "id_consultation"=>$request->id_consultation,
            "Date_demande"=>$date,
        ]);
        return redirect()->action('ConsultationsController@show',['id'=>$request->id_consultation]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demande = DemandeHospitalisation::FindOrFail($id);
        return view('demandehospitalisation.show_demande',compact('demande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demande = DemandeHospitalisation::FindOrFail($id);
        $consultation = consultation::FindOrFail($demande->id_consultation);
        $patient = patient::FindOrFail($consultation->Patient_ID_Patient);
        return view('demandehospitalisation.edit_demande', compact('demande','patient','consultation'));
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
        $demande = DemandeHospitalisation::FindOrFail($id);
        $demande->update([
            "degree_urgence"=>$request->degreeurg,
            "service"=>$request->service,
        ]);
        return redirect()->action('DemandeHospitalisationController@show',['id'=>$demande->id]);
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
