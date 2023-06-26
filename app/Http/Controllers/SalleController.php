<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\salle;
use App\modeles\lit;
use App\modeles\service;
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
    public function index(Request $request)
    {
      $salles = salle::all();
        return view('Salles.index', compact('salles'));
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
      salle::create($request->all());  
      return redirect()->action('SalleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(salle $salle)
    {
      $lits = lit::where("salle_id", $salle->id)->get()->all();
      return view('Salles.show', compact('salle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(salle $salle)
    {
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
    public function update(Request $request, salle $salle)
    {
      $input = $request->all();
      $input['etat'] =(isset($request->etat))?'1': null;
      $salle->update($input);
      return redirect()->action('SalleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(salle $salle)
    {
      $salle->delete();
      return redirect()->route('salle.index');
    }
    public function getsallesTeste(Request $request)
    {
      $genre = 0;
      $service = service::FindOrFail($request->ServiceID);
      $demande = DemandeHospitalisation::with('consultation.patient')->FindOrFail($request->demande_id);
      if($demande->consultation->patient->Sexe == "F")
        $genre = 1;
       $salles = $service->salles()->where('genre', $genre)->whereNull('etat')->get();
      $outout = "";
      if( $request->Affect == "0")
      {     
        foreach ($salles as $salle) {
          foreach ($salle->lits as $lit) {   
            $outout = $lit->isFree(strtotime($request->StartDate),strtotime($request->EndDate));
            return $outout;
          }
        }
     
      }else
      {
        return "affectation";
      }
    } 
    public function getsalles(Request $request)
    {
      $genre = 0;//homme
      $service = service::FindOrFail($request->ServiceID);
      $demande = DemandeHospitalisation::with('consultation.patient')->FindOrFail($request->demande_id);
      if($demande->consultation->patient->Sexe == "F")
        $genre = 1;
      $salles = $service->salles()->where('genre', $genre)->whereNull('etat')->get();//etat =1 bloqué
      if( $request->Affect == '0')//Affect = 0 => reserv, Affect = 1 => affectation  
      {
        foreach ($salles as $key1 => $salle) {
          foreach ($salle->lits as $key => $lit) {
            $free = $lit->isFree(strtotime($request->StartDate),strtotime($request->EndDate));
            if(! $free)
              $salle->lits->pull($key);
          }
        }
        foreach ($salles as $key => $salle) {
          if((count($salle->lits) == 0))
            $salles->pull($key);
        }
        }else{
          foreach ($salles as $key1 => $salle) {
               foreach ($salle->lits as $key => $lit) {
                    $affect = $lit->isAffected();
                    if($affect)
                      $salle->lits->pull($key);
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
