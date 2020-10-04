<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\lit;
use App\modeles\salle;
use App\modeles\service;
use App\modeles\bedReservation;
use App\modeles\rdv_hospitalisation;
use App\modeles\DemandeHospitalisation;
use App\modeles\bedAffectation;
use Response;
class LitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $lits=lit::join('salles','lits.salle_id','=','salles.id')
                  ->join('services','salles.service_id','=','services.id')
         ->select('lits.*','salles.nom as nomSalle','services.nom as nomService')->get();
        return view('lits.index_lit', compact('lits'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createlit()
    {
        $services = service::all();
        return view('lits.create_lit_2', compact('services'));
    }

    public function create($id_salle = null)
    {
       $services = service::all();
       return view('lits.create_lit', compact('services','id_salle'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $etat = 1;
       if(isset($_POST['etat']) )
             $etat = 0;  
       $l=  lit::create([
                "num"=>$request->numlit,
                "nom"=>$request->nom,
                "etat"=>$etat,
                "affectation"=>0,
                "salle_id"=>$request->chambre,
       ]);
       return redirect()->action('LitsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $lit = lit::FindOrFail($id);
      $salle = salle::FindOrFail($lit->salle_id);
      $service = service::FindOrFail($salle->service_id);
      return view('lits.show_lit', compact('lit','service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $lit = lit::FindOrFail($id);
      $salles = salle::all();
      return view('lits.edit_lit', compact('lit','salles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request, $id)
      {
        $lit = lit::FindOrFail($id);
        $etat =1 ;
        if(isset($_POST['etat']) )
          $etat = 0;   
        $lit->update([
          "num"=>$request->numlit,
          "nom"=>$request->nom,
          "etat"=>$etat,
          "affectation"=>$request->affectation,
          "salle_id"=>$request->salle,
        ]);
         return redirect()->action('LitsController@index');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function affecter(Request $request )
    {
      $affect = bedAffectation::create($request->all());
      $lit = lit::FindOrFail( $request->lit_id);
      $lit->update([
        "affectation" =>1,
      ]);
      return Response::json($affect);
      // $services = service::all();
      // if($id != 0) // {
     
      //   $demande = DemandeHospitalisation::find($id); //   return view('lits.affecte',compact('services','demande'));
      // } // else// {// }
     
      
      // if($request->ajax())  
      // {
       //   // $patient = patient::FindOrFail($id);
      //   // $view = view("patient.ajax_patient_detail",compact('patient'))->render();
      //   // return response()->json(['html'=>$view]);
      // }else
      // {
        // }
      // // if($id != 0)
     // // {// // }
      
    }
    public function destroy($id)
    {
        //
    }

    /**
    function ajax return lits ,on retourne pas les lits bloque ou reservé  
    */
    public function getlits_old(Request $request)
    {  
      $lits =array();
      $salle =salle::FindOrFail($request->SalleId);
      if(isset($request->rdvId))
      {
        $rdvHosp =  rdv_hospitalisation::FindOrFail($request->rdvId);
        if(isset($rdvHosp->bedReservation))
        {
          $rdvHosp->bedReservation->delete();
          
        }  
      }
      if(isset($rdvHosp) && isset($rdvHosp->bedReservation) && ($rdvHosp->bedReservation->lit->salle_id == $request->SalleId ))
      {
        foreach ($salle->lits as $key => $lit) {  
          if($rdvHosp->bedReservation->id_lit !=$lit->id ){
            $free = $lit->isFree(strtotime($request->StartDate),strtotime($request->EndDate));
            if(!($free))
              $salle->lits->pull($key); //$lits->push($lit);    
          }
        }
      }
      else
      {  
          foreach ($salle->lits as $key => $lit) {  
              $free = $lit->isFree(strtotime($request->StartDate),strtotime($request->EndDate));
              if(!($free))
                  $salle->lits->pull($key); //$lits->push($lit);    
          } 
            
      }    
      return $salle->lits;
    }
    public function getlits(Request $request)
    {
        $lits =array();
        $salle =salle::FindOrFail($request->SalleId);
        if(isset($request->rdvId))
        {
          $rdvHosp =  rdv_hospitalisation::FindOrFail($request->rdvId)->with('bedReservation');
          if(isset($rdvHosp->bedReservation))
            $rdvHosp->bedReservation->delete();           
        }
        foreach ($salle->lits as $key => $lit) {  
          $free = $lit->isFree(strtotime($request->StartDate),strtotime($request->EndDate));
          if(!($free))
            $salle->lits->pull($key); //$lits->push($lit);    
        } 
        return $salle->lits;
    }

}
