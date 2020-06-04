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
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   
        if(Auth::user()->role_id != 9 )
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
      public function create()
      {
        $serviceID = Auth::user()->employ->Service_Employe;
        $adms = admission::with('lit')->whereHas('rdvHosp', function($q){
                                              $q->where('date_RDVh','=',date("Y-m-d"));
                                      })->whereHas('rdvHosp.demandeHospitalisation',function($q) use ($serviceID) {
                                            $q->where('service', $serviceID);
                                      })->get();
        return view('Hospitalisations.create', compact('adms'));
    }
    public function createold($id)
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
              $rdvHospi =  rdv_hospitalisation::find($request->id_RDV);
              if($rdvHospi->date_RDVh == Date("Y-m-d")) //&& ($rdvHospi->heure_RDVh <= Date("H:i:00"))  
              { 
                      $rdvHospi->etat_RDVh = "valide"; 
                      $rdvHospi->save();
                      $rdvHospi->demandeHospitalisation->setEtatAttribute("admise");
                      $rdvHospi->demandeHospitalisation->save();  
                      hospitalisation::create([
                          "Date_entree"=>$Date_entree, //"Date_entree"=>$rdvHospi->date_RDVh,
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
    public function updatep(Request $request, $id)
    {
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
    public function affecterLit()
    {
      $ServiceID = Auth::user()->employ->Service_Employe;
      // $rdvHospitalisation = rdv_hospitalisation::whereHas('demandeHospitalisation', function($q){ $q->where('etat', 'programme'); })->with([   'demandeHospitalisation' => function($query) { $query->select('modeAdmission'); }]) ->whereHas('demandeHospitalisation.Service',function($q) use ($ServiceID){$q->where('id',$ServiceID);})->where('etat_RDVh','=','en attente')->with('demandeHospitalisation')->get();  
       return view('Hospitalisations.affecterLits', compact('rdvHospitalisation'));
  }

}
