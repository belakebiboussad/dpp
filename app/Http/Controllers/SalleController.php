<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\salle;
use App\modeles\lit;
use App\modeles\service;
use App\modeles\patient;
use App\modeles\DemandeHospitalisation;
use Validator;
use Redirect;
use MessageBag;
use Response;
class SalleController extends Controller
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
      $salles = salle::all();
      return view('Salles.index', compact('salles'));
    }
    public function getRooms(Request $request)
    {
      
      $service = service::with('salles')->where('id',$request->search)->get();
      $view = view("services.ajax_servicerooms",compact('service'))->render();
      return response()->json(['html'=>$view]);
/*
      $service = service::with('salles')->FindOrFail($request->search)->get();
      $view = view("services.ajax_servicerooms",compact('service'))->render();
      return response()->json(['html'=>$view]);
      */
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if(isset($request->id))
      {
        $service = service::FindOrFail($request->id);
        return view('Salles.add', compact('service'));
      }else
      {
        $services = service::where('hebergement',1)->get();
        return view('Salles.add', compact('services'));
      }  
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
      salle::create($request->all());  
      return redirect()->action('SalleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salle = salle::FindOrFail($id);
        $lits = lit::where("salle_id", $salle->id)->get()->all();
        return view('Salles.show', compact('salle','lits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $salle = salle::FindOrFail($id);
      $services = service::all();
      return view('Salles.edit', compact('salle','services'));
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
      $salle = salle::FindOrFail($id);
      $salle->update($request->all());
      return redirect()->action('SalleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $salle = salle::destroy($id);
      return redirect()->route('salle.index');
    }
    public function getsalles(Request $request)
    {
      $type = 0;
      $demande = DemandeHospitalisation::with('consultation.patient')->FindOrFail($request->demande_id);
      if($demande->consultation->patient->Sexe == "M")
      {
        $type = 0;
      }
      elseif($demande->consultation->patient->Sexe == "F")
      {
        $type = 1;
      }
      $salles = salle::where('service_id',$request->ServiceID)->where('genre', $type)->where('etat',null)->get();
      if( $request->Affect == '0')  
      {
        foreach ($salles as $key1 => $salle) {
          foreach ($salle->lits as $key => $lit) {
                $free = $lit->isFree(strtotime($request->StartDate),strtotime($request->EndDate)); //$lit->id,
                if(! $free)
              {
                  $salle->lits->pull($key);
              }
          }
        }
        foreach ($salles as $key => $salle) {
          if((count($salle->lits) == 0))
            $salles->pull($key);
        }
        }else{
          foreach ($salles as $key1 => $salle) {
            foreach ($salle->lits as $key => $lit) {
              $affect = $lit->affecter($lit->id); 
              if($affect)
              {
                $salle->lits->pull($key);
              }
            }
          }
          foreach ($salles as $key => $salle) {
                if((count($salle->lits) == 0))
                       $salles->pull($key);
          }
      }
      return($salles);
    }
}
