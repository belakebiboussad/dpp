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
  	$date = [];
    $date = [ date('d.m.Y') ,date('d.m.Y',strtotime("-1 days")), date('d.m.Y',strtotime("-2 days")) , date('d.m.Y',strtotime("-3 days")), date('d.m.Y',strtotime("-4 days")) , date('d.m.Y',strtotime("-5 days")) , date('d.m.Y',strtotime("-6 days"))  ];
    $nvhosp = []; 
    $nbhosp = []; 
    $nbcons = []; 
    $j=0;
    for ($i=1; $i <7; $i++) 
    {  //$value =DATE_FORMAT($value, "%M %d %Y");
      $value = strftime("%y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-$j, date('y')));
      // $value = date($value);
      $nvhosp[] = hospitalisation:: where('etat_hosp',null)->where('Date_entree','<=',$value)-> count ();
      $j++ ; 
    }
    for ($i=1; $i <7; $i++) 
    {  
      $value = strftime("%y-%m-%d", mktime(0, 0, 0, date('m'), date('d')-$j, date('y')));
      $value = date($value);
      $nbhosp[] = hospitalisation:: where('etat_hosp',null)->where('Date_entree',$value)->groupBy( 'Date_entree' )->count ();
      $j++ ;        
    }
    $sev = service::all();
    $value = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d'), date('y')));
    foreach  ($sev as $sevV)
    {  
        
      $nbcons[] = consultation::join('employs', 'consultations.Employe_ID_Employe','employs.id')
             									->join('services', 'employs.service','=','services.id')->where('services.nom','=',$sevV->nom) 
                    					->where('Date_Consultation','=',$value)-> groupBy ( 'services.nom' )-> count ();

    }
   
    $serv = [];
    $hospp = service::all();
    foreach  ($hospp as $hospp)
    {
      $serv[] = $hospp->nom;
    }
    return view ('stats.index') -> with ( 'date' , json_encode ( $date , JSON_NUMERIC_CHECK ))-> with ( 'nvhosp' , json_encode ( $nvhosp , JSON_NUMERIC_CHECK ))-> with ( 'nbhosp' , json_encode ( $nbhosp , JSON_NUMERIC_CHECK ))-> with ( 'nbcons' , json_encode ( $nbcons , JSON_NUMERIC_CHECK ))-> with ( 'serv' , json_encode ( $serv , JSON_NUMERIC_CHECK ));
	}
}