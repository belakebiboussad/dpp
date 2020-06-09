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
    public function index($type = 1)
    { 
          $colloque= array();
          switch ($type) {
                 case 1:
                      $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')
                                         ->join('employs','membres.id_employ','=','employs.id')
                                         ->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')
                                         ->leftJoin('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')
                                         ->leftJoin('consultations','demandehospitalisations.id_consultation','=','consultations.id')
                                         ->leftJoin('patients','consultations.Patient_ID_Patient','=','patients.id')
                                         ->leftJoin('type_colloques','colloques.type_colloque','=','type_colloques.id')
                                         ->select('demandehospitalisations.id as id-demande','colloques.id as id_colloque','colloques.*',
                                                   'employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom',
                                                   'type_colloques.type','dem_colloques.id_demande','consultations.Date_Consultation')
                                          ->where('etat_colloque','<>','cloturé')->where('type_colloques.id','=',1)->get();  
                      break;
                case 2:
                      $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')
                                          ->join('employs','membres.id_employ','=','employs.id')
                                          ->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')
                                          ->leftJoin('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')
                                          ->leftJoin('consultations','demandehospitalisations.id_consultation','=','consultations.id')
                                          ->leftJoin('patients','consultations.Patient_ID_Patient','=','patients.id')
                                          ->leftJoin('type_colloques','colloques.type_colloque','=','type_colloques.id')
                                          ->select('demandehospitalisations.id as id-demande','colloques.id as id_colloque','colloques.*',
                                                   'employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom',
                                                   'type_colloques.type','dem_colloques.id_demande','consultations.Date_Consultation')
                                          ->where('etat_colloque','<>','cloturé')->where('type_colloques.id','=',2)->get();                 
                      break;
                default:
                      break;
          }           
          foreach( $colloques as $col){
              if (!array_key_exists($col->id_colloque,$colloque))
              {
                  $colloque[$col->id_colloque]= array("dat"=> $col->date_colloque ,"creation"=>$col->date_creation,"Type"=>$col->type,"Etat"=>$col->etat_colloque,"membres"=> array ("$col->Nom_Employe $col->Prenom_Employe"),
                  "demandes"=>array($col->id_demande=>array(
                            "id_dem"=>$col->id_demande ,"date_dem"=>$col->Date_demande ,"patient"=>"$col->Nom $col->Prenom")));
              }
              else{
                  if (array_search("$col->Nom_Employe $col->Prenom_Employe", $colloque[$col->id_colloque]["membres"])===false)
                      $colloque[$col->id_colloque]["membres"][]="$col->Nom_Employe $col->Prenom_Employe";
                      if (!array_key_exists($col->id_demande, $colloque[$col->id_colloque]["demandes"])) {      
                          $colloque[$col->id_colloque]["demandes"][$col->id_demande]=array(
                                "id_dem"=>$col->id ,"date_dem"=>$col->Date_demande ,"patient"=>"$col->Nom $col->Prenom");
                      }
                     
                  }
            }

            return view('colloques.liste_colloque', compact('colloque','type'));// return view('home.home_dele_coll', compact('demandes','colloques'));
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
                    ->select('employs.id','Nom_Employe','Prenom_Employe')
                    ->where('rols.id', '=','1' )
                    ->orWhere('rols.id', '=','2' )
                    ->orWhere('rols.id', '=','5' ) ->orWhere('rols.id', '=','6' )->get(); 
      $type_c=type_colloque::select('id', 'type')->get();
      return view('colloques.create',compact('membre','type_c'));
    }


 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $typeCol=$request->type_colloque;
        $colloque=colloque::create([
                                    "date_colloque"=>$request->date_colloque,
                                    "etat_colloque"=>"en cours",
                                    "date_creation"=>Date::Now(),
                                    "type_colloque"=>$request->type_colloque,              
                                  ]);    

        $medmemebres =$request->membres;
        foreach ($medmemebres as $elt) {
                   membre::create([
                        "id_colloque"=>$colloque->id,
                        "id_employ"=>$elt,
                    ]);
        }   
        return redirect()->action('ColloqueController@index',$colloque->type_colloque);// return view('colloques.runcolloque', compact('demandes','medecins','colloque'));

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
      $listeMeds = user::join('employs', 'utilisateurs.employee_id','=','employs.id')
                    ->join('rols','utilisateurs.role_id', '=', 'rols.id')
                    ->select('employs.id','Nom_Employe','Prenom_Employe')
                    ->where('rols.id', '=','1' )
                    ->orWhere('rols.id', '=','2' )
                    ->orWhere('rols.id', '=','5' ) ->orWhere('rols.id', '=','6' )->get(); 
      $listeMeds =  $listeMeds->diff($colloque->membres);
      $type_c=type_colloque::select('id', 'type')->get();
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
                          "date_colloque"=>$request->date_colloque,
                          "etat_colloque"=>"en cours",
                          "date_creation"=>Date::Now(),
                          "type_colloque"=>$request->type_colloque,              
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
                                        ->leftJoin('type_colloques','colloques.type_colloque','=','type_colloques.id')
                                        ->select('colloques.id as id_colloque','colloques.*',
                                                 'employs.Nom_Employe','employs.Prenom_Employe',
                                                 'type_colloques.type','dem_colloques.id_demande')
                                        ->where('etat_colloque','=','cloturé')->where('type_colloques.id','=',1)->get();  
                        break;
                  case 2:
                     $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')
                                        ->join('employs','membres.id_employ','=','employs.id')
                                        ->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')
                                        ->leftJoin('type_colloques','colloques.type_colloque','=','type_colloques.id')
                                        ->select('colloques.id as id_colloque','colloques.*',
                                                 'employs.Nom_Employe','employs.Prenom_Employe',
                                                 'type_colloques.type','dem_colloques.id_demande')
                                        ->where('etat_colloque','=','cloturé')->where('type_colloques.id','=',2)->get();                 
                        break;
                  default:
                        break;
          }
          foreach( $colloques as $col){
                if (!array_key_exists($col->id_colloque,$colloque))
                {
                    $colloque[$col->id_colloque]= array( "id"=> $col->id_colloque,
                                                         "dat"=> $col->date_colloque ,
                                                         "creation"=>$col->date_creation,
                                                         "Type"=>$col->type,"Etat"=>$col->etat_colloque,
                                                         "membres"=> array ("$col->Nom_Employe $col->Prenom_Employe"));
                }
                else
                {
                    if (array_search("$col->Nom_Employe $col->Prenom_Employe", $colloque[$col->id_colloque]["membres"])===false)
                        $colloque[$col->id_colloque]["membres"][]="$col->Nom_Employe $col->Prenom_Employe";
                                        
                }
        }
        return view('colloques.liste_closedcolloque', compact('colloque','type','demandes'));                      
    }
    public function run($id)
    {  
      $colloque=colloque::find($id);
      $type = $colloque->type_colloque;
      $demandes =   DemandeHospitalisation::whereHas('Specialite.type', function ($q) use ($type) {
                            $q->where('type',$type);
                    })->where('etat','=','en attente')->get();
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
  ///cloturer le colloque
  public function cloture($id)
  {
    $colloque=colloque::FindOrFail($id);
    $colloque->update([
                "etat_colloque"=>"cloturé",
    ]);
    return redirect()->action('ColloqueController@index');  
  }
  public function destroy($id){
    $col = colloque::find($id, ['type_colloque']);
    $colloque = colloque::destroy($id);
    return redirect()->action('ColloqueController@index',$col->type_colloque);
  }
}

