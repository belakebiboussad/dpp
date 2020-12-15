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
//use App\modeles\gamme;
use App\modeles\dispositif;
use App\modeles\dem_colloque;
use App\modeles\demandeexb;
use App\modeles\demandeexr;
use App\User;
use Auth; 
use Date;
use route;
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
      $ServiceID = Auth::user()->employ->service;// dd(Auth::user()->employ->Service->Type);
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
                $meds = medcamte::all();
                $dispositifs = dispositif::all();
                $reactifs = reactif::all();
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
               // $meds = medcamte::all();
               //$dispositifs = dispositif::all();
                //$reactifs = reactif::all();
                //return view('home.home_chef_ser', compact('meds','dispositifs','reactifs'));
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
}