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
                                                 })->where('etat_hosp','=',null)->get();
          else
            $hospitalisations = hospitalisation::where('etat_hosp','=',null)->get();             
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
                                            $q->where('service', $serviceID)->where('etat','admise');//->where('etat','admise')
                                      })->get(); //admission d'urgenes
        $admsUrg = admission::with('lit','demandeHospitalisation.consultation.patient.hommesConf','demandeHospitalisation.consultation.docteur','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation','demandeHospitalisation.Service')
                          ->whereHas('demandeHospitalisation.consultation', function($q){
                                              $q->where('date','=',date("Y-m-d"));
                          })->whereHas('demandeHospitalisation',function($q) use ($serviceID) {
                                            $q->where('service', $serviceID)->where('modeAdmission','2')->where('etat','admise');
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
          "modeHosp_id"=>$request->mode,//"etat_hosp"=>"en cours",
        ]);
    if(isset($dmission->rdvHosp))
    { 
      $admission->rdvHosp->update([ "etat" =>1 ]);
      $admission->rdvHosp->demandeHospitalisation->update(["etat" => "hospitalisation"]);
    }else
      $admission->demandeHospitalisation->update(["etat" => "hospitalisation"]);
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
    return View::make('hospitalisations.teste', compact('hosp','consts'));
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
         {     //lliberer  le lit
               $lit =  $hosp->admission->demandeHospitalisation->bedAffectation->lit;
               $lit->update([
                    "affectation"=> 0,
                ]);
                if($request->modeSortie == "0")
                {
                      $transfert = Transfert::create($request->all());
                       $transfert->hospitalisation()->attach($id);
                }
        return Response::json($hosp ); 
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
                                            })->where('etat_hosp','=',null)->get();                                   
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
                                                    ->where('etat_hosp','=',null)->get();                                   
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
  public function storeconstantes(Request $request)
  {

    $constantes = Constantes::FirstOrCreate([
      "poids" => $request->poids,
      "taille" => $request->taille,
      "PAS" => $request->pas,
      "PAD" => $request->pad,
      "pouls" => $request->pouls,
      "temp" => $request->temp,
      "glycemie" => $request->glycemie,
      "LDL" => $request->cholest,
      "date" => Carbon::now(),//"patient_id" => $request->patient_id,
      "hospitalisation_id" => $request->hosp_id,
    ]);
    return redirect()->back()->with('succes', 'constantes inserer avec success');
  }
  public function store_prescription_constantes(Request $request)
  {
      $prescription_constantes = prescription_constantes::FirstOrCreate([
        "hospitalisation_id" => $request->id_hosp,
        "date_prescription" => Carbon::now(),
        "observation" => $request->observation
      ]);

      if($request->consts != null)
      {
        $prescription_constantes->constantes()->attach($request->consts);
      }

      return redirect()->back()->with('succes', 'prescription inserer avec success');
      
  }

  public function get_poids($id_hosp)
  {
    $poids = constantes::select('poids')->where('hospitalisation_id', $id_hosp)->get();
    return $poids->toArray();
  }

  public function get_days_poids($id_hosp)
  {
    $poids = Constantes::select('date')->where('hospitalisation_id', $id_hosp)->get();
    return $poids->toArray();
  }

  public function get_taille($id_hosp)
  {
    $tailles = Constantes::select('taille')->where('hospitalisation_id', $id_hosp)->get();
    return $tailles->toArray();
  }
  public function get_pas($id_hosp)
  {
    $pas = Constantes::select('pas')->where('hospitalisation_id', $id_hosp)->get();
    return $pas->toArray();
  }

  public function get_pad($id_hosp)
  {
    $pad = Constantes::select('pad')->where('hospitalisation_id', $id_hosp)->get();
    return $pad->toArray();
  }

  public function get_pouls($id_hosp)
  {
    $pouls = Constantes::select('pouls')->where('hospitalisation_id', $id_hosp)->get();
    return $pouls->toArray();
  }

  public function get_temp($id_hosp)
  {
    $temp = Constantes::select('temp')->where('hospitalisation_id', $id_hosp)->get();
    return $temp->toArray();
  }

  public function get_glycemie($id_hosp)
  {
    $glycemie = Constantes::select('glycemie')->where('hospitalisation_id', $id_hosp)->get();
    return $glycemie->toArray();
  }

  public function get_cholest($id_hosp)
  {
    $cholest = Constantes::select('LDL')->where('hospitalisation_id', $id_hosp)->get();//cholest
    return $cholest->toArray();
  }
}