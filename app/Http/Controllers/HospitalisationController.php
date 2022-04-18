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
use App\modeles\Transfert;
use App\modeles\Etatsortie;
use App\modeles\CIM\chapitre;
use Jenssegers\Date\Date;
use App\modeles\Specialite;
use App\modeles\etablissement;
use App\modeles\prescription_constantes;
use App\modeles\Constantes; 
use App\modeles\consts;
use Carbon\Carbon;
use PDF;//use Dompdf\Dompdf;
use View;
use Response;
use Storage;
use File;
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
        $etatsortie = Etatsortie::where('type','0')->get();
        $chapitres = chapitre::all();
        $etablissement = Etablissement::first();
        $medecins = employ::where('service',Auth::user()->employ->service)->get();
       
        if(Auth::user()->role_id != 9 )//9:admission
          $hospitalisations = hospitalisation::whereHas('admission.demandeHospitalisation.Service',function($q){//rdvHosp.
                                                $q->where('id',Auth::user()->employ->service);
                                               })->where('etat','=',null)->get();
          else
          $hospitalisations = hospitalisation::where('etat','=',null)->get();             
          return view('hospitalisations.index', compact('hospitalisations','etatsortie','chapitres','medecins','etablissement'));
     }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
      public function create()
      {
        $serviceID = Auth::user()->employ->service;
        $adms = admission::with('lit','demandeHospitalisation.DemeandeColloque','demandeHospitalisation.consultation.patient.hommesConf','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation','demandeHospitalisation.Service')
                          ->whereHas('rdvHosp', function($q){
                                              $q->where('date','=',date("Y-m-d"));
                            })->whereHas('demandeHospitalisation',function($q) use ($serviceID) {
                                            $q->where('service', $serviceID)->where('etat',2);//->where('etat','admise')
                                      })->get(); //admission d'urgenes
        $admsUrg = admission::with('lit','demandeHospitalisation.consultation.patient.hommesConf','demandeHospitalisation.consultation.medecin','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation','demandeHospitalisation.Service')
                          ->whereHas('demandeHospitalisation.consultation', function($q){
                                              $q->where('date',date("Y-m-d"));
                          })->whereHas('demandeHospitalisation',function($q) use ($serviceID) {
                                            $q->where('service', $serviceID)->where('modeAdmission',2)->where('etat',2);
                                      })->get();                                                    
        return view('hospitalisations.create', compact('adms','admsUrg'));
      }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
      public function store(Request $request)
      { 
        $today = Carbon::now()->format('Y-m-d');
        $admission =  admission::find($request->id_admission); 
        $hosp = hospitalisation::create([
          "Date_entree"=>$today,//>$request->Date_entree,
          "Date_Prevu_Sortie"=>$request->Date_Prevu_Sortie,
          "patient_id"=>$admission->demandeHospitalisation->consultation->patient->id,//$request->patient_id,
          "id_admission"=>$request->id_admission,
          'medecin_id'=>$request->medecin,
          "garde_id" => (isset($request->garde_id)) ? $request->garde_id : null,
          "modeHosp_id"=>$request->mode,//"etat"=>"en cours",
        ]);
    if(isset($dmission->rdvHosp))
    { 
      $admission->rdvHosp->update([ "etat" =>1 ]);
      $admission->rdvHosp->demandeHospitalisation->update(["etat" =>3]);
    }else
      $admission->demandeHospitalisation->update(["etat" =>3]);
    return redirect()->action('HospitalisationController@index');
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
    $consts = consts::all();
    $specialite = Specialite::findOrFail($employe = Auth::user()->employ->specialite);
    return View::make('hospitalisations.show', compact('hosp','consts','specialite'));
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
    return View::make('hospitalisations.edit')->with('hosp', $hosp)->with('services',$services);
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
      $hosp -> update($request->all());
      if($request->ajax())  
      {    
         $lit =  $hosp->admission->demandeHospitalisation->bedAffectation->lit; //lliberer  le lit
         $lit->update([
              "affectation"=> 0,
          ]);
          if($request->modeSortie == "0")
          {
                $transfert = Transfert::create($request->all());
                 $transfert->hospitalisation()->attach($id);
          }
        return $hosp;
      }else
        return redirect()->action('HospitalisationController@index');
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function affecterLit()
  {
    $ServiceID = Auth::user()->employ->service;
    return view('hospitalisations.affecterLits', compact('rdvHospitalisation'));
  }
  public function getHospitalisations(Request $request)
  { 
    if($request->ajax())  
    {  
      if(Auth::user()->role_id != 9){
        if($request->field != 'Nom' && ($request->field != 'IPP'))
        {
          if($request->value != "0")   
            $hosps = hospitalisation::with('admission.demandeHospitalisation.DemeandeColloque.medecin','patient','modeHospi','medecin')
                                    ->whereHas('admission.demandeHospitalisation.Service',function($q){
                                            $q->where('id',Auth::user()->employ->service);
                                           })->where(trim($request->field),'LIKE','%'.trim($request->value)."%")->get();
          else
            $hosps = hospitalisation::with('admission.demandeHospitalisation.DemeandeColloque.medecin','patient','modeHospi','medecin')
                                    ->whereHas('admission.demandeHospitalisation.Service',function($q){
                                              $q->where('id',Auth::user()->employ->service);
                                            })->where('etat','=',null)->get();                                   
        }
        else
            $hosps = hospitalisation::with('admission.demandeHospitalisation.DemeandeColloque.medecin','patient','modeHospi','medecin')
                    ->whereHas('patient',function($q) use ($request){
                           $q->where(trim($request->field),'LIKE','%'.trim($request->value)."%");  
                    })->whereHas('admission.demandeHospitalisation.Service',function($q){
                                              $q->where('id',Auth::user()->employ->service);
                                })->get();
      }else
      {
        if($request->field != 'Nom' && ($request->field != 'IPP'))
        {
          if($request->value != "0")   
            $hosps = hospitalisation::with('admission.demandeHospitalisation.DemeandeColloque.medecin','patient','modeHospi','medecin')
                                    ->where(trim($request->field),'LIKE','%'.trim($request->value)."%")->get();
          else
            $hosps = hospitalisation::with('admission.demandeHospitalisation.DemeandeColloque.medecin','patient','modeHospi','medecin')
                                                    ->where('etat','=',null)->get();                                   
        }
        else
            $hosps = hospitalisation::with('admission.demandeHospitalisation.DemeandeColloque.medecin','patient','modeHospi','medecin')
                    ->whereHas('patient',function($q) use ($request){
                           $q->where(trim($request->field),'LIKE','%'.trim($request->value)."%");  
                    })->get();
      }    
      return Response::json($hosps);
    }
  }
  public function detailHospXHR(Request $request)
  {
    $hosp = hospitalisation::FindOrFail($request->id);
    $view =  view("hospitalisations.inc_hosp",compact('hosp'))->render();
    return response()->json(['html'=>$view]);
  }
  public function  codebarrePrint(Request $request)
  {
    $hosp = hospitalisation::FindOrFail($request->id);
    //$etablissement = Etablissement::first();// ,'img'=>$img// ,'etablissement'=>$etablissement
    $filename="etiquette.pdf"; 
    $pdf = PDF::loadView('hospitalisations.EtatsSortie.etiquettePDF',compact('hosp'));//->setPaper($customPaper);//plusieure en foramt A4
    // $pdf = PDF::loadView('hospitalisations.EtatsSortie.etiquettePDF', compact('hosp'));//return $pdf->setPaper('a9')->setOrientation('landscape')->stream();
     return $pdf->download($filename);   
   }
  public function getConstData(Request $request)
  {
    $data = Constantes::select($request->const_name)->whereNotNull($request->const_name)->where('hospitalisation_id', $request->hosp_id)->get();
    return $data ;
  }
}