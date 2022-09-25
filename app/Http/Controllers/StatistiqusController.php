<?php

namespace App\Http\Controllers;
use App\modeles\hospitalisation;
use App\modeles\bedReservation;
use App\modeles\salle;
use App\modeles\lit;
use App\modeles\service;
use App\modeles\consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\modeles\DemandeHospitalisation;
use App\modeles\codesim;
use App\modeles\employ;
use App\modeles\rdv_hospitalisation;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use View;
use Response;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
class StatistiqusController extends Controller
{  
  public function index()
  {
    $today = Carbon::today()->toDateString();
    $datalit = []; $dates =  [];
    $frWeekbefore = (Carbon::now())->subWeek(4);
    $datearr =  [$frWeekbefore->format('m-d')];
    $services = service::all();
    $medsCount = employ::whereHas('User', function($q){
                    $q->where('role_id', 1);
                })->where('service_id',Auth::user()->employ->service_id)->count();
    $infsCount = employ::whereHas('User', function($q){
                                                 $q->where('role_id', 3);
                })->where('service_id', Auth::user()->employ->service_id)->count();
    $hospCount = hospitalisation::whereHas('admission.demandeHospitalisation', function($q){
                    $q->where('specialite', Auth::user()->employ->specialite);
                })->where('etat', null)->count();
    $nbRequest = DemandeHospitalisation::where('specialite', Auth::user()->employ->specialite)
                                        ->where('etat', null)->count();
    $nbrdvs =rdv_hospitalisation::whereHas('demandeHospitalisation', function($q){
                                            $q->where('etat', 1);//'0'
                                })->where('date','>=', $today)->count();
    $nbFreeBed = lit::whereHas('salle',function($q){
            $q->where('service_id', Auth::user()->employ->service_id);
    })->where('affectation',null)->count();
    $consultsNbr = consultation::whereHas('medecin',function($q){
         $q->where('specialite', Auth::user()->employ->specialite);
    })->where('date', $today)->count();
     //statistique pour hospitalisation
    $nbDays =  Carbon::now()->diffInDays(Carbon::now()->copy()->subMonth()); // $nbDays = $today->diffInDays( $frWeekbefore);
    $start = Carbon::parse($frWeekbefore); 
    $dateRange = CarbonPeriod::create($frWeekbefore, Carbon::now())->filter('isWeekday');
    foreach ($dateRange as $date) {
      $dates[] = $date->format('m-d');
      $nbhosp []= hospitalisation::whereHas('admission.demandeHospitalisation',function($q){
                                            $q->where('specialite',Auth::user()->employ->specialite);
                                      })->where('Date_entree',$date->format('y-m-d'))->count();
      $nbcons[] = consultation::where('date', $date->format('y-m-d'))->count();
    }
    //lits
    if(Auth::user()->role_id == 14)//chef de service
      $salles = Auth::user()->employ->service->salles; //salle::where('service_id',Auth::user()->employ->service)->get();
    else
      $salles = salle::all();
    $affectedBeds = 0; $blokedBeds = 0; $reservedBeds = 0; $totaleBeds = 0;
    foreach ($salles as $key1 => $salle) {
      $affectedBeds += $salle->affectedBeds->count();
      $blokedBeds += $salle->blockedBeds->count();
      $now = Carbon::now()->setTime(0, 0, 0)->timestamp;
      $enday = Carbon::now()->setTime(23, 59, 0)->timestamp; 
      foreach($salle->lits as $lit)
      {
        $totaleBeds += $salle->lits->count();
        if(!$lit->isFree($now,$enday))
          $reservedBeds++;
      }
    }
    array_push($datalit, $totaleBeds-$affectedBeds-$reservedBeds-$blokedBeds);       
    array_push($datalit, $affectedBeds); array_push($datalit,$reservedBeds);array_push($datalit, $blokedBeds); 
    $nbcons = json_encode($nbcons); $nbhosp = json_encode($nbhosp);$dates = json_encode($dates);$datalit = json_encode($datalit);
    return view('stats.index', compact('infsCount','medsCount','hospCount','nbRequest','nbrdvs','nbFreeBed','consultsNbr','dates','nbhosp','nbcons','totaleBeds','affectedBeds','blokedBeds','reservedBeds','datalit'));
  }
  ///////////////////search/////////
  public function searstatMoh(Request $request)
  {
    $nvhosp = []; $nbhosp = []; $nbcons = []; $serv = [];
    $servs = service::all();
    $fdate=request('Datdebut');
    $tdate=request('Datfin');
    $services=$request->service;
    $medecin=$request->medecin;
    $af=0;  $libre=0; $somsl=0;$datalit = [];$lits = [];$output="";$datearr =  [];    
    $start = Carbon::parse($fdate);
    $end =  Carbon::parse($tdate);
    $nbDays = $start->diffInDays($end);
    $startt=$start->format('y-m-d');
    array_push($datearr, $startt);
    $d=$startt;
    for ($j=0; $j<$nbDays; $j++)
    { // if((in_array(Auth::user()->role->id,[14])))//admin & directeur& chefservice
      if(Auth::user()->role_id == 14) // modifier hadi
      {   
        $ServiceID = Auth::user()->employ->service;
        $medecinID =  $medecin;        
      } else{
        $ServiceID = $services;
        $medecinID =  $medecin;
      }
      // $ServiceID = $services;//  $medecinID =  $medecin;
      if($ServiceID==null && $medecinID==null)
      {
        $nbhosp[] = hospitalisation::where('etat','=',null)
                                   -> where('Date_entree','<=',$end)->where('Date_entree','>=',$start)
                                   ->where('Date_entree','>=',$d)->count();
        $nvhosp[] = hospitalisation::where('etat','=',null)->where('Date_entree','<=',$end)
                                     ->where('Date_entree','>=',$start)->where('Date_entree','=',$d)->count();
         $nbcons[] = consultation::where('date','<=',$end)->where('date','>=',$start)->where('date','<=',$d)->count();
      }else if($medecinID==null)
      {
        $nbhosp []= hospitalisation::whereHas('admission.demandeHospitalisation.Service',function($q) use($ServiceID){
                                          $q->where('id',$ServiceID);
                                    })->where('etat','=',null) ->where('Date_entree','<=',$end)
                                      ->where('Date_entree','>=',$start)->where('Date_entree','<=',$d)->count();
        $nvhosp []= hospitalisation::whereHas('admission.demandeHospitalisation.Service',function($q) use($ServiceID){
                                            $q->where('id',$ServiceID);
                                      })->where('etat','=',null) ->where('Date_entree','<=',$end)
                                    ->where('Date_entree','>=',$start)->where('Date_entree','=',$d)->count(); 
        $nbcons []= consultation::whereHas('medecin.Service', function($q) use ($ServiceID) {
                                    $q->where('service_id', $ServiceID);                           
                                })->where('date','>=',$start)->where('date','<=',$end)->count();
      }
      if($ServiceID==null &&$medecinID!=null)
      {
        $nbhosp[] = hospitalisation::where('etat','=',null)-> where('Date_entree','<=',$end)->where('Date_entree','>=',$start)
                                    ->where('Date_entree','>=',$d)->where('medecin_id',$medecinID)->count();
        $nvhosp[] = hospitalisation::where('etat','=',null)->where('Date_entree','<=',$end)->where('Date_entree','>=',$start)
                                    ->where('Date_entree','=',$d)->where('medecin_id',$medecinID)->count();
         $nbcons []= consultation::whereHas('medecin', function($q) use ($medecinID) {
                                      $q->where('id', $medecinID);
                                  })->where('date','>=',$start)->where('date','<=',$end )->count();     
      }
      $d = ($start->addDay(1))->format('y-m-d');
      array_push($datearr, $d);     
    } //fin for
    if(Auth::user()->role_id == 14)
    { 
      $ServiceID = Auth::user()->employ->service;
      $salles = salle::where('service_id',$ServiceID)->get();
    }
    $ServiceID = $services;
    if( $ServiceID==null)
      $salles = salle::all();
    else
      $salles = salle::where('service_id',$ServiceID)->get();
    $nbsalle=count($salles);
    foreach ($salles as $key1 => $salle) {
      $somlit=0;
      foreach ($salle->lits as $key => $lit) {
        $idLLit = $lit->id; 
        $cr=0;
        $reservations =  bedReservation::whereHas('lit',function($q) use($idLLit){
                                              $q->where('id',$idLLit);
                                       })->get();
        $lit = lit::FindOrFail($idLLit);
        foreach ($reservations as $key => $reservation) {
          if (($end   >= strtotime($reservation->rdvHosp->date_RDVh))|| ($start  <= strtotime($reservation->rdvHosp->date_Prevu_Sortie)))
            $cr=1;
          else
            $cr=0;
/*else{ if(strtotime($reservation->rdvHosp->date_RDVh)==null)  {$libre++;}}*/
        }
          $affect = $lit->isAffected($idLLit); 
          if($affect)
          {
            $af++;
          }
            $somlit=$somlit+$cr;
          }   
          $somsl=$somsl+$somlit;
         }
        $lit = lit::get()->count();
        $libre= $lit-$somsl-$af;
        array_push($datalit, $somsl);       
        array_push($datalit, $af); 
        array_push($datalit, $libre);     
        $af=0;    
        $libre=0;   
        $somlit=0;
        $somsl=0;   
        if($request->ajax())
        {
            $i=0;
            $output="";
            return Response::json([ 'date'=>$datearr,'nbhosp'=>$nbhosp,'nvhosp'=>$nvhosp,'nbcons'=>$nbcons,'services'=>$services,'datalit'=>$datalit,'medecin'=>$medecin]);
        }

  }
  /////////////methode pour index recherche
  public function seardate(Request $request)
  {
    $datenow = Carbon::now()->format('Y-m-d');// $tdate=request('Datfin');
    $fdate = Carbon::createFromFormat('Y-m-d','2022-09-01');
    $tdate = Carbon::now()->format('Y-m-d');
    $af=0;  $somlit=0;  $somsl=0;
    $datalit =array(); $lits =array();
    if(Auth::user()->role_id == 14)
    { 
      $ServiceID = Auth::user()->employ->service;
      $salles = salle::where('service_id',$ServiceID)->get();
    }else
      $salles = salle::all();
    foreach ($salles as $key1 => $salle) {
      $somlit=0;
      foreach ($salle->lits as $key => $lit) {
        $idLLit = $lit->id; 
        $cr=0;
        $reservations =  bedReservation::whereHas('lit',function($q) use($idLLit){
                                            $q->where('id',$idLLit);
                                     })->get();
        $lit = lit::FindOrFail($idLLit);
        foreach ($reservations as $key => $reservation) {
          if (($datenow >= strtotime($reservation->rdvHosp->date_RDVh))|| ($datenow  <= strtotime($reservation->rdvHosp->date_Prevu_Sortie)))
            $cr=1;
          else
            $cr=0;
        }
        $affect = $lit->isAffected($idLLit); 
        if($affect)
          $af++;
        $somlit=$somlit + $cr;
      }   
      $somsl=$somsl + $somlit;        
    }
    $lit = lit::get()->count();
    $libre= $lit-$somsl-$af;
    array_push($datalit, $somsl);  array_push($datalit, $af);  array_push($datalit, $libre);     
    //debut
     $datearr =  [];
    $start = Carbon::parse($fdate);
    $end =  Carbon::parse($tdate);
    $nbDays = $start->diffInDays($end);
    $startt=$start->format('y-m-d');
    array_push($datearr, $startt);
    $d=$startt;
    for ($j=0; $j<$nbDays; $j++)
    { 
      // $cons[] = consultation::where('date','<=',$tdate)->where('date','>=',$fdate)->where('date','=',$d)->count();
       $cons[] = consultation::where('date', $d)->count();
      $d = ($start->addDay())->format('y-m-d');
      array_push($datearr, $d); 
    }
    //fin           
    if($request->ajax())
    {
      $i=0;
      $output="";        
      return Response::json([ 'datalit'=>$datalit,'date'=>$datearr,'nbcons'=>$cons]);
    }
  }
  public function search($id)
  {
    $services = service::whereIn('type', [0,1])->get();
    if((in_array(Auth::user()->role->id,[4,8])))
      $medecins = employ::all();
    else 
      $medecins =Auth::user()->employ->Service->Medecins;
    return view('stats.search', compact('services','medecins','id'));
  }
  public function searstat(Request $request)
  {
    $nbcons = [];
    $className ="";
    switch($request->className)
    {
      case  1 :
        $className ="consultation";
        break;
      case  2 :
        $className ="hospitalisation";
        break;
      case  3 :
        $className = "Lit";
        break;
    }
    if(Auth::user()->role_id == 14)
      if(isset($request->medecin))
      {
         $nbcons []= consultation::whereHas('medecin', function($q) use ($request->medecin) {
                                      $q->where('id', $request->medecin);
                                  })->where('date','>=',$start)->where('date','<=',$end )->count();
      }
      else
      {

      }
  }
}