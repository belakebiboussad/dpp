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
use App\modeles\employ;
use Carbon\Carbon;
use Auth; 
use Response;
class LitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
      {
          $this->middleware('auth');
      }
    public function index()
    {
      $lits=lit::with('salle','salle.service')->get();
      return view('lits.index', compact('lits'));
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
      $services = service::where('hebergement',1)->get();//$services = service::all();
      return view('lits.create', compact('services','id_salle'));
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
    public function show(Request $request,$id)
    {
      $lit = lit::with('salle','salle.service')->FindOrFail($id);
      if($request->ajax())  
      {
        $view = view("lits.ajax_show",compact('lit'))->render();
        return response()->json(['html'=>$view]);
      }else{
        return view('lits.show', compact('lit'));
      }
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
      return view('lits.edit', compact('lit','salles'));
    }
    public function destroy($id)
    {
      $lit = lit::destroy($id);
      return redirect()->route('lit.index');    
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
          "etat"=>$etat,//"affectation"=>$request->affectation,
          "salle_id"=>$request->salle,
        ]);
        return redirect()->route('lit.index');//return redirect()->action('LitsController@index');
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //affeter lit pour demande d'urgence
    public function affecterLit(Request $request )
    {
      $demande= DemandeHospitalisation::find($request->demande_id); 
      $rdv = $demande->RDVs->where('etat_RDVh', NULL)->first();   //if($rdv->has('bedReservation'))    $rdv->bedReservation()->delete();
      $lit = lit::FindOrFail( $request->lit_id);
      if($lit->has('bedReservation'))
      {
        if($demande->modeAdmission !="Urgence" )
        {
          $free = $lit->isFree(strtotime($rdv->date_RDVh),strtotime($rdv->date_Prevu_Sortie));  
          if(!$free)
            $lit->bedReservation()->delete();
        }else {
          $now = $today = Carbon::now()->toDateString();
          $newDateTime = Carbon::now()->addDay(3)->toDateString();
          $free = $lit->isFree(strtotime($now),strtotime( $newDateTime));  
          if(!$free)
            $lit->bedReservation()->delete();
          $demande->update([
            'etat' => 'programme'
          ]); 
        }  
      } 
      $affect = bedAffectation::create($request->all());
      $lit->update([
        "affectation" =>1,
      ]);
      if($request->ajax())  
        return Response::json($affect);
    }
    public function affecter()
    {
      $now = date("Y-m-d", strtotime('now'));
      $services = service::all();
      $rdvs = rdv_hospitalisation::doesntHave('demandeHospitalisation.bedAffectation')
                                 ->whereHas('demandeHospitalisation',function ($q){
                                    $q->where('service',Auth::user()->employ->service)
                                      ->where('etat','programme');    
                                 })->where('date_RDVh','>=',$now)->get();
      $demandesUrg= DemandeHospitalisation::doesntHave('bedAffectation')
                                          ->whereHas('consultation',function($q) use($now){
                                               $q->where('Date_Consultation', $now);
                                          })->where('modeAdmission','Urgence')->where('etat','en attente')
                                            ->where('service',Auth::user()->employ->service)->get(); 
      return view('bedAffectations.index', compact('rdvs','demandesUrg','services'));  
    }
    //public function destroy($id){}
    /**
    //function ajax return lits ,on retourne pas les lits bloque ou reservé  
    */
    public function getlits(Request $request)
    {
      $lits =array();
      $salle =salle::FindOrFail($request->SalleId);
      if( $request->Affect == '0')  
      {
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
      }else
      {
        foreach ($salle->lits as $key => $lit) {
          $affect = $lit->affecter($lit->id); 
          if($affect)
            $salle->lits->pull($key);
        }
      }    
      return $salle->lits;
    }

}
