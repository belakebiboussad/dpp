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
    public function index(Request $request)
    {
      if($request->ajax())  
      {
            $lits = lit::where('salle_id',$request->id)->get();
            $view = view("Salles.ajax_sallerooms",compact('lits'))->render();
            return ['html'=>$view];
      }else
      {
            $lits=lit::with('salle','salle.service')->get();
            return view('lits.index', compact('lits'));
      }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function createlit()  $services = service::all();{ return view('lits.create_lit_2', compact('services'));}
      public function create(Request $request)
      {
            $services = service::where('hebergement',1)->get();
              if(isset($request->id))
              {
                      $salle = salle::FindOrFail($request->id);
                     return view('lits.create', compact('services','salle'));
              }else
                return view('lits.create', compact('services'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
       {
               $lit =lit::create($request->all());
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
        return Response::json(['html'=>$view]);
      }else
        return view('lits.show', compact('lit'));
      
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
              $input = $request->all();
               $input['bloq'] = isset($_POST['bloq'])  ?  $request->bloq : null ;
              $lit->update($input);   
               return redirect()->route('lit.index');
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
        $lit = lit::FindOrFail( $request->lit_id);
        return $lit->bedReservation;
        if($demande->getModeAdmissionID($demande->modeAdmission) !=2) 
        { 
          $rdv = $demande->getInProgressMet();
          if($rdv->has('bedReservation'))
            $rdv->bedReservation()->delete();
          //$free = $lit->isFree(strtotime($rdv->date),strtotime($rdv->date_Prevu_Sortie));  
        }else
        { 
          $now = $today = Carbon::now()->toDateString();
          $newDateTime = Carbon::now()->addDay(3)->toDateString();
          //get reservation of this bed between this day

          $free = $lit->isFree(strtotime($now),strtotime( $newDateTime));
          $demande->update([ 'etat' => 1 ]); //program  
        }
        /*
        if(!$free)
          $lit->bedReservation()->delete(); 
        */
        $affect = bedAffectation::create($request->all());
        $lit->update([ "affectation" =>1 ]);
        return $affect;
      }
        public function affecter()
        {
          $now = date("Y-m-d", strtotime('now'));
          $services = service::where('hebergement','1')->get();
          $rdvs = rdv_hospitalisation::doesntHave('demandeHospitalisation.bedAffectation')
                                      ->whereHas('demandeHospitalisation',function ($q){
                                           $q->where('service',Auth::user()->employ->service_id)->where('etat',1);      
                                    })->where('date','>=',$now)->where('etat', null)->get();                         
          $demandesUrg= DemandeHospitalisation::doesntHave('bedAffectation')
                                        ->whereHas('consultation',function($q) use($now){
                                             $q->where('date', $now);
                                        })->where('modeAdmission','2')->where('etat',null)->where('service',Auth::user()->employ->service_id)->get();
          return view('bedAffectations.index', compact('rdvs','demandesUrg','services'));  
    }
  /**
  **function ajax return lits ,on retourne pas les lits bloque ou reservé
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
