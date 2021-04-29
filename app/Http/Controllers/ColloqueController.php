<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\colloque;
use App\modeles\consultation;
use App\modeles\employ;
use App\modeles\membre;
use App\modeles\dem_colloque;
use App\modeles\DemandeHospitalisation;
use App\modeles\fonction;
use App\modeles\medecin_traitant;
use App\User;
use Jenssegers\Date\Date;
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
      public function index($type = 0)
       {
            $colloques=colloque::with('employs')->where('etat','<>','cloturé')->where('type','=',$type)->get();
             return view('colloques.index', compact('colloques','type'));
       }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {  
       $rols =  array(1,2,2,5,6,13,14);
       $membre = employ::whereHas('User', function ($q) use ($rols) {
                                        $q->whereIn('role_id',$rols);                           
                                    })->get();
          return view('colloques.create',compact('membre'));//,'type_c'
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
                                "date"=>$request->date_colloque,
                                "etat"=>"en cours",
                                "date_creation"=>Date::Now(),
                                "type"=>$request->type_colloque,              
                              ]);    
        foreach ($request->membres as $medecin) {
              $colloque->employs()->attach($medecin);
        }
         return redirect()->action('ColloqueController@index',$colloque->type);
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
      $colloque=colloque::find($id);
      $rols =  array(1,2,2,5,6,13,14);
      $listeMeds = employ::whereHas('User', function ($q) use ($rols) {
                                            $q->whereIn('role_id',$rols);                           
                                        })->get();
      $listeMeds = $listeMeds->diff($colloque->employs); //$type_c = type_colloque::all();
       return view('colloques.edit',compact('colloque','listeMeds'));//,'type_c'
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
      $colloque->update([
                          "date"=>$request->date_colloque,
                          "etat"=>"en cours",
                          "date_creation"=>Date::Now(),
                          "type"=>$request->type_colloque,              
                      ]);  
      return redirect()->action('ColloqueController@index');
    }
      public function getClosedColoques($type)
      {
              $colloques =  colloque::with('employs','demandes')->where('etat','cloturé')->where('type',$type)->get();                      
            return view('colloques.liste_closedcolloque', compact('colloques','type'));                      
      }
    public function run($id)
    {  
        $colloque=colloque::find($id);
        $type = $colloque->type;
        $demandes = DemandeHospitalisation::whereHas('Specialite', function ($q) use ($type) {
                              $q->where('type',$type);
                      })->where('etat','en attente')->where('modeAdmission','<>','urgence')->get();
        $medecins = employ::whereHas('User', function($q){
          $q->whereIn('role_id', [1,13,14]);
        })->orderBy('nom')->get();//$medecins = user::whereIn('role_id',[1,13,14]);
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
        $colloque->update([
                    "etat"=>"cloturé",
        ]);
        return redirect()->action('ColloqueController@index',$colloque->type);  
  }
  public function destroy($id){
    $col = colloque::find($id, ['type']);
    foreach($col->employs as $employ)
    {
      $col->employs()->dettach($employ);
    }
    $colloque = colloque::destroy($id);
    return redirect()->action('ColloqueController@index',$col->type);
  }
}

