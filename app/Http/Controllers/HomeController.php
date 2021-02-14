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
use App\User;
use Auth; 
use Date;
use route;
use Carbon\Carbon;
use PDF;
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
      switch (Auth::user()->role_id) {
            case 1://medecin & meecinChef
                  return view('patient.index');
                  break;
            case 2:
                  return view('home.home_recep');
                  break;
            case 3:                    
                  return redirect()->action('HospitalisationController@index');// return redirect()->route('HospitalisationController@index');
                  break;
            case 4: //admin// $users = User::all(); // return view('home.home_admin', compact('users'));
                  return redirect()->action('UsersController@index');
                  break;
            case 5:
                  return redirect()->action('RdvHospiController@index');
                  break;
            case 6:
                  return redirect()->action('ColloqueController@index',Auth::user()->employ->Service->type);
                  break;
            case 9: //agent Admission
                    return redirect()->action('AdmissionController@index');
                    break;       
            case 10:
                $meds = medcamte::paginate(50);
                $dispositifs = dispositif::paginate(50);
                $reactifs = reactif::paginate(50);
                return view('home.home_pharmacien', compact('meds','dispositifs','reactifs'));
                break;   
            case 11://Laborantin
                $demandesexb = demandeexb::with('consultation.patient')->where('etat','E')->get();
                return view('home.home_laboanalyses', compact('demandesexb'));
                break;   
            case 12://radiologue
                $demandesexr = demandeexr::with('consultation')->where('etat','E')->get();
                return view('home.home_radiologue', compact('demandesexr')); 
                break;
            case 14://chef de service
                return view('home.home_chef_ser');
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
      $hosp  = hospitalisation::find($request->hosp_id);  
      $filename ="";$pdf;
      $modelName = $model_prefix.'\\'.$request->class_name;
      $date= Carbon::now()->format('Y-m-d'); //$consult  = $className::find($obj_id);
      $obj=$modelName::find( $request->obj_id);
      switch($request->selectDocm) {
        case "1":
            $filename = "RSS-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
            $pdf = PDF::loadView('hospitalisations.EtatsSortie.ResumeStandartSortiePDF', compact('obj'));
            break;
        case "2":
            $filename = "RCS-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
            $pdf = PDF::loadView('hospitalisations.EtatsSortie.ResumeCliniqueSortiePDF', compact('obj'));
            break;
        case "3":
            $filename = "CM-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
            $pdf = PDF::loadView('consultations.EtatsSortie.CertificatMedicalePDF', compact('obj','date'));
            break;
        case "4":
            $filename = "CAM-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
            $pdf = PDF::loadView('hospitalisations.EtatsSortie.AttestationContreAvisMedicalePDF', compact('obj','date'));
            break;
        case "5":
            $filename = "CRO-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
            $pdf = PDF::loadView('hospitalisations.EtatsSortie.CRHPDF', compact('obj','date'));
            break;
         case "6"://Certificat sejour
            // $filename = "CRO-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
            // $pdf = PDF::loadView('hospitalisations.EtatsSortie.CRHPDF', compact('obj','date'));
            break;
        case "7"://Demande orientation
            $filename = "DORT-".$obj->patient->Nom."-".$obj->patient->Prenom.".pdf";
            $pdf = PDF::loadView('consultations.EtatsSortie.DemandeOrientationMedicalePDF', compact('obj','date'));
            break;
        default:
            return response()->json(['html'=>"unknown"]);
            break;
      }
      return $pdf->download($filename); 
    }
}