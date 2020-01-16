<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\rol;
use App\modeles\patient;
use App\modeles\Order;
use App\modeles\consultation;
use App\modeles\colloque;
use App\modeles\rdv_hospitalisation;
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
use Flashy;
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
          $role =Auth::user()->role ; //dd($role);
          $employe = employ::where("id",Auth::user()->employee_id)->get()->first(); 
          $ServiceID = $employe->Service_Employe;
          switch ($role->id) {
                case 1:
                      return view('patient.index_patient');
                      break;
                case 2:
                      return view('home.home_recep');
                      break;
                case 3:
                      return view('home.home_infirmier');
                      break;
                case 4: 
                      $users = User::all();
                      return view('home.home_admin', compact('users'));
                      return view('user.listeusers', compact('users'));
                      break;
                case 5:
                      $demandes = dem_colloque::whereHas('demandeHosp.Service', function ($q) use ($ServiceID) {
                                           $q->where('id',$ServiceID);                           
                                    })
                                ->whereHas('demandeHosp',function ($q){
                                    $q->where('etat','valide'); 
                                })->get();
                     return view('home.home_surv_med', compact('demandes'));
                     break;
                case 6:
                      $colloque= array();
                      $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')
                                         ->join('employs','membres.id_employ','=','employs.id')
                                         ->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')
                                         ->leftJoin('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')
                                         ->leftJoin('consultations','demandehospitalisations.id_consultation','=','consultations.id')
                                         ->leftJoin('patients','consultations.Patient_ID_Patient','=','patients.id')
                                         ->leftJoin('type_colloques','colloques.type_colloque','=','type_colloques.id')
                                         ->select('demandehospitalisations.id as id-demande','colloques.id as id_colloque','colloques.*',
                                                  'employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom',
                                                  'type_colloques.type','dem_colloques.id_demande','consultations.Date_Consultation')
                                         ->where('etat_colloque','<>','cloturé')->get();
                      foreach( $colloques as $col){
                        if (!array_key_exists($col->id_colloque,$colloque))
                        {
                          $colloque[$col->id_colloque]= array( "dat"=> $col->date_colloque ,"creation"=>$col->date_creation,
                                                               "Type"=>$col->type,"Etat"=>$col->etat_colloque,
                                                               "membres"=> array ("$col->Nom_Employe $col->Prenom_Employe")
                                                             );
                        }
                        else{
                              if (array_search("$col->Nom_Employe $col->Prenom_Employe", $colloque[$col->id_colloque]["membres"])===false)
                                  $colloque[$col->id_colloque]["membres"][]="$col->Nom_Employe $col->Prenom_Employe";
                            }
                      }
                      
                      return view('colloques.liste_colloque', compact('colloque'));
                      break;
                case 9:
                      $rdvs = rdv_hospitalisation::whereHas('admission.demandeHospitalisation', function($q){
                                                  $q->where('etat', 'programme');
                                                  })->where('etat_RDVh','=','en attente')
                                                    ->where('date_RDVh','=',date("Y-m-d"))->get(); 
                      return view('home.home_agent_admis', compact('rdvs'));
                    break;       
                case 10:
                    $meds = medcamte::all();
                    $dispositifs = dispositif::all();
                    $reactifs = reactif::all();
                    return view('home.home_pharmacien', compact('meds','dispositifs','reactifs'));
                    break;
                
                //Laborantin
                case 11:
                    $demandesexb = demandeexb::where('etat','E')->get();
                    return view('home.home_laboanalyses', compact('demandesexb'));
                break;   
                //radiologue
                case 12:
                    $demandesexr = demandeexr::where('etat','E')->get();
                    return view('home.home_radiologue', compact('demandesexr')); 
                case 14:
                    $meds = medcamte::all();
                    $dispositifs = dispositif::all();
                    $reactifs = reactif::all();
                    return view('home.home_chef_ser', compact('meds','dispositifs','reactifs'));
             
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
}
