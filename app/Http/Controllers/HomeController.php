<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\rol;
use App\modeles\patient;
use App\modeles\Order;
use App\modeles\consultation;
use App\modeles\colloque;
use App\modeles\ticket;
use App\modeles\employ;
use App\modeles\DemandeHospitalisation;
use App\modeles\admission;
use App\modeles\medcamte;
use App\modeles\reactif;
use App\modeles\dispositif;
use App\modeles\demandeexb;
use App\modeles\demandeexr;
use App\User;
use Auth; 
use Date;

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
           $role = rol::FindOrFail(Auth::user()->role_id);
           switch ($role->role) {
                case "Medecine":
                     $date = Date::Now()->toDateString();
                      $patients = patient::all();
                      $employe = employ::where("id",Auth::user()->employee_id)->get()->first();                     
                     $rdvs = ticket::where("specialite",$employe->Specialite_Emploiye)
                                ->where("date",$date)->get();   
                      return view('home.home_med',compact('patients','rdvs'));
                      break;
                case "Receptioniste":
                      return view('home.home_recep');
                      break;
                case "Infermier":
                      return view('home.home_infirmier');
                      break;
              case "administrateur": 
                      $users = User::all();
                     return view('home.home_admin', compact('users'));
                     break;
               case "Surveillant medical":
                          $demandes = consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                                ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                                ->join('employs', 'consultations.Employe_ID_Employe','=','employs.id')
                                ->select('demandehospitalisations.*','consultations.Employe_ID_Employe','consultations.Date_Consultation','patients.Nom','patients.Prenom','patients.Dat_Naissance','employs.Nom_Employe','employs.Prenom_Employe')->get();
                          return view('home.home_surv_med', compact('demandes'));
                          break;
                case "Delegue colloque":
                     $demandes = consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                           ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                           ->join('employs', 'consultations.Employe_ID_Employe','=','employs.id')
                          ->select('demandehospitalisations.*','consultations.Employe_ID_Employe','consultations.Date_Consultation','patients.Nom','patients.Prenom','patients.Dat_Naissance','employs.Nom_Employe','employs.Prenom_Employe')->get();
                      $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')
                           ->join('employs','membres.id_employ','=','employs.id')->join('dem_colloques','colloques.id','=','dem_colloques.id_colloque')
                           ->join('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')
                           ->join('consultations','demandehospitalisations.id_consultation','=','consultations.id')
                           ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                           ->select('demandehospitalisations.id','consultations.Date_Consultation','colloques.id as id_colloque','colloques.*','employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom')
                           ->get();                                    
                     return view('home.home_dele_coll', compact('demandes','colloques'));
                     break;
                case "Chef de service":
                  $meds = medcamte::all();
                  $dispositifs = dispositif::all();
                  $reactifs = reactif::all();
                  return view('home.home_chef_ser', compact('meds','dispositifs','reactifs'));
                case "Pharmacien":
                  $meds = medcamte::all();
                  $dispositifs = dispositif::all();
                  $reactifs = reactif::all();
                  return view('home.home_pharmacien', compact('meds','dispositifs','reactifs'));
                case "Laboratoire d'analyses":
                  $demandesexb = demandeexb::where('etat','E')->get();
                  return view('home.home_laboanalyses', compact('demandesexb'));
                break;
                case 'Radiologue':
                  $demandesexr = demandeexr::where('etat','E')->get();
                  return view('home.home_radiologue', compact('demandesexr'));
                  break;
           default:
               return view('errors.500');
               break;
           }
    }
}
