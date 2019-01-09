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
                           $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')->join('employs','membres.id_employ','=','employs.id')->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')->leftJoin('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')->leftJoin('consultations','demandehospitalisations.id_consultation','=','consultations.id')->leftJoin('patients','consultations.Patient_ID_Patient','=','patients.id')->leftJoin('type_colloques','colloques.type_colloque','=','type_colloques.id')->select('demandehospitalisations.id as id-demande','colloques.id as id_colloque','colloques.*','employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom','type_colloques.type','dem_colloques.id_demande','consultations.Date_Consultation')->get();
                           $colloque= array();
                          foreach( $colloques as $col){
                            if (!array_key_exists($col->id_colloque,$colloque))
                              {
                                    $colloque[$col->id_colloque]= array("dat"=> $col->date_colloque ,"creation"=>$col->date_creation,"Type"=>$col->type,"Etat"=>$col->etat_colloque,"membres"=> array ("$col->Nom_Employe $col->Prenom_Employe"),
                                    "demandes"=>array($col->id_demande=>array(
                                      "id_dem"=>$col->id_demande ,"date_dem"=>$col->Date_demande ,"patient"=>"$col->Nom $col->Prenom")));
                              }
                            else{
                                        if (array_search("$col->Nom_Employe $col->Prenom_Employe", $colloque[$col->id_colloque]["membres"])===false)
                                             $colloque[$col->id_colloque]["membres"][]="$col->Nom_Employe $col->Prenom_Employe";
                                    
                                      if (!array_key_exists($col->id_demande, $colloque[$col->id_colloque]["demandes"])) {      
                                        $colloque[$col->id_colloque]["demandes"][$col->id_demande]=array(
                                          "id_dem"=>$col->id ,"date_dem"=>$col->Date_demande ,"patient"=>"$col->Nom $col->Prenom");
                                      }
                               
                              }
                      }
                     return view('colloques.liste_colloque', compact('colloque'));
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
                break;
           default:
               return view('errors.500');
               break;
           }
    }
}
