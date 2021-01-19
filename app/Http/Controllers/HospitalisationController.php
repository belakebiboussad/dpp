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
use Response;
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
          if(Auth::user()->role_id != 9 )//9:admission
                $hospitalisations = hospitalisation::whereHas('admission.rdvHosp.demandeHospitalisation.Service',function($q){
                                                  $q->where('id',Auth::user()->employ->service);  
                                               })->where('etat_hosp','=','en cours')->get();
          else
                $hospitalisations = hospitalisation::where('etat_hosp','=','en cours')->get();
          return view('Hospitalisations.index', compact('hospitalisations'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
          $serviceID = Auth::user()->employ->service;
          $adms = admission::with('lit','rdvHosp.demandeHospitalisation.DemeandeColloque','rdvHosp.demandeHospitalisation.consultation.patient.hommesConf','rdvHosp.demandeHospitalisation.Service','rdvHosp.bedReservation')
                            ->whereHas('rdvHosp', function($q){
                                                $q->where('date_RDVh','=',date("Y-m-d"));
                              })->whereHas('rdvHosp.demandeHospitalisation',function($q) use ($serviceID) {
                                              $q->where('service', $serviceID)->where('etat','admise');//->where('etat','admise')
                                        })->get();    
          $medecins = employ::where('service',Auth::user()->employ->service)->get();
          $modesHosp = ModeHospitalisation::all();
          return view('Hospitalisations.create', compact('adms','medecins','modesHosp'));
      }

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
              "patient_id"=>$request->patient_id,
              "id_admission"=>$request->id_admission,
              "garde_id" => (isset($request->garde_id)) ? $request->garde_id : null,
              "modeHosp_id"=>$request->mode,
              "etat_hosp"=>"en cours",
            ]);
            $dmission->rdvHosp->update([ "etat_RDVh" =>1 ]); // $controller = new LitsController; // $controller->affecter($request); //affecter le lit
            $dmission->rdvHosp->demandeHospitalisation->update(["etat" => "hospitalisation"]);
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
          if($request->ajax())  
          {
                $hosp -> update($request->all()); 
                if(isset($request->Date_Sortie))
                     $hosp ->admission->rdvHosp->demandeHospitalisation->update(["etat" => "valide"]);
                return Response::json($hosp ); 
          }else{
                $hosp -> update($request->all());
                return redirect()->action('HospitalisationController@index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function affecterLit()
    {
      $ServiceID = Auth::user()->employ->service;// $rdvHospitalisation = rdv_hospitalisation::whereHas('demandeHospitalisation', function($q){ $q->where('etat', 'programme'); })->with([   'demandeHospitalisation' => function($query) { $query->select('modeAdmission'); }]) ->whereHas('demandeHospitalisation.Service',function($q) use ($ServiceID){$q->where('id',$ServiceID);})->where('etat_RDVh','=',null)->with('demandeHospitalisation')->get();  
      return view('Hospitalisations.affecterLits', compact('rdvHospitalisation'));
  }

}
