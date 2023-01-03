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
use App\modeles\Dece;
use App\modeles\Etatsortie;
use App\modeles\CIM\chapitre;
use Jenssegers\Date\Date;
use App\modeles\Specialite;
use App\modeles\etablissement;
use App\modeles\prescription_constantes;
use App\modeles\Constantes; 
use App\modeles\consts;
use App\modeles\ModeHospitalisation;
use Carbon\Carbon;
use PDF;//use Dompdf\Dompdf;
use Validator;
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
      public function index(Request $request)
      {
        if($request->ajax())  
        { 
          if(Auth::user()->role_id != 9) {
            if($request->field != 'Nom' && ($request->field != 'IPP'))
            {
              if($request->value != "0")
                $hosps = hospitalisation::with('admission.demandeHospitalisation.Service','patient','modeHospi','medecin','garde')
                              ->whereHas('admission.demandeHospitalisation.Service',function($q){
                                      $q->where('id',Auth::user()->employ->service_id);
                                     })->where(trim($request->field),'LIKE','%'.trim($request->value)."%")->get();
              else
                $hosps = hospitalisation::with('admission.demandeHospitalisation.Service','patient','modeHospi','medecin','garde')
                              ->whereHas('admission.demandeHospitalisation.Service',function($q){
                                        $q->where('id',Auth::user()->employ->service_id);
                                      })->where('etat',null)->get();                                   
                } else
                    $hosps = hospitalisation::with('admission.demandeHospitalisation.Service','patient','modeHospi','medecin','garde')
                            ->whereHas('patient',function($q) use ($request){
                                   $q->where(trim($request->field),'LIKE','%'.trim($request->value)."%");  
                            })->whereHas('admission.demandeHospitalisation.Service',function($q){
                                                      $q->where('id',Auth::user()->employ->service_id);
                            })->get();
              } else
              {
                if($request->field != 'Nom' && ($request->field != 'IPP'))
                {
                  if($request->value != "0")
                    $hosps = hospitalisation::with('admission.demandeHospitalisation.Service','patient','modeHospi','medecin','garde')
                                            ->where(trim($request->field),'LIKE','%'.trim($request->value)."%")->get();
                  else
                    $hosps = hospitalisation::with('admission.demandeHospitalisation.Service','patient','modeHospi','medecin','garde')
                                                            ->where('etat',null)->get();                                   
                } else
                    $hosps = hospitalisation::with('admission.demandeHospitalisation','patient','modeHospi','medecin','garde')
                            ->whereHas('patient',function($q) use ($request){
                                   $q->where(trim($request->field),'LIKE','%'.trim($request->value)."%");  
                            })->get();
            }    
             return $hosps; 
         }else
         {
            $etatsortie = Etatsortie::where('type','0')->get();
            $chapitres = chapitre::all();
            $etab = Etablissement::first();
            $medecins = Auth::user()->employ->Service->employs;
            if(Auth::user()->role_id != 9 )//9:admission
              $hospitalisations = hospitalisation::whereHas('admission.demandeHospitalisation.Service',function($q){//rdvHosp.
                                                    $q->where('id',Auth::user()->employ->service_id);
                                                 })->WhereNull('etat')->get();
            else
              $hospitalisations = hospitalisation::WhereNull('etat')->get();
            return view('hospitalisations.index', compact('hospitalisations','etatsortie','chapitres','medecins','etab'));
       }
      }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
/*public function create(){$serviceID = Auth::user()->employ->service_id;$adms = admission::with('lit','demandeHospitalisation.DemeandeColloque','demandeHospitalisation.consultation.patient.hommesConf','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation','demandeHospitalisation.Service')
->whereHas('rdvHosp', function($q){$q->where('date', date("Y-m-d"));})->whereHas('demandeHospitalisation',function($q) use ($serviceID) {
$q->where('service', $serviceID)->where('etat',2);})->get(); //admission d'urgenes
$admsUrg = admission::with('lit','demandeHospitalisation.consultation.patient.hommesConf','demandeHospitalisation.consultation.medecin','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation','demandeHospitalisation.Service')
->whereHas('demandeHospitalisation.consultation', function($q){$q->where('date',date("Y-m-d"));
})->whereHas('demandeHospitalisation',function($q) use ($serviceID) {$q->where('service', $serviceID)->where('modeAdmission',2)->where('etat',2);                                      })->get();                                                    
        return view('hospitalisations.create', compact('adms','admsUrg'));}*/
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request)
    { 
    }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)//
  {
    $hosp = hospitalisation::find($id);
    if(isset(Auth::user()->employ->specialite))
      $specialite = Auth::user()->employ->Specialite;
    else
      $specialite = Auth::user()->employ->Service->Specialite;
    $consts = consts::all();  
    return view('hospitalisations.show',compact('hosp','consts','specialite'));
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
    $employes = employ::where('service_id',$hosp->admission->demandeHospitalisation->service)->whereHas('User',function($q) {
      $q->whereIn('role_id', [1, 13, 14]);
    })->get();
    $modesHosp = ModeHospitalisation::where('selected',1)->get(); 
    $services =service::where('hebergement',1)->get();
    return view('hospitalisations.edit',compact('hosp','services','employes','modesHosp'));//->with('hosp', $hosp)->with('services',$services);
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
        $messages = array(
          'diagSortie.max' => "Password can not be great than 255 characters.",
        );
        $rule = array(
         'diagSortie'   => 'max:255'
        );
        $validator = Validator::make($request->all(),$rule,$messages); 
        if ($validator->fails()) {
          return redirect()->back()->withInput($request->input())->withErrors($validator->errors());
        }
        $hosp = hospitalisation::find($id);
        if($request->ajax())  
        {
          $input = $request->all();
          $input['hosp_id'] = $hosp->id ;
          $affect = $hosp->admission->demandeHospitalisation->bedAffectation->update(['state'=>1]);
          $hosp->admission->demandeHospitalisation->bedAffectation->lit->update(['affectation'=>null]);
          if($request->modeSortie == "0")
            $transfert = Transfert::create($input);
         if($request->modeSortie == "2")
          {
            $dece = Dece::create($input);
            $hosp->patient->update([ "active"=>0]);//patient decede on, peut pas ajouter de consultation
          }//$hosp->update($request->all());
          $hosp->update([
            "Date_Sortie"=>$request->Date_Sortie,
            "Heure_sortie"=>$request->Heure_sortie,
            "modeSortie"=>$request->modeSortie,
            "resumeSortie"=>$request->resumeSortie,
            "etatSortie"=>$request->etatSortie,
            "diagSortie"=>$request->diagSortie,
            "ccimdiagSortie"=>$request->ccimdiagSortie,
            "etat"=>1,
           ]);
          return $hosp;
        }else
        {
          $hosp->update($request->all());
          return redirect()->action('HospitalisationController@index');  
        }
    }
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function detailHospXHR(Request $request)
  {
    $hosp = hospitalisation::FindOrFail($request->id);
    $view =  view("hospitalisations.inc_hosp",compact('hosp'))->render();
    return response()->json(['html'=>$view]);
  }
  public function  codebarrePrint(Request $request)
  {
    $hosp = hospitalisation::FindOrFail($request->id);
    $filename="etiquette.pdf"; 
    $pdf = PDF::loadView('hospitalisations.EtatsSortie.etiquettePDF',compact('hosp'));
    //->setPaper($customPaper);//plusieure en foramt A4
    // $pdf = PDF::loadView('hospitalisations.EtatsSortie.etiquettePDF', compact('hosp'));//return $pdf->setPaper('a9')->setOrientation('landscape')->stream();
    
    return $pdf->download($filename);   
   }
}