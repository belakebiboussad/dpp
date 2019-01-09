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
use App\Modeles\rol;
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

    public function index()
    { 
    	$demandes = consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                                                        ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                                                        ->join('employs', 'consultations.Employe_ID_Employe','=','employs.id')
                                                        ->select('demandehospitalisations.*','consultations.Employe_ID_Employe','consultations.Date_Consultation','patients.Nom','patients.Prenom','patients.Dat_Naissance','employs.Nom_Employe','employs.Prenom_Employe')
                                                        ->get();                                        
       
        $colloques=colloque::join('membres','colloques.id','=','membres.id_colloque')->join('employs','membres.id_employ','=','employs.id')->leftJoin('dem_colloques','colloques.id','=','dem_colloques.id_colloque')->leftJoin('demandehospitalisations','dem_colloques.id_demande','=','demandehospitalisations.id')->leftJoin('consultations','demandehospitalisations.id_consultation','=','consultations.id')->leftJoin('patients','consultations.Patient_ID_Patient','=','patients.id')->leftJoin('type_colloques','colloques.type_colloque','=','type_colloques.id')->select('demandehospitalisations.id as id-demande','demandehospitalisations.Date_demande','colloques.id as id_colloque','colloques.*','employs.Nom_Employe','employs.Prenom_Employe','patients.Nom','patients.Prenom','type_colloques.type')->get(); 

        $medecins = user::join('employs', 'utilisateurs.employee_id','=','employs.id')->join('rols','utilisateurs.role_id', '=', 'rols.id')->select('employs.id','Nom_Employe','Prenom_Employe')->where('rols.role', '=','Medecine')->get();
	return view('colloques.liste_colloque', compact('demandes','colloques','medecins'));
    	 //return view('Hospitalisations.colloque');
  
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

      $membre = employ::select('id','Nom_Employe','Prenom_Employe')->get();       
      $type_c=type_colloque::select('id', 'type')->get();
        return view('colloques.colloque',compact('membre','type_c'));
    }


 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
      $demandes = consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                                                        ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                                                        ->join('employs', 'consultations.Employe_ID_Employe','=','employs.id')
                                                        ->select('demandehospitalisations.*','consultations.Employe_ID_Employe','consultations.Date_Consultation','patients.Nom','patients.Prenom','patients.Dat_Naissance','employs.Nom_Employe','employs.Prenom_Employe')
                                                        ->get();
                                                      
       $medecins = user::join('employs', 'utilisateurs.employee_id','=','employs.id')->join('rols','utilisateurs.role_id', '=', 'rols.id')->select('employs.id','Nom_Employe','Prenom_Employe')->where('rols.role', '=','Medecine')->get(); 

       $date_creation = Date::Now();
       $col=colloque::create([
        "date_colloque"=>$request->date_colloque,
        "etat_colloque"=>"en cours",
        "date_creation"=>$date_creation,
        "type_colloque"=>$request->type_colloque,
        
       ]);
      foreach ($request->elt as $elts) {

          membre::create([
            "id_colloque"=>$col->id,
            "id_employ"=>$elts,
       ]);

      }

     
      //$colloques = colloque::FindOrFail($col->id);

      $colloques=colloque::select('colloques.*')->where('colloques.id','=',$col->id)->get();
      //dd($colloques);
     return view('colloques.new_colloque', compact('demandes','medecins','colloques'));

     //return redirect()->action('ColloqueController@new',['id_colloque'=>$colloque->id]);  
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
     // $demandes = consultation::join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                                                     //   ->join('patients','consultations.Patient_ID_Patient','=','patients.id')
                                                       // ->join('employs', 'consultations.Employe_ID_Employe','=','employs.id')
                                                        //->select('demandehospitalisations.*','consultations.Employe_ID_Employe','consultations.Date_Consultation','patients.Nom','patients.Prenom','patients.Dat_Naissance','employs.Nom_Employe','employs.Prenom_Employe')
                                                        //->get();
      $demandes = DemandeHospitalisation::all();
                                                      
       $medecins = user::join('employs', 'utilisateurs.employee_id','=','employs.id')->join('rols','utilisateurs.role_id', '=', 'rols.id')->select('employs.id','Nom_Employe','Prenom_Employe')->where('rols.role', '=','Medecine')->get();

        $colloques = colloque::FindOrFail($id);
         return view('colloques.new_colloque', compact('demandes','medecins','colloques'));
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
        //
      $colloque=colloque::FindOrFail($id);
       foreach ($request->demh as $i=>$dem) {
        
            $demand = DemandeHospitalisation::FindOrFail($dem);
           //dd($demand);
        $demand -> update([
            "etat"=>"validée",
        ]);
        
       dem_colloque::create([
        "id_colloque"=>$id,
        "id_demande"=>$dem,        
        "ordre_priorite"=>$request->prio[$i],
        "observation"=>$request->observation[$i],
        
       ]);
       medecin_traitant::create([
        "id_colloque"=>$id,
        "id_demande"=>$dem,
        "id_medecin"=>$request->medt[$i],
        
       ]);
        
      }
     $colloque->update([
            "etat_colloque"=>"cloturé",
        ]);

      return redirect()->action('ColloqueController@index');  
    }


}
