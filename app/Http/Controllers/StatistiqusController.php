<?php

namespace App\Http\Controllers;
use App\modeles\hospitalisation;
use App\modeles\service;
use App\modeles\consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatistiqusController extends Controller
{
	public function index()
	{
   	$date = []; $nvhosp = []; $nbhosp = []; $nbcons = []; $serv = [];
    //$date = [ date('d.m.Y') ,date('d.m.Y',strtotime("-1 days")), date('d.m.Y',strtotime("-2 days")) , date('d.m.Y',strtotime("-3 days")), date('d.m.Y',strtotime("-4 days")) , date('d.m.Y',strtotime("-5 days")) , date('d.m.Y',strtotime("-6 days"))  ];
    $date = [ date('Y-m-d') ,date('Y-m-d',strtotime("-1 days")), date('Y-m-d',strtotime("-2 days")) , date('Y-m-d',strtotime("-3 days")), date('Y-m-d',strtotime("-4 days")) , date('Y-m-d',strtotime("-5 days")) , date('Y-m-d',strtotime("-6 days"))  ];
    //dd($date);
    /*
    $d = date('Y-m-d',strtotime("-2 days"));*/
    /*$hosp = hospitalisation:: where('etat_hosp',null)->where('Date_entree',$date[2])->get();
   */;   
    $j=0;
    $servs = service::all();
    for ($i=1; $i <7; $i++) 
    {  
      $value = strftime("%y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-$j, date('y')));
      $nbhosp[] = hospitalisation:: where('etat_hosp',null)->where('Date_entree','<=',$value)->count ();
      $j++ ; 
    }
    for ($i=0; $i <6; $i++) 
    {  
      $value = strftime("%y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-$j, date('y')));
      //$value = date($value);
      //$nvhosp[] = hospitalisation::where('etat_hosp',null)->where('Date_entree',$value)->count();
      $nvhosp[] = hospitalisation::where('etat_hosp',null)->where('Date_entree',$date[$i])->count();
      $j++ ;        
    }
    //dd($nvhosp);
    $value = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d'), date('y')));
    foreach  ($servs as $sevV)
    {  
        
      $nbcons[] = consultation::join('employs', 'consultations.employ_id','employs.id')
             									->join('services', 'employs.service','=','services.id')->where('services.nom','=',$sevV->nom) 
                    					->where('date','=',$value)-> groupBy ( 'services.nom' )-> count ();
    }
    foreach  ($servs as $srv)
    {
      $serv[] = $srv->nom;
    }
    return view ('stats.index') -> with ( 'date' , json_encode ( $date , JSON_NUMERIC_CHECK ))-> with ( 'nvhosp' , json_encode ( $nvhosp , JSON_NUMERIC_CHECK ))-> with ( 'nbhosp' , json_encode ( $nbhosp , JSON_NUMERIC_CHECK ))-> with ( 'nbcons' , json_encode ( $nbcons , JSON_NUMERIC_CHECK ))-> with ( 'serv' , json_encode ( $serv , JSON_NUMERIC_CHECK ));
	}
}