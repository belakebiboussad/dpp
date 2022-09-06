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
use App\modeles\Specialite;
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
use Dompdf\Dompdf;
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
      $ServiceID = Auth::user()->employ->service_id;
      $etab = Etablissement::first(); 
      Session::put('etabname', $etab->nom);
      Session::put('etabTut', $etab->tutelle);
      Session::put('etabAdr', $etab->adresse);
      Session::put('etabTel', $etab->tel);
      Session::put('etabTel2', $etab->tel2);
      Session::put('etabLogo', $etab->logo);
        switch (Auth::user()->role_id) {
                case 1://medecin & medChef
                       return view('patient.index');
                       break;
               case 15:        
                case 2://rec
                      return view('patient.index'); //return view('home.home_recep');
                      break;
          case 3://inf                    
                return redirect()->action('HospitalisationController@index');
                break;
          case 4: //admin
                return view('home.dashboard'); //return redirect()->action('UsersController@index');
                break;
          case 5://surv
                return redirect()->action('RdvHospiController@index');
                break;
          case 6://colloque
                $specialite = Specialite::findOrFail(Auth::user()->employ->Service->specialite_id);
                if($specialite->dhValid)
                  return redirect()->action('ColloqueController@index');
                else  
                  return view('errors.404');
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
      public function print( $className,$objId,$stateId)
      {
        $model_prefix="App\modeles";
        $filename ; $pdf;
        $modelName = $model_prefix.'\\'.$className;
        $etab = Etablissement::first();
        $date= Carbon::now()->format('d/m/Y');
        $obj=$modelName::find( $objId);
        $etat = Etatsortie::find( $stateId );
        switch($stateId) {
                case "1":
                        $filename = "RSS-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                        $pdf = PDF::loadView('hospitalisations.EtatsSortie.ResumeStandartSortiePDF', compact('etat','obj','etab'));
                        break;
                case "2":
                          $filename = "RCS-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                         $pdf = PDF::loadView('hospitalisations.EtatsSortie.ResumeCliniqueSortiePDF', compact('etat','obj','etab'));
                          break;
                case "3":
                        $filename = "CM-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                        $pdf = PDF::loadView('consultations.EtatsSortie.CertificatMedicalePDF', compact('etat','obj','date','etab'));
                        break;
                case "4":
                        $filename = "CAM-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                        $pdf = PDF::loadView('hospitalisations.EtatsSortie.AttestationContreAvisMedicalePDF', compact('etat','obj','date','etab'));
                        break;
                 case "5":
                      $filename = "CRM-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                      $pdf = PDF::loadView('hospitalisations.EtatsSortie.CRHPDF', compact('etat','obj','date','etab'));
                      break;
                case "6"://Certificat sejour
                      $filename = "CJ-". $obj->demandeHospitalisation->consultation->patient->Nom."-".$obj->demandeHospitalisation->consultation->patient->Prenom;
                      $pdf = PDF::loadView('admission.EtatsSortie.CertificatSejourPDF', compact('etat','obj','date','etab'));
                      break;
                case "7"://Demande orientation
                  $filename = "LORT-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                  $pdf = PDF::loadView('consultations.EtatsSortie.lettreOrientationMedicalePDF', compact('etat','obj','date','etab'));
                  break;
                case "8"://Bulltin Admission
                      if($className == "rdv_hospitalisation")
                      { 
                              $rdv=rdv_hospitalisation::with('demandeHospitalisation.consultation.patient')->find( $objId);
                                $pdf = PDF::loadView('admission.EtatsSortie.BAPDF', compact('etat','rdv','date','etab'));
                      }else
                      {
                        $patient = $obj->consultation->patient;
                        $pdf = PDF::loadView('admission.EtatsSortie.BAPDFUrg', compact('patient','etat','obj','date','etab')); 
                      }
                      $filename = "BA-". $patient->Nom."-".$patient->Prenom.".pdf";
                      break;
                case "9"://Billet de salle
                          if($className == "rdv_hospitalisation")
                          { 
                            $patient = $obj->demandeHospitalisation->consultation->patient;
                            $pdf = PDF::loadView('admission.EtatsSortie.BSPDF', compact('patient','etat','obj','date','etab'));
                          }else
                          {
                            $patient = $obj->consultation->patient;
                            $pdf = PDF::loadView('admission.EtatsSortie.BSPDFUrg', compact('patient','etat','obj','date','etab')); 
                          }
                          $filename = "BS-". $patient->Nom."-".$patient->Prenom.".pdf";
                        break;
                 case "10"://CERTIFICAT DECES
                  $filename = "CERTDECE-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
                  $dece = $obj->Dece;
                  $pdf = PDF::loadView('hospitalisations.EtatsSortie.certificatDecePDF', compact('etat','obj','dece','date','etab'));
                  break;
                default:
                  return Response::json(['html'=>"unknown"]);
                  break;
            }
            return $pdf->download($filename); 
                
                }
    public function getReports($type)
    {
          $etatsortie = Etatsortie::where('type',$type)->get();
          return $etatsortie;
    }
}