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

 use DateTime;
use App\modeles\DemandeHospitalisation;

use App\modeles\codesim;



use App\modeles\employ;
use App\modeles\rdv_hospitalisation;
use Illuminate\Support\Facades\Auth;



use Jenssegers\Date\Date;
use View;
use Response;

use Carbon\Carbon;

class StatistiqusController extends Controller
{  
 

 ///////////////////search/////////

 public function searstat(Request $request)
    {

       $nvhosp = []; $nbhosp = []; $nbcons = []; $serv = [];

        $servs = service::all();


       $fdate=request('Datdebut');
       $tdate=request('Datfin');
       $services=$request->service;
       $medecin=$request->medecin;
       
       $af=0;    
       $libre=0;   
       
       $somsl=0;
       $datalit =array();       
       $lits =array();
      
        
        $output="";
        $datearr =  [];
        $start = Carbon::parse($fdate);
        $end =  Carbon::parse($tdate);
        $nbDays = $start->diffInDays($end);

        $startt=$start->format('y-m-d');
       array_push($datearr, $startt);
       $d=$startt;
        for ($j=0; $j<$nbDays; $j++)
        {

     // if((in_array(Auth::user()->role->id,[14])))//admin & directeur& chefservice
       if(Auth::user()->role_id == 14) // modifier hadi
        {   

        $ServiceID = Auth::user()->employ->service;
        $medecinID =  $medecin;        
              
         }
         else{

          $ServiceID = $services;
           $medecinID =  $medecin;
         }
            
           
          // $ServiceID = $services;
          //  $medecinID =  $medecin;
           
           if($ServiceID==null &&$medecinID==null)
           {

         $nbhosp[] = hospitalisation::where('etat','=',null)
         -> where('Date_entree','<=',$end)
         ->where('Date_entree','>=',$start)
         ->where('Date_entree','>=',$d)
         ->count();

         $nvhosp[] = hospitalisation::where('etat','=',null)
         ->where('Date_entree','<=',$end)
         
         ->where('Date_entree','>=',$start)
         ->where('Date_entree','=',$d)
         ->count();

           $nbcons[] = consultation::where('date','<=',$end)
         ->where('date','>=',$start)
          
         ->where('date','<=',$d)
         ->count();
           }
           else if($medecinID==null)
           {
             
                            
           $nbhosp []= hospitalisation::whereHas('admission.demandeHospitalisation.Service',function($q) use($ServiceID){
                                             $q->where('id',$ServiceID);
                                           })
                          
            
         ->where('etat','=',null) ->where('Date_entree','<=',$end)
         ->where('Date_entree','>=',$start)
          ->where('Date_entree','<=',$d)
         ->count();


           $nvhosp []= hospitalisation::whereHas('admission.demandeHospitalisation.Service',function($q) use($ServiceID){
                                             $q->where('id',$ServiceID);
                                           })->where('etat','=',null) ->where('Date_entree','<=',$end)
         ->where('Date_entree','>=',$start)
        
         ->where('Date_entree','=',$d)
         ->count();
  

          $nbcons []= consultation::whereHas('medecin.Service', function($q) use ($ServiceID) {
                                $q->where('service_id', $ServiceID);
                               
 
                        })
                          ->where('date','>=',$start)
                          ->where('date','<=',$end)
                          ->count();

           }

         if($ServiceID==null &&$medecinID!=null)

           {
          $nbhosp[] = hospitalisation::where('etat','=',null)
         -> where('Date_entree','<=',$end)
         ->where('Date_entree','>=',$start)
         ->where('Date_entree','>=',$d)
          ->where('medecin_id',$medecinID)
         ->count();

         $nvhosp[] = hospitalisation::where('etat','=',null)
         ->where('Date_entree','<=',$end)
         
         ->where('Date_entree','>=',$start)
         ->where('Date_entree','=',$d)
          ->where('medecin_id',$medecinID)
         ->count();

       

            $nbcons []= consultation::whereHas('medecin', function($q) use ($medecinID) {
                                    $q->where('id', $medecinID);
                                 })
                         
                          ->where('date','>=',$start)
                          ->where('date','<=',$end )
                          ->count();

       
              
           }//fin else
           


        //  } //fin else
       

          $d = ($start->addDay(1))->format('y-m-d');
          array_push($datearr, $d);


         
           } //fin for
          
          if(Auth::user()->role_id == 14)
          { 
            $ServiceID = Auth::user()->employ->service;
            $salles = salle::where('service_id',$ServiceID)->get();
       
           }
          // else

          // {
          $ServiceID = $services;
           if( $ServiceID==null)
           {

            $salles = salle::all();

           }

         else

         { 
           $salles = salle::where('service_id',$ServiceID)->get();
          }

        //  }  
       
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
                 {
                  $cr=1;
                }
          else
          {
            $cr=0;
          }
          


                                // else

                                // { if(strtotime($reservation->rdvHosp->date_RDVh)==null)  {$libre++;}


                                // }

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
         {   $i=0;
          $output="";

         
          return Response::json([ 'date'=>$datearr,'nbhosp'=>$nbhosp,'nvhosp'=>$nvhosp,'nbcons'=>$nbcons,'services'=>$services,'datalit'=>$datalit,'medecin'=>$medecin]);


         }

  }
  /////////////methode pour index recherche
  public function seardate(Request $request)
    {

       $datenow = Carbon::now()->format('Y-m-d');;

      // $tdate=request('Datfin');
       

       $af=0;    
       $libre=0;   
       $somlit=0;
       $somsl=0;
       $datalit =array();       
       $lits =array();
      
              
          
          if(Auth::user()->role_id == 14)
          { 
             $ServiceID = Auth::user()->employ->service;
            $salles = salle::where('service_id',$ServiceID)->get();
       
           }
          else

          {
        
            $salles = salle::all();
       
          }  
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
            
         if (($datenow   >= strtotime($reservation->rdvHosp->date_RDVh))|| ($datenow  <= strtotime($reservation->rdvHosp->date_Prevu_Sortie)))
         {
            $cr=1;
         }else
          {
            $cr=0;
          }

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
         {   $i=0;
          $output="";

         
          return Response::json([ 'datalit'=>$datalit]);


         }

  }



	public function index()
	{
   	
    
    $services = service::all();
    $medecins = employ::where('service_id',Auth::user()->employ->service_id)->get();
 
    return view('stats.index', compact('services','medecins'));
	}
    public function search()
  {
    
    
    $services = service::all();
    if((in_array(Auth::user()->role->id,[4,8])))
    {  $medecins = employ::all();}
  else { $medecins = employ::where('service_id',Auth::user()->employ->service_id)->get();}

   
 
    return view('stats.search', compact('services','medecins'));
  }
}