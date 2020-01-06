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
use App\modeles\admission;
use App\modeles\service;

use Jenssegers\Date\Date;
use View;
class HospitalisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       

        $role = Auth::user()->role;
        if($role->id != 9)
        {
    
            $ServiceID = Auth::user()->employ->Service_Employe;
            $hospitalisations = hospitalisation::whereHas('admission.demandeHospitalisation.Service',function($q) use($ServiceID){
                                                  $q->where('id',$ServiceID);  
                                               })->where('etat_hosp','=','en cours')->get();
        }
        else
        {
            $hospitalisations = hospitalisation::where('etat_hosp','=','en cours')->get();
        }
        
        return view('Hospitalisations.index', compact('hospitalisations','e'));
        $e=false;

       
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
        $Date_entree = Date::Now(); 
        // dd($Date_entree);
        $rdvHospi =  rdv_hospitalisation::find($request->id_RDV);
        if( ($rdvHospi->date_RDVh == Date("Y-m-d")) && ($rdvHospi->heure_RDVh <= Date("H:i:00"))) 
        { 
            $rdvHospi->etat_RDVh = "valide"; 
            $rdvHospi->save();
            $rdvHospi->admission->demandeHospitalisation->setEtatAttribute("admise");
            $rdvHospi->admission->demandeHospitalisation->save();  
            hospitalisation::create([
                //"Date_entree"=>$rdvHospi->date_RDVh,
                "Date_entree"=>$Date_entree,
                "heure_entrée"=>Date("H:i:00"),
                "Date_Prevu_Sortie"=>$rdvHospi->date_Prevu_Sortie,
                "Heure_Prevu_Sortie"=>$rdvHospi->heure_Prevu_Sortie,
                "Date_Sortie"=>null,
                "id_admission"=>$rdvHospi->admission->id,
                "etat_hosp"=>"en cours",
            ]);

        }
          
        return \Redirect::route('HomeController@index');
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
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hosp = hospitalisation::find($id); 
        $services =service::all();
        // dd($hosp->admission->demandeHospitalisation->consultation->patient->hommesConf);
        return View::make('Hospitalisations.edit')->with('hosp', $hosp)->with('services',$services);
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
        $ServiceID = $employe->Service_Employe; 
        $rdvHospitalisation = rdv_hospitalisation::whereHas('admission.demandeHospitalisation', function($q){
                                                           $q->where('etat', 'programme');
                                                 })
                                                 ->whereHas('admission.demandeHospitalisation.Service',function($q) use ($ServiceID){
                                                      $q->where('id',$ServiceID);       
                                                 })->where('etat_RDVh','=','en attente')->get();  

        return view('Hospitalisations.listRDVs_hospitalisation', compact('rdvHospitalisation'));
    }
    public function ajouterRDV()
    {
        $employe = employ::where("id",Auth::user()->employee_id)->get()->first();  
        $ServiceID = $employe->Service_Employe;
        $demandes = dem_colloque::whereHas('demandeHosp.Service', function ($q) use ($ServiceID) {
                                           $q->where('id',$ServiceID);                           
                                    })
                                ->whereHas('demandeHosp',function ($q){
                                    $q->where('etat','valide'); 
                                })->get();
        return view('home.home_surv_med', compact('demandes'));

    }

}
