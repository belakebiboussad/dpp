<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\patient;
use App\modeles\DemandeHospitalisation;
use App\modeles\dem_colloque;
use App\User;
use App\modeles\employ;
use App\modeles\colloque;
use App\modeles\service;
use App\modeles\Specialite;
use Auth;
use Response;

class DemandeHospitalisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
      {
          $this->middleware('auth');
      }
      public function index()
      {
        $specialiteID = (employ::findOrFail(Auth::user()->employe_id))->Service->specialite_id;
        if(Auth::user()->role_id == 6)
          $demandes = DemandeHospitalisation::where('specialite',$specialiteID)->whereNull('etat')->get();  
        else
        {
          if(in_array(Auth::user()->role_id,[14])) 
          {
            $demandes = DemandeHospitalisation::where('specialite',$specialiteID)->get();  
          }
          else
          {
            $employeID = Auth::user()->employe_id;
            $demandes = DemandeHospitalisation::whereHas('consultation.medecin', function ($q) use ($employeID) {
                                                  $q->where('id',$employeID);
                                              })->get();  
          }    
        }
        return view('demandehospitalisation.index',compact('demandes'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->ajax())  
      {
        $dh =DemandeHospitalisation::create($request->all());
        return $dh;
      }      
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
      return view('demandehospitalisation.show',compact('demande'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function edit(Request $request, $id)
      {
        $demande = DemandeHospitalisation::FindOrFail($id);
        if($request->ajax())  
        {
          return $demande;
        }else
        {
          $services = service::all();
          $specialites = Specialite::all();
          $modesAdmission =DemandeHospitalisation::MODESADMISSION;
          return view('demandehospitalisation.edit', compact('demande','services','specialites','modesAdmission'));
          }
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
      if($request->ajax())  
      {
        $dh = DemandeHospitalisation::find($id);
        $dh -> update($request->all());
        return $dh;
      }else
      {
        $demande = DemandeHospitalisation::FindOrFail($id);
        $demande->update($request->all());        
        return redirect()->action('DemandeHospitalisationController@index');
      }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy(Request $request,$id)
      {
        $demande = DemandeHospitalisation::destroy($id);
        if($request->ajax())        
          return $demande;
        else
          return redirect()->action('DemandeHospitalisationController@index'); 
      }
      public function valider(Request $request)
      {
        $dem = dem_colloque::firstOrCreate($request->except('_token'));
        $demande  =  DemandeHospitalisation::FindOrFail($request->id_demande); 
        $demande->update(["etat" => 5]);
        return $demande;
      }
    public function invalider(Request $request)
    {
      $demande  = DemandeHospitalisation::FindOrFail($request->id_demande);
      $colloque = colloque::find($request->id_colloque);
      $colloque->demandes()->detach($request->id_demande);
      $demande->update(["etat" => null]);
      return $demande;
    }
    public function getUrgDemanades($date)
    {
      // etat 1 = programé à l'affectation du lit par le surv
      $demandesUrg = DemandeHospitalisation::with('consultation.patient','Service','bedAffectation.lit.salle.service')
                                                      ->whereHas('consultation',function($q) use($date){
                                                              $q->where('date', $date);
                                                      }) ->where('modeAdmission',2)->where('etat',1)->get();
      return json_encode($demandesUrg);        
    }
}
