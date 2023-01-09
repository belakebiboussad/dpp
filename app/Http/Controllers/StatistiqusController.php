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
  public $monthLabels = []; public $avHospStysub = [];
  protected function getAverhospStay($mthsub)
  { 
    $start =Carbon::now()->startOfMonth()->subMonth($mthsub);
    $ldm = Carbon::now()->subMonth($mthsub)->endOfMonth();
    if($mthsub >= 0 ){
      $jours = 0;
      $start =Carbon::now()->startOfMonth()->subMonth($mthsub);   
      $results[0] = $start->format('M');
      $ldm = Carbon::now()->subMonth($mthsub)->endOfMonth()->format('y-m-d');
      foreach (CarbonPeriod::create($start, $ldm) as $date) {
        $hosps = hospitalisation::whereHas('admission.demandeHospitalisation',function($q){
                                            $q->where('specialite',Auth::user()->employ->specialite);
                                      })->where('date',$date->format('y-m-d'))->get(); 
        $jours += $hosps->sum("nb_days"); 
      }
      $nbhosp  = hospitalisation::whereHas('admission.demandeHospitalisation', function($q){
                                    $q->where('specialite',Auth::user()->employ->specialite);
                                })->whereBetween('date', [$start, $ldm])->count();
      if($nbhosp !=0)
        $results[1] = round( (float)$jours/$nbhosp, 1);
      else
         $results[1] = 20;
      array_push($this->monthLabels, $results[0]);  
      array_push($this->avHospStysub, $results[1]);
      $this->getAverhospStay($mthsub - 1);    
    }
  } 
  public function index()
  {
    if(Auth::user()->is(4))//admin
      return view('stats.dashboard');
    else
    {
      $jours = 0;
      $services = service::all();
      $start = (Carbon::now())->subWeek(4);
      $datearr =  [$start->format('m-d')];
      $medsCount = employ::whereHas('User', function($q){
                     $q->whereIn('role_id', [1,13,14]);
                  })->where('service_id',Auth::user()->employ->service_id)->count();
      $infsCount = employ::whereHas('User', function($q){
                    $q->where('role_id', 3);
                  })->where('service_id', Auth::user()->employ->service_id)->count();
      $hospCount = hospitalisation::whereHas('admission.demandeHospitalisation', function($q){
                      $q->where('specialite', Auth::user()->employ->specialite);
                  })->whereNull('etat')->count();
      $nbRequest = DemandeHospitalisation::where('specialite', Auth::user()->employ->specialite)
                                          ->whereNull('etat')->count();
      $nbrdvs =rdv_hospitalisation::whereHas('demandeHospitalisation', function($q){
                                              $q->where('etat', 1);//'0'
                                  })->where('date','>=', Carbon::today())->count();
      $nbFreeBed = lit::whereHas('salle',function($q){
              $q->where('service_id', Auth::user()->employ->service_id);
      })->whereNull('affectation')->whereNull('bloq')->count();
      $consultsNbr = consultation::whereHas('medecin',function($q){
           $q->where('specialite', Auth::user()->employ->specialite);
      })->where('date', Carbon::today())->count();//statistique pour hospitalisation
      $nbDays = Carbon::now()->daysInMonth;//$dateRange = CarbonPeriod::create($start, Carbon::now());//->filter('isWeekday')
      foreach (CarbonPeriod::create($start, Carbon::now()) as $date) {
        $d = $date->format('y-m-d'); $dates[] = $date->format('m-d');
        $nbhosp []= hospitalisation::whereHas('admission.demandeHospitalisation',function($q){
                                              $q->where('specialite',Auth::user()->employ->specialite);
                                        })->where('date',$d)->count();
        $nbcons [] = consultation::where('date', $date->format('y-m-d'))->count();
        $hosps = hospitalisation::whereHas('admission.demandeHospitalisation',function($q){
                                              $q->where('specialite',Auth::user()->employ->specialite);
                                        })->where('date',$date->format('y-m-d'))->get(); 
        $jours += $hosps->sum("nb_days");
      }
      $nbjPerHosp = (array_sum($nbhosp) == 0 ? 0 : ($jours / array_sum($nbhosp)));
      // //delai d'hospitalisation de 6 dernier Mois
      $this->getAverhospStay(6); //bon 
     
       //lits
      if(Auth::user()->role_id == 14)//chef de service
        $salles = Auth::user()->employ->service->salles;
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
      $nbcons = json_encode($nbcons); $nbhosp = json_encode($nbhosp);$dates = json_encode($dates);
      $datalit = json_encode($datalit);
      $avHospStysub = json_encode($this->avHospStysub);
      $monthLabels = json_encode($this->monthLabels);
      return view('stats.index', compact('infsCount','medsCount','hospCount','nbRequest','nbrdvs','nbFreeBed','consultsNbr','nbjPerHosp','dates','nbhosp','nbcons','totaleBeds','affectedBeds','blokedBeds','reservedBeds','datalit','avHospStysub','monthLabels'));
    }
  }/////////////methode pour index recherche 
 public function search($id)
  {
    $services = service::whereIn('type', [0,1])->get();
    if((in_array(Auth::user()->role_id,[4,8])))
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
                                                  ->whereNull('Date_Sortie')->count();                                      
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