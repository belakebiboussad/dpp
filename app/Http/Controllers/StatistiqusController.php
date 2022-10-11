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
  protected function getAverhospStay($mthsub)
  {
    $jours = 0;
    $results = [];
    $firstDayofMonth = Carbon::now()->startOfMonth()->subMonth($mthsub);
    $lastDayofMonth = Carbon::now()->subMonth($mthsub)->endOfMonth();
    $dateRange = CarbonPeriod::create($firstDayofMonth, $lastDayofMonth);
    foreach ($dateRange as $date) {
      $hosps = hospitalisation::whereHas('admission.demandeHospitalisation',function($q){
                                            $q->where('specialite',Auth::user()->employ->specialite);
                                      })->where('date',$date->format('y-m-d'))->get(); 
      $jours += $hosps->sum("nb_days");
    }
    $nbhosp= hospitalisation::whereHas('admission.demandeHospitalisation',function($q){
                                      $q->where('specialite',Auth::user()->employ->specialite);
                                 })->where('date','>=',$firstDayofMonth->format('y-m-d'))
                                  ->where('date','<=',$lastDayofMonth->format('y-m-d'))->count();     
    $results[0] = $firstDayofMonth->subMonth()->format('F');
    if($nbhosp !=0)
     $results[1] = round( (float)$jours/$nbhosp, 1);
    else
      $results[1] = 20;
    return $results;
  } 
  public function index()
  {
    if(Auth::user()->is(4))//admin
      return view('stats.dashboard');
    else
    {
      $jours = 0; $datalit = []; $dates =  [];
      $today = Carbon::today()->toDateString();$frWeekbefore = (Carbon::now())->subWeek(4);
      $datearr =  [$frWeekbefore->format('m-d')];
      $services = service::all();
      $medsCount = employ::whereHas('User', function($q){
                     $q->whereIn('role_id', [1,13,14]);//$q->where('role_id', 1);
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
      })->where('affectation',null)->where('bloq',null)->count();
       $consultsNbr = consultation::whereHas('medecin',function($q){
           $q->where('specialite', Auth::user()->employ->specialite);
      })->where('date', $today)->count();
       //statistique pour hospitalisation
      $nbDays =  Carbon::now()->diffInDays(Carbon::now()->copy()->subMonth());
      $start = Carbon::parse($frWeekbefore); 
      $dateRange = CarbonPeriod::create($frWeekbefore, Carbon::now())->filter('isWeekday');
      foreach ($dateRange as $date) {
        $dates[] = $date->format('m-d');
        $nbhosp []= hospitalisation::whereHas('admission.demandeHospitalisation',function($q){
                                              $q->where('specialite',Auth::user()->employ->specialite);
                                        })->where('date',$date->format('y-m-d'))->count();
        $nbcons [] = consultation::where('date', $date->format('y-m-d'))->count();
        $hosps = hospitalisation::whereHas('admission.demandeHospitalisation',function($q){
                                              $q->where('specialite',Auth::user()->employ->specialite);
                                        })->where('date',$date->format('y-m-d'))->get(); 
        $jours += $hosps->sum("nb_days");
      }
      $nbjPerHosp = (array_sum($nbhosp) == 0 ? 0 : ($jours / array_sum($nbhosp)));
      // //delai d'hospitalisation de 6 dernier Mois
       $monthLabels  = [$this->getAverhospStay(6)[0],$this->getAverhospStay(5)[0],$this->getAverhospStay(4)[0],
                           $this->getAverhospStay(3)[0], $this->getAverhospStay(2)[0], $this->getAverhospStay(1)[0]];
      $avHospStysub = [$this->getAverhospStay(6)[1],$this->getAverhospStay(5)[1],$this->getAverhospStay(4)[1],
                           $this->getAverhospStay(3)[1], $this->getAverhospStay(2)[1], $this->getAverhospStay(1)[1]];                     
      //lits
      if(Auth::user()->role_id == 14)//chef de service
        $salles = Auth::user()->employ->service->salles; //salle::where('service_id',Auth::user()->employ->service)->get();
      else
        $salles = salle::all();
      $affectedBeds = 0; $blokedBeds = 0; $reservedBeds = 0;
      foreach ($salles as $key1 => $salle) {
        $affectedBeds += $salle->affectedBeds->count();
        $blokedBeds += $salle->blockedBeds->count();
        $now = Carbon::now()->setTime(0, 0, 0)->timestamp;
        $enday = Carbon::now()->setTime(23, 59, 0)->timestamp; 
        foreach($salle->lits as $lit)
        {
          if(!$lit->isFree($now,$enday))
            $reservedBeds++;
        }
      }
      $totaleBeds = $salles->sum('nb_beds');
      $datalit  = array($totaleBeds-$affectedBeds-$reservedBeds-$blokedBeds,$affectedBeds,$reservedBeds,$blokedBeds); 
      $nbcons = json_encode($nbcons); $nbhosp = json_encode($nbhosp);$dates = json_encode($dates);$datalit = json_encode($datalit);
      $avHospStysub = json_encode($avHospStysub);
      $monthLabels = json_encode($monthLabels);
      return view('stats.index', compact('infsCount','medsCount','hospCount','nbRequest','nbrdvs','nbFreeBed','consultsNbr','nbjPerHosp','dates','nbhosp','nbcons','totaleBeds','affectedBeds','blokedBeds','reservedBeds','datalit','avHospStysub','monthLabels'));
    }
  }/////////////methode pour index recherche
  public function seardate(Request $request)
  {
    $datenow =  Carbon::today();// $datenow = Carbon::now()->format('Y-m-d');
    $fdate = Carbon::createFromFormat('Y-m-d','2022-09-01');
    $tdate = Carbon::now()->format('Y-m-d');
    $af=0;  $somlit=0;  $somsl=0;
    $datalit =array(); $lits =array();
     $datearr =  [];
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
    $start = Carbon::parse($fdate);
    $end =  Carbon::parse($tdate);
    $nbDays = $start->diffInDays($end);
    $startt=$start->format('y-m-d');
    array_push($datearr, $startt);
    $d=$startt;
    for ($j=0; $j<$nbDays; $j++)
    { 
      $cons[] = consultation::where('date', $d)->count();
      $d = ($start->addDay())->format('y-m-d');
      array_push($datearr, $d); 
    }    
    if($request->ajax())
    {
      $i=0;       
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
    $model_prefix="App\modeles\\";
    $dataArray = [];$dates = []; $className =""; $objNbr = 0;$nblits = 0;
    $start = Carbon::parse($request->datDebut);$end =  Carbon::parse($request->datFin);
    $dateRange = CarbonPeriod::create($start, $end)->filter('isWeekday');
    switch($request->className)
    {
      case  1 :
        $className = $className."consultation";
        break;
      case  2 :
        $className = $className."hospitalisation";
        break;
      case  3 :
        $className = $className."Lit";
        break;
    }
    $modelName = $model_prefix.$className;
    foreach ($dateRange as $date) {
      $dates[] = $date->format('m-d');
      if(Auth::user()->role_id != 13)
      {
        $sid = $request->service;
        if(isset($request->medecin) && ($request->className != 3 ))
        {
          $mid = $request->medecin;
          $dataArray[] = $nbr = $modelName::whereHas('medecin', function($q) use ($mid) {
                                      $q->where('id', $mid);
                                  })->where('date', $date)->count();//->where('date','<=',$end )
        }else
        {
          if($request->className != 3)
            $dataArray[] = $nbr = $modelName::whereHas('medecin', function($q) use ($sid) {
                                      $q->where('service_id', $sid);
                                  })->where('date', $date)->count();
          else
          { //lit occupe     
            $nb1 = hospitalisation::whereHas('medecin', function($q) use ($sid) {
                                                      $q->where('service_id', $sid);
                                                  })->where('date','<=', $date)
                                                  ->where('Date_Sortie','>=', $date)->count();
             $nb2 = hospitalisation::whereHas('medecin', function($q) use ($sid) {
                                                      $q->where('service_id', $sid);
                                                  })->where('date','<=', $date)
                                                  ->where('Date_Sortie',null)->count();                                      
            $dataArray[]  = $nb1 + $nb2;
          } 
        } 
      }else
      {
        if(isset($request->service))
        {
          $sid = $request->service;
          if(isset($request->medecin))
            $mid = $request->medecin;
        }
      }
      if($request->className != 3)
        $objNbr += $nbr;
      else
          $objNbr = $modelName::whereHas('salle.service',function($q){
              $q->where('id',Auth::user()->employ->service_id);
            })->count();
    }
    return Response::json([ 'dates'=>$dates,'dataArray'=>$dataArray,'className'=>strtoupper($className),'objNbr'=>$objNbr]);  
  }
}