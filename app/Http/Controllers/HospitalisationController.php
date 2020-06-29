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
use App\modeles\ModeHospitalisation;
use Jenssegers\Date\Date;
use View;
class HospitalisationController extends Controller
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
      if(Auth::user()->role_id != 9 )
      {    
        $ServiceID = Auth::user()->employ->Service_Employe;
        $hospitalisations = hospitalisation::whereHas('admission.rdvHosp.demandeHospitalisation.Service',function($q) use($ServiceID){
                                              $q->where('id',$ServiceID);  
                                           })->where('etat_hosp','=','en cours')->get();
      }
      else
      {
          $hospitalisations = hospitalisation::where('etat_hosp','=','en cours')->get();
      }
      return view('Hospitalisations.index', compact('hospitalisations'));
      //$e=false;     
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
      {
        $serviceID = Auth::user()->employ->Service_Employe;
        $adms = admission::with('lit','rdvHosp.demandeHospitalisation.DemeandeColloque','rdvHosp.demandeHospitalisation.consultation.patient.hommesConf')->whereHas('rdvHosp', function($q){
                                              $q->where('date_RDVh','=',date("Y-m-d"));
                            })->whereHas('rdvHosp.demandeHospitalisation',function($q) use ($serviceID) {
                                            $q->where('service', $serviceID)->where('etat','admise');//->where('etat','admise')
                                      })->get();
        $medecins = employ::where('Service_Employe',Auth::user()->employ->Service_Employe)->get();
        $modesHosp = ModeHospitalisation::all();
        return view('Hospitalisations.create', compact('adms','medecins','modesHosp'));
      }
       public function createold($id){$demande = DemandeHospitalisation::FindOrFail($id);return view('Hospitalisations.create_hospitalisation', compact('demande'));}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      {        
        $dmission =  admission::find($request->id_admission);  //$dmission =  admission::with('rdvHosp')->find($request->id_admission);
        $hosp = hospitalisation::create([
              "Date_entree"=>$request->Date_entree, //"Date_entree"=>$rdvHospi->date_RDVh,  // "heure_entrée"=>Date("H:i:00"),
               "Date_Prevu_Sortie"=>$request->Date_Prevu_Sortie, //"Heure_Prevu_Sortie"=>$rdvHospi->heure_Prevu_Sortie,
                "Date_Sortie"=>null,
                "patient_id"=>$request->patient_id,
              "id_admission"=>$request->id_admission,
              "garde_id" => (isset($request->garde_id)) ? $request->garde_id : null,
              "modeHosp_id"=>$request->mode,
              "etat_hosp"=>"en cours",
        ]);
        $dmission->rdvHosp->demandeHospitalisation->update(["etat" => "hospitalisation"]);
        $dmission->rdvHosp->update([ "etat_RDVh" => "valide" ]);
         return redirect()->action('HospitalisationController@create'); //return \Redirect::route('HospitalisationController@create');
      }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hosp = hospitalisation::find($id); 
        return View::make('Hospitalisations.show')->with('hosp', $hosp);
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
        return View::make('Hospitalisations.edit')->with('hosp', $hosp)->with('services',$services);
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
      $hosp = hospitalisation::find($id);
      $hosp -> update($request->all()); //$hosp->save();
      return redirect()->action('HospitalisationController@index');
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
    public function affecterLit()
    {
      $ServiceID = Auth::user()->employ->Service_Employe;
      // $rdvHospitalisation = rdv_hospitalisation::whereHas('demandeHospitalisation', function($q){ $q->where('etat', 'programme'); })->with([   'demandeHospitalisation' => function($query) { $query->select('modeAdmission'); }]) ->whereHas('demandeHospitalisation.Service',function($q) use ($ServiceID){$q->where('id',$ServiceID);})->where('etat_RDVh','=','en attente')->with('demandeHospitalisation')->get();  
       return view('Hospitalisations.affecterLits', compact('rdvHospitalisation'));
  }

}
