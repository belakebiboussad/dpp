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
use App\modeles\Etatsortie;
use App\modeles\CIM\chapitre;
use Jenssegers\Date\Date;
use Carbon\Carbon;
use PDF;
use Dompdf\Dompdf;
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
      if(Auth::user()->role_id != 9 )//9:admission
            $hospitalisations = hospitalisation::whereHas('admission.rdvHosp.demandeHospitalisation.Service',function($q){
                                              $q->where('id',Auth::user()->employ->service);  
                                           })->where('etat_hosp','=','en cours')->get();
      else
            $hospitalisations = hospitalisation::where('etat_hosp','=','en cours')->get();
      
      return view('hospitalisations.index', compact('hospitalisations','etatsortie','chapitres'));
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
          return view('hospitalisations.create', compact('adms','medecins','modesHosp'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     { 
            $dmission =  admission::find($request->id_admission); 
            $hosp = hospitalisation::create([
              "Date_entree"=>$request->Date_entree,
              "Date_Prevu_Sortie"=>$request->Date_Prevu_Sortie,
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
         return View::make('hospitalisations.show')->with('hosp', $hosp);
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
           if($request->ajax())  
            {
              $hosp -> update($request->all());  // if(isset($request->Date_Sortie)) //$hosp ->admission->rdvHosp->demandeHospitalisation->update(["etat" => "valide"]);
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
            $ServiceID = Auth::user()->employ->service;
            return view('hospitalisations.affecterLits', compact('rdvHospitalisation'));
     }
    public function getHospitalisations(Request $request)
    { 
          if($request->ajax())  
          {           
               if($request->field != 'patientName')
                    $hosps = hospitalisation::with('admission.demandeHospitalisation.DemeandeColloque.medecin','patient','modeHospi')
                                 ->where(trim($request->field),'LIKE','%'.trim($request->value)."%")->get();
                else
                {
                     $value =  $request->value;
                     $hosps = hospitalisation::with('admission.demandeHospitalisation.DemeandeColloque.medecin','patient','modeHospi')
                                                          ->whereHas('patient',function($q) use ($value){
                                                                          $q->where('Nom','LIKE','%'.trim($value)."%");  
                                                          })->get();
                }  
               return Response::json($hosps);
          }
    }
    public function printVrai(Request $request)
    {
      $date= Carbon::now()->format('Y-m-d');$hosp  = hospitalisation::find($request->hosp_id); 
      switch($request->selectDocm) {
                case "Résumé standard de sortie":
                    $filename = "RSS-".$hosp->patient->Nom."-".$hosp->patient->Prenom.".pdf";
                     $html = View::make('hospitalisations.EtatsSortie.ResumeStandartSortiePDF',array('hosp' =>$hosp))->render();   
                    break;
                case "Résumé clinique de sortie":
                     $filename = "RCS-".$hosp->patient->Nom."-".$hosp->patient->Prenom.".pdf";
                     $html = View::make('hospitalisations.EtatsSortie.ResumeCliniqueSortiePDF',array('hosp' =>$hosp))->render(); 
                    break;
                case "Certificat medical":
                    $filename = "CerM-".$hosp->patient->Nom."-".$hosp->patient->Prenom.".pdf";
                    $html = View::make('hospitalisations.EtatsSortie.CertificatMedicalePDF',array('hosp' =>$hosp))->render(); 
                    break;
                case "Attestation Contre Avis Medical":
                    $filename = "CAM-".$hosp->patient->Nom."-".$hosp->patient->Prenom.".pdf";
                    $html = View::make('hospitalisations.EtatsSortie.AttestationContreAvisMedicalePDF',array('hosp' =>$hosp,'date'=>$date))->render(); 
                    break;  
                default:
                    return response()->json(['html'=>"unknown"]);
                    break;
          } 
          
     }
    public function imprimer(Request $request)
    {
      $filename ="";
      $date= Carbon::now()->format('Y-m-d');
      $hosp  = hospitalisation::find($request->hosp_id);  
      view()->share('hosp', $hosp);
      switch($request->selectDocm) {
            case "Résumé standard de sortie":
              $filename = "RSS-".$hosp->patient->Nom."-".$hosp->patient->Prenom.".pdf";
              $pdf = PDF::loadView('hospitalisations.EtatsSortie.ResumeStandartSortiePDF', compact('hosp'));
              break;
            case "Résumé clinique de sortie":
              $filename = "RCS-".$hosp->patient->Nom."-".$hosp->patient->Prenom.".pdf";
              $pdf = PDF::loadView('hospitalisations.EtatsSortie.ResumeCliniqueSortiePDF', compact('hosp'));
              break;
            case "Certificat medical":
              $filename = "CerM-".$hosp->patient->Nom."-".$hosp->patient->Prenom.".pdf";
              $pdf = PDF::loadView('hospitalisations.EtatsSortie.CertificatMedicalePDF', compact('hosp'));
              break;
            case "Attestation Contre Avis Medical":
              $filename = "CAM-".$hosp->patient->Nom."-".$hosp->patient->Prenom.".pdf";
              $pdf = PDF::loadView('hospitalisations.EtatsSortie.AttestationContreAvisMedicalePDF', compact('hosp','date'));
              break;  
            default:
               return response()->json(['html'=>"unknown"]);
               break;
      }
      return $pdf->download($filename);    
    }
}