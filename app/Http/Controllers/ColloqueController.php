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
use App\modeles\type_colloque;
use App\modeles\medecin_traitant;
use App\User;
use Jenssegers\Date\Date;
//use Request;

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
            $colloques=colloque::with('Type','membres')->where('etat','<>','cloturé')->where('type','=',$type)->get();
           // dd( $colloques);
            return view('colloques.index', compact('colloques','type'));
       }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
      $membre = user::join('employs', 'utilisateurs.employee_id','=','employs.id')
                    ->join('rols','utilisateurs.role_id', '=', 'rols.id')
                    ->select('employs.id','nom','prenom')
                    ->where('rols.id', '=','1' )
                    ->orWhere('rols.id', '=','2' )
                    ->orWhere('rols.id', '=','5' ) ->orWhere('rols.id', '=','6' )->get();  //$type_c=type_colloque::select('id', 'type')->get();
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
            $medmemebres =$request->membres;
              foreach ($medmemebres as $elt) {
                   membre::create([
                        "id_colloque"=>$colloque->id,
                        "id_employ"=>$elt,
                    ]);
            }
            return redirect()->action('ColloqueController@index',$colloque->type);
    }

    public function show($id_colloque)
    {
    }
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
      $listeMeds = $listeMeds->diff($colloque->membres);
      $type_c = type_colloque::all();
       return view('colloques.edit',compact('colloque','listeMeds','type_c'));
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
      foreach ($colloque->membres as $elt) {
        $colloque->membres()->detach($elt->id_employ);
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
        $demandes = dem_colloque::whereHas('demandeHosp.Specialite.type', function ($q) use ($type) {
                            $q->where('id',$type);
                    })->get();
        $colloque = array();
        switch ($type) {
                  case 1:
                      $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')
                                        ->join('employs','membres.id_employ','=','employs.id')
                                        ->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')
                                        ->leftJoin('type_colloques','colloques.type','=','type_colloques.id')
                                        ->select('colloques.id as id_colloque','colloques.*',
                                                 'employs.nom','employs.prenom',
                                                 'type_colloques.type','dem_colloques.id_demande')
                                        ->where('etat','=','cloturé')->where('type_colloques.id','=',1)->get();  
                        break;
                  case 2:
                     $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')
                                        ->join('employs','membres.id_employ','=','employs.id')
                                        ->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')
                                        ->leftJoin('type_colloques','colloques.type','=','type_colloques.id')
                                        ->select('colloques.id as id_colloque','colloques.*',
                                                 'employs.nom','employs.prenom',
                                                 'type_colloques.type','dem_colloques.id_demande')
                                        ->where('etat','=','cloturé')->where('type_colloques.id','=',2)->get();                 
                        break;
                  default:
                        break;
          }
          foreach( $colloques as $col){
                if (!array_key_exists($col->id_colloque,$colloque))
                {
                    $colloque[$col->id_colloque]= array( "id"=> $col->id_colloque,
                                                         "dat"=> $col->date,
                                                         "creation"=>$col->date_creation,
                                                         "Type"=>$col->type,"Etat"=>$col->etat,
                                                         "membres"=> array ("$col->nom $col->prenom"));
                }
                else
                {
                    if (array_search("$col->nom $col->prenom", $colloque[$col->id_colloque]["membres"])===false)
                        $colloque[$col->id_colloque]["membres"][]="$col->nom $col->prenom";
                                        
                }
        }
        return view('colloques.liste_closedcolloque', compact('colloque','type','demandes'));                      
    }
    public function run($id)
    {  
      $colloque=colloque::find($id);
      $type = $colloque->type;
      dd($type);
      $demandes = DemandeHospitalisation::whereHas('Specialite.type', function ($q) use ($type) {
                            $q->where('type',$type);
                    })->where('etat','en attente')->where('modeAdmission','<>','urgence')->get();
      $medecins = user::where('utilisateurs.role_id',1)->orwhere('utilisateurs.role_id',13)->get();               
      return view('colloques.runcolloque', compact('demandes','medecins','colloque'));
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
    return redirect()->action('ColloqueController@index');  
  }
  public function destroy($id){
      $col = colloque::find($id, ['type']);
      $colloque = colloque::destroy($id);
      return redirect()->action('ColloqueController@index',$col->type);
  }
}

