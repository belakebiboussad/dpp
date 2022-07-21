<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\modeles\rdv_hospitalisation;
use App\modeles\service;
use App\modeles\salle;
use App\modeles\lit;
use App\modeles\BedReservation;
use Carbon\Carbon;
class BedReservationController extends Controller
{
	public function __construct()
  {
      $this->middleware('auth');
  }
	public function index()
	{
    //test
    $services = service::all();
    return view('reservations.index', compact('services'));
	}
  public function create()
  {
    $tomorrow = date("Y-m-d", strtotime('now'));
    $services =service::where('hebergement',1)->get();
    $specialite = Auth::user()->employ->Service->Specialite;
    $rdvs = rdv_hospitalisation::doesntHave('bedReservation')->whereHas('demandeHospitalisation',function ($q){
                                      $q->doesntHave('bedAffectation')->where('service',Auth::user()->employ->service_id);    
                                    })->where('date','>=',$tomorrow)->where('etat',null)->get();
    return view('reservations.create', compact('rdvs','services','specialite'));
  }
	public function store(Request $request)
	{
    if($request->ajax())
    {
      $reserv =BedReservation::create($request->all());
      return $reserv;
    }else
    {
      BedReservation::firstOrCreate([
        "id_rdvHosp"=>$request->rdv_id,
        "id_lit" =>$request->lit_id,
      ]);      
    return redirect()->action('BedReservationController@create');
    }
	}
    /**
  **function ajax return lits ,on retourne pas les lits bloque ou reservé
  */
  public function getNoResBeds(Request $request)
  {
    $lits =array();
    $salle =salle::FindOrFail($request->SalleId);
    if( $request->Affect == "0")//pour une reservation ?
    {
      if(isset($request->rdvId))//edit hosp rdv
      {     
        $rdvHosp =  rdv_hospitalisation::with('bedReservation')->FindOrFail($request->rdvId);
        if(isset($rdvHosp->bedReservation))
          $rdvHosp->bedReservation()->delete();
      }
      foreach ($salle->lits as $key => $lit) {  
        $free = $lit->isFree(strtotime($request->StartDate),strtotime($request->EndDate));
        if(!($free))
          $salle->lits->pull($key); //$lits->push($lit);    
      }
    }else
    {//pour affectation
      return $salle->lits;
      foreach ($salle->lits as $key => $lit) {
        $affect = $lit->isAffected($lit->id); 
        if($affect)
          $salle->lits->pull($key);
      }
     }    
      return $salle->lits;
  }
  public function getNoResBedsTeste(Request $request)
  {
    $lits = array();
    $salle =salle::FindOrFail($request->id);
    return $salle->lits;  
  }
  public function update(Request $request, $id)
  { //$now = date("Y-m-d", strtotime('now'));//"2022-07-19"$now = \Carbon\Carbon::now();//object
    $now = $today =  \Carbon\Carbon::now()->toDateString();//"2022-07-19"
    $lit = lit::FindOrFail( $request->lit_id);
    $now = $today = Carbon::now()->toDateString();
    $newDateTime = Carbon::now()->addDay(3)->toDateString();
      //get reservation of this bed between this day
    $free = $lit->isFree(strtotime($now),strtotime( $newDateTime));
    dd($free);
    $beds = BedReservation::with('rdvHosp')->whereHas('rdvHosp',function($q) use($now){ 
                   $q->where('date','>=',$now);
          })->whereHas('lit',function($q) use($id){ 
                   $q->where('id', $id);
          })->get();
    dd($beds);      
  }
}
