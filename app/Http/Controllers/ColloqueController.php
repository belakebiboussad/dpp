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

    public function index($type)
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
           $membre = user::join('employs', 'utilisateurs.employee_id','=','employs.id')->join('rols','utilisateurs.role_id', '=', 'rols.id')->select('employs.id','Nom_Employe','Prenom_Employe')->where('rols.id', '=','1' )->orWhere('rols.id', '=','2' )
             ->orWhere('rols.id', '=','5' ) ->orWhere('rols.id', '=','6' )->get(); 
           $type_c=type_colloque::select('id', 'type')->get();
           return view('colloques.addcolloque',compact('membre','type_c'));
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
        $demandes = DemandeHospitalisation::join('consultations','consultations.id','=','demandehospitalisations.id_consultation')
                                          ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                                          ->join('employs', 'consultations.Employe_ID_Employe','=','employs.id')
                                          ->join('services','demandehospitalisations.service','=','services.id')
                                          ->join('specialites','specialites.id','=','demandehospitalisations.specialite')->select('demandehospitalisations.*','specialites.nom as nomSpec','specialites.type','consultations.Date_Consultation','patients.Nom as nomPat','patients.Prenom as prenomPat','patients.Dat_Naissance','patients.group_sang','patients.rhesus','employs.Nom_Employe','employs.Prenom_Employe','services.nom as nomService')
                                          ->where('specialites.type',$typeCol)->get(); 
        $medecins = user::join('employs', 'utilisateurs.employee_id','=','employs.id')
                        ->join('rols','utilisateurs.role_id', '=', 'rols.id')
                        ->select('employs.id','Nom_Employe','Prenom_Employe')
                        ->where('rols.role', '=','Medecine')->get(); 

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
        return view('colloques.runcolloque', compact('demandes','medecins','colloque'));  
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
             $type = $colloque->type_colloque;
             $demandes =   DemandeHospitalisation::whereHas('Specialite.type', function ($q) use ($type) {
                          $q->where('type',$type);
                  })->get();                            
              $medecins = user::where('utilisateurs.role_id',1)->orwhere('utilisateurs.role_id',13)->get();               
              //dd($medecins);;
              return view('colloques.runcolloque', compact('demandes','medecins','colloque'));
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
           $colloque=colloque::FindOrFail($id);
           foreach ($request->valider as $key => $value) {
                    $priorite ="prop".$value;  $obs = "observation".$value; $medecin="MedT".$value;
                    $idmedecin = $request->$medecin; 
                     $demande = DemandeHospitalisation::FindOrFail($value); 
                     $demande->etat ="valide";
                     $demande->save();
                    $dem = dem_colloque::create([
                            "id_colloque"=>$id,
                            "id_demande"=>$value,        
                            "ordre_priorite"=>$request->$priorite,
                            "observation"=>$request->$obs,
                            "id_medecin"=>$idmedecin,
                ]); 
            }
             $colloque->update([
                   "etat_colloque"=>"cloturé",
             ]);
          return redirect()->action('ColloqueController@index');  
  }
  public function getClosedColoquesOrg($type)
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
                                      ->select('demandehospitalisations.id as id-demande','demandehospitalisations.etat as etat_demande',
                                               'consultations.Date_Consultation as Date_demande','colloques.id as id_colloque','colloques.*',
                                               'employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom',
                                               'type_colloques.type','dem_colloques.id_demande','consultations.Date_Consultation')
                                      ->where('etat_colloque','=','cloturé')->where('type_colloques.id','=',1)->get();  
                      break;
                case 2:
                   $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')
                                      ->join('employs','membres.id_employ','=','employs.id')
                                      ->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')
                                      ->leftJoin('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')
                                      ->leftJoin('consultations','demandehospitalisations.id_consultation','=','consultations.id')
                                      ->leftJoin('patients','consultations.Patient_ID_Patient','=','patients.id')
                                      ->leftJoin('type_colloques','colloques.type_colloque','=','type_colloques.id')
                                      ->select('demandehospitalisations.id as id-demande','demandehospitalisations.etat as etat_demande',
                                               'consultations.Date_Consultation as Date_demande','colloques.id as id_colloque','colloques.*',
                                               'employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom',
                                               'type_colloques.type','dem_colloques.id_demande')
                                      ->where('etat_colloque','=','cloturé')->where('type_colloques.id','=',2)->get();                 
                      break;
                default:
                      break;
      }
      foreach( $colloques as $col){
              if (!array_key_exists($col->id_colloque,$colloque))
              {
                  $colloque[$col->id_colloque]= array( "dat"=> $col->date_colloque ,
                                                       "creation"=>$col->date_creation,
                                                       "Type"=>$col->type,"Etat"=>$col->etat_colloque,
                                                       "membres"=> array ("$col->Nom_Employe $col->Prenom_Employe"),
                                                       "demandes"=> array( $col->id_demande=>array(
                                                                            "id_dem"  =>$col->id_demande ,
                                                                            "date_dem"=>$col->Date_demande ,
                                                                            "etat_dem"=>$col->etat_demande,
                                                                            "patient" =>"$col->Nom $col->Prenom")
                                                                        )
                                                      );
              }
              else
              {
                  if (array_search("$col->Nom_Employe $col->Prenom_Employe", $colloque[$col->id_colloque]["membres"])===false)
                      $colloque[$col->id_colloque]["membres"][]="$col->Nom_Employe $col->Prenom_Employe";
                  if (!array_key_exists($col->id_demande, $colloque[$col->id_colloque]["demandes"])) {      
                      $colloque[$col->id_colloque]["demandes"][$col->id_demande]=array( "id_dem"=>$col->id ,                                           
                                                                                        "date_dem"=>$col->Date_demande ,
                                                                                        "etat_dem"=>$col->etat_demande,
                                                                                        "patient"=>"$col->Nom $col->Prenom");
                  }
                     
              }
      }

      return view('colloques.liste_closedcolloque', compact('colloque','type'));  
  }
  public function getClosedColoques($type)
  {
       $demandes =   dem_colloque::whereHas('demandeHosp.Specialite.type', function ($q) use ($type) {
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


}
