<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\colloque;
use App\modeles\consultation;
use App\modeles\employ;
use App\modeles\service;
use App\modeles\membre;
use App\modeles\dem_colloque;
use App\modeles\DemandeHospitalisation;
use App\modeles\fonction;
use App\modeles\medecin_traitant;
use App\User;
use Auth;
use Jenssegers\Date\Date;
use Response;
class ColloqueController extends Controller
{    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \App\modeles\colloque
     * @return \App\modeles\consultation
     * @return \App\modeles\employ
     * @return \App\modeles\membre
     * @return \App\modeles\dem_colloque
     * @return \App\modeles\DemandeHospitalisation
     * @return \App\modeles\fonction
     * @return App\Modeles\rol
     * @return App\User
     * @return \App\type_colloque
     * @return \App\modeles\medecin_traitant
     */ 
      public function __construct()
      {
        $this->middleware('auth');
      }
      public function index(Request $request)
      {
        $service = service::findOrFail(Auth::user()->employ->service_id);
        if($request->ajax())  
        { 
          if($request->value == '')
          
            $colloques = colloque::with('employs','Service')->where(trim($request->field), null)
                                ->where('service_id', $service->id)->get();
          else
            $colloques = colloque::with('employs','Service')->where(trim($request->field),'LIKE','%'.trim($request->value)."%")
                                ->where('service_id', $service->id)->get();
          return Response::json($colloques);
        }else
          //$colloques=colloque::with('employs','Service')->where('etat',null)->where('service_id', $service->id)->get();                                   
          return view('colloques.index', compact('colloques','service'));
      }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { /*$rols =  array(1,2,2,5,6,13,14);$membre = employ::whereHas('User', function ($q) use ($rols) {$q->whereIn('role_id',$rols);})->get();*/  
      $service = service::findOrFail(Auth::user()->employ->service_id);
      return view('colloques.add',compact('service'));
    }
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      { 
        $colloque=colloque::create([
                              "date"=>$request->date,
                              "service_id"=>Auth::user()->employ->service_id,         
        ]);
        foreach ($request->membres as $medecin) {
          $colloque->employs()->attach($medecin);
        }
        return redirect()->action('ColloqueController@index');//
    }
//  public function show($id_colloque){ }
  /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $service = service::findOrFail(Auth::user()->employ->service_id); 
      $colloque=colloque::find($id);
      $listeMeds = $service->employs->diff($colloque->employs);
      return view('colloques.edit',compact('colloque','listeMeds'));
    }
    public function show($id)
    {
      $colloque=colloque::find($id);
      $listeMeds = $listeMeds->diff($colloque->employs); 
      return view('colloques.show',compact('colloque','listeMeds'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\colloque  $colloque
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
        $colloque = colloque::find($id);
        foreach ($colloque->employs as $elt) {
            $colloque->employs()->detach($elt->id_employ);
        }
        foreach ($request->membres as $elt) {
          membre::create([
            "id_colloque"=>$colloque->id,
            "id_employ"=>$elt,
         ]);
        }   
        $colloque->update(["date"=>$request->date]);  
        return redirect()->action('ColloqueController@index');
    }
    public function getClosedColoques()
    {
      $colloques =  colloque::with('employs','demandes')->where('etat',1)->where('service_id',Auth::user()->employ->service_id)->get();                      
      return view('colloques.closedcolloque', compact('colloques'));                      
    }
    public function run($id)
    {  
      $colloque=colloque::find($id);
      $medecins = employ::whereHas('User', function($q){
                          $q->whereIn('role_id', [1,13,14]);
                        })->where('service_id', $colloque->service_id)->orderBy('nom')->get();
      $demandes = DemandeHospitalisation::where('service',$colloque->service_id)->where('etat',null)->where('modeAdmission','<>','2')->get();
      return view('colloques.run', compact('demandes','medecins','colloque'));
    }
    public function save(Request $request ,$id)
    {
      $colloque=colloque::FindOrFail($id);
      foreach ($request->valider as $key => $value) {
        $priorite ="prop".$value;  $obs = "observation".$value; $medecin="MedT".$value;
        $dem = dem_colloque::create([
              "id_colloque"=>$id,
              "id_demande"=>$value,        
              "ordre_priorite"=>$request->$priorite,
              "observation"=>$request->$obs,
              "id_medecin"=>$idmedecin,
        ]); 
        $demande = DemandeHospitalisation::FindOrFail($value); 
      }
    }
    public function cloture($id)
    {
      $colloque=colloque::FindOrFail($id);
      $colloque->update([ "etat"=>1 ]);
      return redirect()->action('ColloqueController@index',$colloque->type);  
    }
    public function destroy($id)
    {
      $col = colloque::find($id);
      $col->employs()->detach();
      $col->delete(); //$colloque = colloque::destroy($id);
      return redirect()->action('ColloqueController@index');
    }
}