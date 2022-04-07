<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\rol;
use App\modeles\patient;
use App\modeles\Order;
use App\modeles\consultation;
use App\modeles\colloque;
use App\modeles\rdv_hospitalisation;
use App\modeles\hospitalisation;
use App\modeles\ticket;
use App\modeles\employ;
use App\modeles\DemandeHospitalisation;
use App\modeles\admission;
use App\modeles\medcamte;
use App\modeles\reactif;
use App\modeles\dispositif;
use App\modeles\dem_colloque;
use App\modeles\demandeexb;
use App\modeles\demandeexr;
use App\modeles\Etablissement;
use App\modeles\Etatsortie;
use App\User;
use Auth; 
use Date;
use route;
use Carbon\Carbon;
use PDF;
use Storage;
use File;
use Session;
use Response;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ServiceID = Auth::user()->employ->service;
      $etablissement = Etablissement::first(); 
      Session::put('etabname', $etablissement->nom);
      Session::put('etabTut', $etablissement->tutelle);
      Session::put('etabAdr', $etablissement->adresse);
      Session::put('etabTel', $etablissement->tel);
      Session::put('etabTel2', $etablissement->tel2);
      Session::put('etabLogo', $etablissement->logo);
      switch (Auth::user()->role_id) {
            case 1://medecin & meecinChef
                  return view('patient.index');
                  break;
            case 2://rec
                   return view('patient.index'); //return view('home.home_recep');
                  break;
            case 3://inf                    
                  return redirect()->action('HospitalisationController@index');
                  break;
            case 4: 
                  //return redirect()->action('UsersController@index');
                  return view('home.dashboard');
                  
                  break;
            case 5:
                  return redirect()->action('RdvHospiController@index');
                  break;
            case 6:
                  return redirect()->action('ColloqueController@index',Auth::user()->employ->Service->type);
                  break;
            case 8:
                  return redirect()->action('StatistiqusController@index');
                  break;      
            case 9: //agent Admission
                    return redirect()->action('AdmissionController@index');
                    break;       
            case 10://phar
                    return redirect()->action('demandeprodController@index');
                    break;   
            case 11://Laborantin
                    return redirect()->action('DemandeExbController@index');
                    break;   
            case 12://radiologue
                     return redirect()->action('DemandeExamenRadio@index');
                break;
            case 13://med chef
                return view('patient.index');

            case 14://chef de service
                return view('patient.index');
            default:
               return view('errors.500');
               break;
       }
    }
    public function flash()
    {
      flashy()->success('You get success notification.', 'hdtuto.com');
      return view('flash');
    }
    public function print(Request $request)
    {
          $model_prefix="App\modeles";
          $filename ; $pdf;
          $modelName = $model_prefix.'\\'.$request->class_name;
          $etablissement = Etablissement::first();
          $date= Carbon::now()->format('d/m/Y'); //$consult  = $className::find($obj_id);
          $obj=$modelName::find( $request->obj_id);
          $etat=Etatsortie::find( $request->selectDocm );
          switch($request->selectDocm) {
            case "1":
                $filename = "RSS-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                $pdf = PDF::loadView('hospitalisations.EtatsSortie.ResumeStandartSortiePDF', compact('etat','obj','etablissement'));
                break;
            case "2":
                $filename = "RCS-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                $pdf = PDF::loadView('hospitalisations.EtatsSortie.ResumeCliniqueSortiePDF', compact('etat','obj','etablissement'));
                break;
            case "3":
                $filename = "CM-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                $pdf = PDF::loadView('consultations.EtatsSortie.CertificatMedicalePDF', compact('etat','obj','date','etablissement'));
                break;
            case "4":
                $filename = "CAM-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                $pdf = PDF::loadView('hospitalisations.EtatsSortie.AttestationContreAvisMedicalePDF', compact('etat','obj','date','etablissement'));
                break;
            case "5":
                $filename = "CRM-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                $pdf = PDF::loadView('hospitalisations.EtatsSortie.CRHPDF', compact('etat','obj','date','etablissement'));
                break;
             case "6"://Certificat sejour
                $filename = "CJ-". $obj->demandeHospitalisation->consultation->patient->Nom."-".$obj->demandeHospitalisation->consultation->patient->Prenom;
                $pdf = PDF::loadView('admission.EtatsSortie.CertificatSejourPDF', compact('etat','obj','date','etablissement'));
                break;
            case "7"://Demande orientation
                $filename = "LORT-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                $pdf = PDF::loadView('consultations.EtatsSortie.lettreOrientationMedicalePDF', compact('etat','obj','date','etablissement'));
                break;
             case "8"://Bulltin Admission
                if($request->class_name == "rdv_hospitalisation")
                { 
                  $patient = $obj->demandeHospitalisation->consultation->patient;
                  $pdf = PDF::loadView('admission.EtatsSortie.BAPDF', compact('patient','etat','obj','date','etablissement'));
                }else
                {
                  $patient = $obj->consultation->patient;
                  $pdf = PDF::loadView('admission.EtatsSortie.BAPDFUrg', compact('patient','etat','obj','date','etablissement')); 
                }
                $filename = "BA-". $patient->Nom."-".$patient->Prenom;
                break;
            case "9"://Billet de salle
                if($request->class_name == "rdv_hospitalisation")
                { 
                  $patient = $obj->demandeHospitalisation->consultation->patient;
                  $pdf = PDF::loadView('admission.EtatsSortie.BSPDF', compact('patient','etat','obj','date','etablissement'));
                }else
                {
                  $patient = $obj->consultation->patient;
                  $pdf = PDF::loadView('admission.EtatsSortie.BSPDFUrg', compact('patient','etat','obj','date','etablissement')); 
                }
                $filename = "BS-". $patient->Nom."-".$patient->Prenom;
                break;
            default:
                return Response::json(['html'=>"unknown"]);
                break;
          }
          return $pdf->download($filename); 
    }    
}