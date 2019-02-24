<?php
namespace App\Http\Controllers;
use App\modeles\patient;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\modeles\assur;
use App\modeles\rdv;
use Yajra\DataTables\Facades\DataTables;
use App\modeles\consultation;
use App\modeles\examenbiologique;
use App\modeles\DemandeHospitalisation;
use App\modeles\hospitalisation;
<<<<<<< HEAD
use App\modeles\antecedant;
use App\Utils\ArrayClass;
use App\modeles\ticket;
=======
use App\modeles\homme_conf;
>>>>>>> e3e729a4a9b624b67f91ea710e0b3d6887a5fe66
use Validator;
use Redirect;
use MessageBag;
use Carbon\Carbon;
// use Session;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listerdv($id_patient)
    {
       $patient = patient::FindOrFail($id_patient);
       $rdvs = rdv::where("Patient_ID_Patient",$id_patient)->get()->all(); 
       return view('patient.liste_rdv_pat',compact('patient','rdvs'));
    }
    public function index()
    {
        //$patients = patient::all(); // return view('patient.index_patient', compact('patients'));
      return view('patient.index_patient');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient.addPatient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
      {
            static $assurObj;
            $date = Date::Now();
             //dd($request->all());
             $rule = array(
                  "nom" => 'required',
                  "prenom" => 'required',
                  "datenaissance" => 'required|date|date_format:Y-m-d',
                  "lieunaissance" => 'required',
                  "mobile1"=> ['required', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
                  "Type_p" =>'required_if:type,Ayant_droit',
                 // "nss" => 'required_if:type,Assure|required_if:type,Ayant_droit|NSSValide',
                  "nomf" => 'required_if:type,Ayant_droit',
                  "prenomf"=> 'required_if:type,Ayant_droit',
                  //"datenaissancef"=> 'required_if:type,Ayant_droit|date|date_format:Y-m-d',
                  "lieunaissancef"=> 'required_if:type,Ayant_droit',
                  "NMGSN"=> 'required_if:type,Ayant_droit',
<<<<<<< HEAD
                   //  
             );
             $messages = [
=======
/**********************************************/
                  "prenomA"=>'required_with:nom_homme_c',
                  "datenaissance_h_c"=>'required_with:nom_homme_c',
                  "adresseA"=>'required_with:nom_homme_c',
                  "type_piece_id"=>'required_with:nom_homme_c', 
                  "npiece_id"=>'required_with:nom_homme_c', 
                  "lien"=>'required_with:nom_homme_c',
                  "date_piece_id"=>'required_with:nom_homme_c',
                  "mobileA"=>['required_with:nom_homme_c', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
                  "operateur_h"=>'required_with:mobileA',
                 
                  
                //  
           );
           $messages = [
>>>>>>> e3e729a4a9b624b67f91ea710e0b3d6887a5fe66
                     "required"         => "Le champ :attribute est obligatoire.",
                    //  "NSSValide"    => 'le numéro du securite sociale est invalide ',
                      "date"             => "Le champ :attribute n'est pas une date valide.",
                       "required_with"         => "Veuillez compléter les informations de l'homme de confiance.",

            ];
<<<<<<< HEAD
            $validator = Validator::make($request->all(),$rule,$messages); 
             if ($validator->fails()) {
                    dd("non val");
                   $errors=$validator->errors(); 
                    return view('patient.addPatient')->withErrors($errors);
            } 

=======
           $validator = Validator::make($request->all(),$rule,$messages);         
           if ($validator->fails()) {
                    $errors=$validator->errors(); 
                     return view('patient.addPatient')->withErrors($errors);
           } 
           
>>>>>>> e3e729a4a9b624b67f91ea710e0b3d6887a5fe66
           if(patient::all()->isNotEmpty())
            {
                $nomb = patient::all()->last()->id;
            }
        else
            {
                $nomb = 0;
            }
            $codebarre =$request->sexe.$date->year."/".($nomb+1);      
            if($request->type =="Ayant droit")
            {
                $assurObj = assur::firstOrCreate([
                  "Nom"=>$request->nomf,
                  "Prenom"=>$request->prenomf,
                  "Date_Naissance"=>$request->datenaissancef,
                  "lieunaissance"=>$request->lieunaissancef,
                  "Sexe"=>$request->sexef,
                  "Matricule"=>$request->matf,
                  "service"=>$request->servicef,
                  "Grade"=>$request->gradef,
                  "Etat"=>$request->etatf,
                  "NSS"=>$request->nss2,
                  "NMGSN"=>$request->NMGSN, 
            ]);   
        }
        else
        {
            if( $request->type=="Assure")
                {
                    $assurObj = assur::firstOrCreate([
                        "Nom"=>$request->nom,
                        "Prenom"=>$request->prenom,
                        "Date_Naissance"=>$request->datenaissance,
                        "lieunaissance"=>$request->lieunaissance,
                        "Sexe"=>$request->sexe,
                        "Matricule"=>$request->mat,
                        "Service"=>$request->service,
                        "Grade"=>$request->grade,
                        "Etat"=>$request->etatf,
                        "NSS"=>$request->nss,
                        "NMGSN"=>$request->nmgsnAss, 
                    ]);  
                }
           }
           $assurID= $assurObj !=null ? $assurObj->id : null;
           $patient = patient::firstOrCreate([
                "code_barre"=>$codebarre,
                "Nom"=>$request->nom,
                "Prenom"=>$request->prenom,
                "Dat_Naissance"=>$request->datenaissance,
                "Lieu_Naissance"=>$request->lieunaissance,
                "Sexe"=>$request->sexe,
                "situation_familiale"=>$request->sf, 
                "nom_jeune_fille"=>$request->nom_jeune_fille,
                "Adresse"=>$request->adresse,
                "tele_mobile1"=>$request->operateur1 . $request->mobile1,
                "tele_mobile2"=>$request->operateur2 . $request->mobile2,
                "group_sang"=>$request->gs,
                "rhesus"=>$request->rh,
                "Assurs_ID_Assure"=>$assurID,
                "Type"=>$request->type,
                "Type_p"=> $request->Type_p,
                "description"=> $request->description,
                "NSS"=>$request->nsspatient,
                "Date_creation"=>$date,
            ]);
<<<<<<< HEAD
        
=======
           /*insert homme_c*/
        if( $request->nom_homme_c!="") 
             $homme = homme_conf::firstOrCreate([
                "id_patient"=>$patient->id,
                "nom"=>$request->nom_homme_c,
                "prénom"=>$request->prenomA, 
                "date_naiss"=>$request->datenaissance_h_c,
                "lien_par"=>$request->lien,
                "type_piece"=>$request->type_piece_id,
                "num_piece"=>$request->npiece_id,
                "date_deliv"=>$request->date_piece_id,
                "adresse"=>$request->adresseA,
                "mob"=>$request->operateur_h.$request->mobileA,
                 ]);

                  
                 

>>>>>>> e3e729a4a9b624b67f91ea710e0b3d6887a5fe66
        return redirect(Route('patient.show',$patient->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
<<<<<<< HEAD
          $patient = patient::FindOrFail($id);
           //dd($patient);
          $consultations = consultation::where('Patient_ID_Patient',$patient->id)->get();
          $hospitalisations = consultation::join('patients','consultations.Patient_ID_Patient','=','patients.id')
=======
        $patient = patient::FindOrFail($id);
        $homme_c = homme_conf::where("id_patient", $id)->where("etat_hc", "actuel")->get()->first();
        
        $consultations = consultation::where('Patient_ID_Patient',$patient->id)->get();
        $hospitalisations = consultation::join('patients','consultations.Patient_ID_Patient','=','patients.id')
>>>>>>> e3e729a4a9b624b67f91ea710e0b3d6887a5fe66
                                        ->where('patients.id','=',$patient->id)
                                        ->join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                                        ->join('hospitalisations','demandehospitalisations.id','=','hospitalisations.id_demande')
                                        ->select('hospitalisations.id','hospitalisations.Date_entree','hospitalisations.Date_entree','hospitalisations.Date_Prevu_Sortie','hospitalisations.Date_Sortie','hospitalisations.id_demande')
                                        ->get();
        //dd($hospitalisations);
        $rdvs = rdv::all();
        return view('patient.show_patient',compact('patient','consultations','rdvs','hospitalisations','homme_c'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $patient = patient::FindOrFail($id);
<<<<<<< HEAD
          /////////

          /////////////////////////
=======
          $homme_c = homme_conf::where("id_patient", $id)->where("etat_hc", "actuel")->get()->first();
          
>>>>>>> e3e729a4a9b624b67f91ea710e0b3d6887a5fe66
          if($patient->Type != "Autre")
                $assure =  assur::FindOrFail($patient->Assurs_ID_Assure); 
           else
                  $assure = new assur;
<<<<<<< HEAD
            // dd($assure);   
           return view('patient.edit_patient',compact('patient','assure'));
=======
            if (is_null($homme_c))
                $homme_c=new homme_conf;
           return view('patient.edit_patient',compact('patient','assure','homme_c'));
>>>>>>> e3e729a4a9b624b67f91ea710e0b3d6887a5fe66
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
<<<<<<< HEAD
     */ 
      public function update(Request $request,$id)
{
              $date = Date::Now();
              static $assurObj;
              $patient = patient::FindOrFail($id);
               switch ($patient->Type) {
                          case 'Assure':
                                        switch ($request->type) {
                                                    case 'Assure':
                                                               $assure = assur::FindOrFail($patient->Assurs_ID_Assure);
                                                                 $assure->update([
                                                                            "Nom"=>$request->nom,
                                                                            "Prenom"=>$request->prenom,
                                                                            "Date_Naissance"=>$request->datenaissance,
                                                                            "lieunaissance"=>$request->lieunaissance,
                                                                            "Sexe"=>$request->sexe,
                                                                            "Matricule"=>$request->matf, 
                                                                            "Etat"=>$request->etat,
                                                                            "Grade"=>$request->grade,
                                                                           "NMGSN"=>$request->NMGSN,
                                                                            "NSS"=>$request->nss,
                                                                 ]);
                                                                 $patient -> update([
                                                                            "Nom"=>$request->nom,
                                                                            "Prenom"=>$request->prenom,
                                                                            "Dat_Naissance"=>$request->datenaissance,
                                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                                            "Sexe"=>$request->sexe,
                                                                            "Adresse"=>$request->adresse,
                                                                            "situation_familiale"=>$request->sf,
                                                                            "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                            "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                            "group_sang"=>$request->gs,
                                                                            "rhesus"=>$request->rh, 
                                                                             "Type"=>$request->type,
                                                                             "Type_p"=>null,
                                                                             "description"=>"",
                                                                               "NSS"=> $request->NSS,    
                                                                              "Date_creation"=>$date,  
                                                                 ]);
                                                                  break;
                                                     case 'Ayant_droit':
                                                                  $assure = new assur;
                                                                  $assurObj =  $assure->firstOrCreate([
                                                                              "Nom"=>$request->nomf,
                                                                               "Prenom"=>$request->prenomf,
                                                                              "Date_Naissance"=>$request->datenaissancef,
                                                                               "lieunaissance"=>$request->lieunaissancef,
                                                                              "Sexe"=>$request->sexef,
                                                                              "Matricule"=>$request->matf, 
                                                                              "Etat"=>$request->etat,
                                                                              "Grade"=>$request->grade,
                                                                              "NMGSN"=>$request->NMGSN,
                                                                              "NSS"=>$request->nss,
                                                                  ]);
                                                                 $patient -> update([
                                                                            "Nom"=>$request->nom,
                                                                            "Prenom"=>$request->prenom,
                                                                            "Dat_Naissance"=>$request->datenaissance,
                                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                                            "Sexe"=>$request->sexe,
                                                                            "Adresse"=>$request->adresse,
                                                                            "situation_familiale"=>$request->sf,
                                                                            "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                            "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                            "group_sang"=>$request->gs,
                                                                            "rhesus"=>$request->rh, 
                                                                            "Assurs_ID_Assure"=>$assurObj->id,
                                                                             "Type"=>$request->type,
                                                                             "Type_p"=>$request->Type_p,
                                                                             // "description"=> $request->description, 
                                                                             "description"=>"",
                                                                               "NSS"=> $request->nsspatient,    
                                                                              "Date_creation"=>$date,  
                                                                 ]);
                                                                  break;
                                                     case 'Autre':
                                                                $patient -> update([
                                                                            "Nom"=>$request->nom,
                                                                            "Prenom"=>$request->prenom,
                                                                            "Dat_Naissance"=>$request->datenaissance,
                                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                                            "Sexe"=>$request->sexe,
                                                                            "Adresse"=>$request->adresse,
                                                                            "situation_familiale"=>$request->sf,
                                                                            "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                            "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                            "group_sang"=>$request->gs,
                                                                            "rhesus"=>$request->rh, 
                                                                            "Assurs_ID_Assure"=>null,
                                                                             "Type"=>$request->type,
                                                                             "Type_p"=>null,
                                                                             "description"=> $request->description, 
                                                                            "Date_creation"=>$date,  
                                                                 ]);
                                                                break;             
                                                    default:
                                                                # code...
                                                                break;
                                        }             
                                      // dd($p);
                                       break;
                           case 'Ayant_droit':
                                        switch ($request->type) {
                                                    case 'Assure':
                                                                   $assure = new assur;
                                                                  $assurObj =  $assure->firstOrCreate([
                                                                              "Nom"=>$request->nom,
                                                                               "Prenom"=>$request->prenom,
                                                                              "Date_Naissance"=>$request->datenaissance,
                                                                               "lieunaissance"=>$request->lieunaissance,
                                                                              "Sexe"=>$request->sexe,
                                                                              "Matricule"=>$request->matf, 
                                                                              "Etat"=>$request->etat,
                                                                              "Grade"=>$request->grade,
                                                                              "NMGSN"=>$request->NMGSN,
                                                                              "NSS"=>$request->nss,
                                                                  ]);
                                                                 $patient -> update([
                                                                            "Nom"=>$request->nom,
                                                                            "Prenom"=>$request->prenom,
                                                                            "Dat_Naissance"=>$request->datenaissance,
                                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                                            "Sexe"=>$request->sexe,
                                                                            "Adresse"=>$request->adresse,
                                                                            "situation_familiale"=>$request->sf,
                                                                            "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                            "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                            "group_sang"=>$request->gs,
                                                                            "rhesus"=>$request->rh, 
                                                                            "Assurs_ID_Assure"=>$assurObj->id,
                                                                             "Type"=>$request->type,
                                                                             "Type_p"=>null,
                                                                             "description"=>"",
                                                                               "NSS"=> null,    
                                                                              "Date_creation"=>$date,  
                                                                 ]);
                                                                break;
                                                    case 'Ayant_droit':
                                                                # code...           
                                                                 $assure = assur::FindOrFail($patient->Assurs_ID_Assure);
                                                                 $assure->update([
                                                                            "Nom"=>$request->nomf,
                                                                            "Prenom"=>$request->prenomf,
                                                                            "Date_Naissance"=>$request->datenaissancef,
                                                                            "lieunaissance"=>$request->lieunaissancef,
                                                                            "Sexe"=>$request->sexef,
                                                                            "Matricule"=>$request->matf, 
                                                                            "Etat"=>$request->etat,
                                                                            "Grade"=>$request->grade,
                                                                           "NMGSN"=>$request->NMGSN,
                                                                            "NSS"=>$request->nss,
                                                                 ]);
                                                                 $patient -> update([
                                                                            "Nom"=>$request->nom,
                                                                            "Prenom"=>$request->prenom,
                                                                            "Dat_Naissance"=>$request->datenaissance,
                                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                                            "Sexe"=>$request->sexe,
                                                                            "Adresse"=>$request->adresse,
                                                                            "situation_familiale"=>$request->sf,
                                                                            "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                            "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                            "group_sang"=>$request->gs,
                                                                            "rhesus"=>$request->rh, 
                                                                             "Type"=>$request->type,
                                                                             "Type_p"=>$request->Type_p,
                                                                             "description"=>"",
                                                                               "NSS"=> $request->nsspatient,    
                                                                              "Date_creation"=>$date,  
                                                                 ]);
                                                                break;
                                                    case 'Autre':
                                                                $patient -> update([
                                                                             "Nom"=>$request->nom,
                                                                             "Prenom"=>$request->prenom,
                                                                              "Dat_Naissance"=>$request->datenaissance,
                                                                              "Lieu_Naissance"=>$request->lieunaissance,
                                                                              "Sexe"=>$request->sexe,
                                                                              "Adresse"=>$request->adresse,
                                                                              "situation_familiale"=>$request->sf,
                                                                              "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                              "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                              "group_sang"=>$request->gs,
                                                                              "rhesus"=>$request->rh, 
                                                                               "Assurs_ID_Assure"=>null,
                                                                               "Type"=>$request->type,
                                                                              "Type_p"=>null,
                                                                              "description"=> $request->description, 
                                                                                            "Date_creation"=>$date,  
                                                                               ]);
                                                                        break;             
                                                    default:
                                                                # code...
                                                                break;
                                        }
                                        break;
                            case 'Autre':
                                        switch ($request->type) {
                                                    case 'Assure':
                                                                   $assure = new assur;
                                                                  $assurObj =  $assure->firstOrCreate([
                                                                              "Nom"=>$request->nom,
                                                                               "Prenom"=>$request->prenom,
                                                                              "Date_Naissance"=>$request->datenaissance,
                                                                               "lieunaissance"=>$request->lieunaissance,
                                                                              "Sexe"=>$request->sexe,
                                                                              "Matricule"=>$request->matf, 
                                                                              "Etat"=>$request->etat,
                                                                              "Grade"=>$request->grade,
                                                                              "NMGSN"=>$request->NMGSN,
                                                                              "NSS"=>$request->nss,
                                                                  ]);
                                                                 $patient -> update([
                                                                            "Nom"=>$request->nom,
                                                                            "Prenom"=>$request->prenom,
                                                                            "Dat_Naissance"=>$request->datenaissance,
                                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                                            "Sexe"=>$request->sexe,
                                                                            "Adresse"=>$request->adresse,
                                                                            "situation_familiale"=>$request->sf,
                                                                            "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                            "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                            "group_sang"=>$request->gs,
                                                                            "rhesus"=>$request->rh, 
                                                                            "Assurs_ID_Assure"=>$assurObj->id,
                                                                             "Type"=>$request->type,
                                                                             "Type_p"=>null,
                                                                              "description"=>"", 
                                                                              "Date_creation"=>$date,  
                                                                 ]);
                                                                break;
                                                     case'Ayant_droit':
                                                                  $assure = new assur;
                                                                  $assurObj =  $assure->firstOrCreate([
                                                                              "Nom"=>$request->nomf,
                                                                               "Prenom"=>$request->prenomf,
                                                                              "Date_Naissance"=>$request->datenaissancef,
                                                                               "lieunaissance"=>$request->lieunaissancef,
                                                                              "Sexe"=>$request->sexef,
                                                                              "Matricule"=>$request->matf, 
                                                                              "Etat"=>$request->etat,
                                                                              "Grade"=>$request->grade,
                                                                              "NMGSN"=>$request->NMGSN,
                                                                              "NSS"=>$request->nss,
                                                                  ]);
                                                                  //dd($assurObj->id);
                                                                 $p = $patient -> update([
                                                                            "Nom"=>$request->nom,
                                                                            "Prenom"=>$request->prenom,
                                                                            "Dat_Naissance"=>$request->datenaissance,
                                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                                            "Sexe"=>$request->sexe,
                                                                            "Adresse"=>$request->adresse,
                                                                            "situation_familiale"=>$request->sf,
                                                                            "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                            "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                            "group_sang"=>$request->gs,
                                                                            "rhesus"=>$request->rh, 
                                                                            "Assurs_ID_Assure"=>$assurObj->id,
                                                                             "Type"=>$request->type,
                                                                             "Type_p"=>$request->Type_p,
                                                                             "description"=>"",
                                                                               "NSS"=> $request->nsspatient,    
                                                                              "Date_creation"=>$date,  
                                                                 ]);      
                                                    case 'Autre':
                                                                 $patient -> update([
                                                                             "Nom"=>$request->nom,
                                                                             "Prenom"=>$request->prenom,
                                                                              "Dat_Naissance"=>$request->datenaissance,
                                                                              "Lieu_Naissance"=>$request->lieunaissance,
                                                                              "Sexe"=>$request->sexe,
                                                                              "Adresse"=>$request->adresse,
                                                                              "situation_familiale"=>$request->sf,
                                                                              "tele_mobile1"=>$request->operateur1.$request->mobile1,
                                                                              "tele_mobile2"=>$request->operateur2.$request->mobile2,
                                                                              "group_sang"=>$request->gs,
                                                                              "rhesus"=>$request->rh, 
                                                                               "Assurs_ID_Assure"=>null,
                                                                               "Type"=>$request->type,
                                                                              "Type_p"=>null,
                                                                              "description"=> $request->description, 
                                                                                            "Date_creation"=>$date,  
                                                                               ]);
                                                                break;
                                                    
                                                    default:
                                                                # code...
                                                                break;
                                        }
                           default:
                                      # code...
                                        break;
             }           
            return redirect(Route('patient.show',$patient->id));
}
=======
     */
    public function update(Request $request,$id)
    { 
        /**********************************************/
       /* $rule = array(
                  "prenom_h"=>'required_with:nom_h',
                  "datenaissance_h"=>'required_with:nom_h',
                  "adresse_h"=>'required_with:nom_h',
                  "type_piece"=>'required_with:nom_h', 
                  "num_piece"=>'required_with:nom_h', 
                  "lien_par"=>'required_with:nom_h',
                  "date_piece_id"=>'required_with:nom_h',
                  "mobile_h"=>['required_with:nom_h', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
                 
           );      
            $messages = [
                     
                       "required_with"         => "Veuillez compléter les informations de l'homme de confiance.",

            ];
           $validator = Validator::make($request->all(),$rule,$messages);         
           if ($validator->fails()) {
                    $errors=$validator->errors(); 
                     return back()->withErrors($errors);
           }  */
        /**********************************************/ 
           $date = Date::Now();
           static $assurObj;
           $patient = patient::FindOrFail($id);
           if($patient->Type != "Autre")
           {

                    $assure = assur::FindOrFail($patient->Assurs_ID_Assure);
                     if($request->type == "Assure")
                     {     
                                 //dd($request->type ." Assure ");    
                                $assure->update([
                                        "Nom"=>$request->nom,
                                        "Prenom"=>$request->prenom,
                                        "Date_Naissance"=>$request->datenaissance,
                                        "lieunaissance"=>$request->lieunaissance,
                                        "Sexe"=>$request->sexe,
                                        "Matricule"=>$request->mat, 
                                        "Etat"=>$request->etatass,
                                        "Service"=>$request->service,
                                        "Grade"=>$request->grade,
                                        "NMGSN"=>$request->nmgsnAss,
                                        "NSS"=>$request->nss1,
                                 ]);
                                $patient -> update([
                                    "Nom"=>$request->nom,
                                    "Prenom"=>$request->prenom,
                                    "Dat_Naissance"=>$request->datenaissance,
                                    "Lieu_Naissance"=>$request->lieunaissance,
                                    "Sexe"=>$request->sexe,
                                    "Adresse"=>$request->adresse,
                                    "situation_familiale"=>$request->sf,
                                    "tele_mobile1"=>$request->mobile1,
                                    "tele_mobile2"=>$request->mobile2,
                                    "group_sang"=>$request->gs,
                                    "Rihesus"=>$request->rh, 
                                     "Type"=>$request->type,
                                    "Date_creation"=>$date,
                                     "NSS"=> $request->NSS,    
                                ]);
                     }
                     else
                     {         
                                 if($request->type == "Ayant ")
                                {
                                            dd($request->type ." Ayant ");    
                                              $assure->update([
                                            "Nom"=>$request->nomf,
                                            "Prenom"=>$request->prenomf,
                                            "Date_Naissance"=>$request->datenaissancef,
                                            "lieunaissance"=>$request->lieunaissancef,
                                            "Sexe"=>$request->sexef,
                                            "Matricule"=>$request->matf,
                                            "Fonction"=>$request->fonctionf,
                                            "NMGSN"=>$request->NMGSN,
                                            "NSS"=>$request->nss2,
                                            "Etat"=>$request->etat,
                                            "Service"=>$request->servicef,
                                            "Grade"=>$request->gradef,
                                            ]);
                                            $patient -> update([
                                                    "Nom"=>$request->nom,
                                                    "Prenom"=>$request->prenom,
                                                    "Dat_Naissance"=>$request->datenaissance,
                                                    "Lieu_Naissance"=>$request->lieunaissance,
                                                    "Sexe"=>$request->sexe,
                                                    "Adresse"=>$request->adresse,
                                                    "situation_familiale"=>$request->sf,
                                                    "tele_mobile1"=>$request->mobile1,
                                                    "tele_mobile2"=>$request->mobile2,
                                                    "group_sang"=>$request->gs,
                                                    "Rihesus"=>$request->rh, 
                                                     "Type"=>$request->type,
                                                    "Date_creation"=>$date,
                                                     "NSS"=> $request->NSS,    
                                           ]);
                                }
                                else
                                {

                                          if($request->type == "Autre")
                                           { 
                                                     $patient -> update([
                                                            "Nom"=>$request->nom,
                                                            "Prenom"=>$request->prenom,
                                                            "Dat_Naissance"=>$request->datenaissance,
                                                            "Lieu_Naissance"=>$request->lieunaissance,
                                                            "Sexe"=>$request->sexe,
                                                            "Adresse"=>$request->adresse,
                                                            "situation_familiale"=>$request->sf,
                                                            "tele_mobile1"=>$request->mobile1,
                                                            "tele_mobile2"=>$request->mobile2,
                                                            "group_sang"=>$request->gs,
                                                            "Rihesus"=>$request->rh, 
                                                             "Type"=>$request->type,
                                                            "Date_creation"=>$date,
                                                             "NSS"=> $request->NSS,
                                                             "description"=> $request->description, 
                                                   ]);
                                           }
                                           else
                                           {
                                          //  dd("sdf");
                                           }
                                }
                              
                     }
                      
           }
           else
           { 
                     if($patient->Type == "Autre")  
                     {
                             $patient -> update([
                                "Nom"=>$request->nom,
                                "Prenom"=>$request->prenom,
                                "Dat_Naissance"=>$request->datenaissance,
                                "Lieu_Naissance"=>$request->lieunaissance,
                                "Sexe"=>$request->sexe,
                                "Adresse"=>$request->adresse,
                                "situation_familiale"=>$request->sf,
                                "tele_mobile1"=>$request->mobile1,
                                "tele_mobile2"=>$request->mobile2,
                                "group_sang"=>$request->gs,
                                "Rihesus"=>$request->rh, 
                                 "Type"=>$request->type,
                                "Date_creation"=>$date,
                                "NSS"=> $request->NSS, 
                                "description"=> $request->description,
                     ]);
                     }
                     else
                     {
                         $assure = new assur;
                          if($request->type == "Assure"){     
                            
                                    $assurObj =  $assure->firstOrCreate([
                                            "Nom"=>$request->nom,
                                            "Prenom"=>$request->prenom,
                                            "Date_Naissance"=>$request->datenaissance,
                                            "lieunaissance"=>$request->lieunaissance,
                                            "Sexe"=>$request->sexe,
                                            "Matricule"=>$request->mat, 
                                            "Etat"=>$request->etatass,
                                            "Service"=>$request->service,
                                            "Grade"=>$request->grade,
                                            "NMGSN"=>$request->nmgsnAss,
                                            "NSS"=>$request->nss1,
                                     ]);
                                      
                                 }
                                 else
                                 {         
                                    if($request->type == "Ayant ")
                                    $assurObj =  $assure->firstOrCreate([
                                            "Nom"=>$request->nomf,
                                            "Prenom"=>$request->prenomf,
                                            "Date_Naissance"=>$request->datenaissancef,
                                            "lieunaissance"=>$request->lieunaissancef,
                                            "Sexe"=>$request->sexef,
                                            "Matricule"=>$request->matf,
                                            "Fonction"=>$request->fonctionf,
                                            "NMGSN"=>$request->NMGSN,
                                            "NSS"=>$request->nss2,
                                            "Etat"=>$request->etat,
                                            "Service"=>$request->servicef,
                                            "Grade"=>$request->gradef,
                                     ]);
                                 }
                                    $patient -> update([
                                "Nom"=>$request->nom,
                                "Prenom"=>$request->prenom,
                                "Dat_Naissance"=>$request->datenaissance,
                                "Lieu_Naissance"=>$request->lieunaissance,
                                "Sexe"=>$request->sexe,
                                "Adresse"=>$request->adresse,
                                "situation_familiale"=>$request->sf,
                                "tele_mobile1"=>$request->mobile1,
                                "tele_mobile2"=>$request->mobile2,
                                "group_sang"=>$request->gs,
                                "Rihesus"=>$request->rh, 
                                 "Type"=>$request->type,
                                "Date_creation"=>$date,
                                "NSS"=> $request->NSS,//hfg
                                "Assurs_ID_Assure"=>$assurObj->id,         
                     ]);
                   
                     }
          }
         
           // dd( $patient);
          /******************************/

          $h=homme_conf::FindOrFail($request->id_h);
        
         if ((!is_null($h)) && ($request->etat_h=="actuel")) {
            $h-> update([
                "id_patient"=>$patient->id,
                "nom"=>$request->nom_h,
                "prénom"=>$request->prenom_h, 
                "date_naiss"=>$request->datenaissance_h,
                "lien_par"=>$request->lien_par,
                "type_piece"=>$request->type_piece,
                "num_piece"=>$request->num_piece,
                "date_deliv"=>$request->date_piece_id,
                "adresse"=>$request->adresse_h,
                "mob"=>$request->mobile_h,
                 ]);
             
         } 
         else
         {
            $homme = homme_conf::firstOrCreate([
                "id_patient"=>$patient->id,
                "nom"=>$request->nom_h,
                "prénom"=>$request->prenom_h, 
                "date_naiss"=>$request->datenaissance_h,
                "lien_par"=>$request->lien_par,
                "type_piece"=>$request->type_piece,
                "num_piece"=>$request->num_piece,
                "date_deliv"=>$request->date_piece_id,
                "adresse"=>$request->adresse_h,
                "mob"=>$request->mobile_h,
                
                 ]);
            $h-> update(["etat_hc"=>$request->etat_h,]);
         }
          /******************************/
           return redirect(Route('patient.show',$patient->id));
    }
>>>>>>> e3e729a4a9b624b67f91ea710e0b3d6887a5fe66

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        patient::destroy($id);
        return redirect() -> route('patient.index');
    }
    public function getpatient()
    {
        $patients = patient::select(['id','code_barre','Nom', 'Prenom', 'Dat_Naissance','Sexe','Date_creation']);
        return Datatables::of($patients)
            ->addColumn('action', function ($patient) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-success" href="/patient/'.$patient->id.'">
                                <i class="ace-icon fa fa-hand-o-up bigger-120"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="'.route('patient.edit',$patient->id).'">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </a>
                        </div>';
            })
            ->make(true);
    }
    public function getpatientconsult()
    {
        $patientes = patient::select(['id','code_barre','Nom', 'Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
        return Datatables::of($patientes)
            ->addColumn('action', function ($patient) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-success" href="/consultations/create/'.$patient->id.'">
                                <i class="ace-icon fa fa-hand-o-up bigger-120"> Ajouter Consultation</i>
                            </a>
                        </div>';})
            ->addColumn('action2', function ($patient) {
                return '<label>'.Date::parse($patient->Dat_Naissance)->age.'</label>';
            })
            ->rawColumns(['action2','action'])
            ->make(true);
    }
    public function getpatientrdv()
    {
        
        $patientes = patient::select(['id','code_barre','Nom','Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
        return Datatables::of($patientes)
            ->addColumn('action', function ($patient) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-xs btn-success" href="/rdv/create/'.$patient->id.'">
                                <i class="ace-icon fa fa-hand-o-up bigger-120"> Ajouter RDV</i>
                            </a>
                        </div>';})
            ->addColumn('action2', function ($patient) {
                return '<label>'.Date::parse($patient->Dat_Naissance)->age.'</label>';
            })
            ->rawColumns(['action2','action'])
            ->make(true);
    }
    public function getpatientatcd()
    {
        $patientes = patient::select(['id','code_barre','Nom','Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
        return Datatables::of($patientes)
            ->addColumn('action', function ($patient) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <a class="btn btn-lg btn-primary" href="/atcd/create/'.$patient->id.'">
                                <div class="fa fa-plus-circle"></div>&nbsp;
                                 Ajouter Antécédant</i>
                            </a>
                        </div>';})
            ->addColumn('action2', function ($patient) {
                return '<label>'.Date::parse($patient->Dat_Naissance)->age.'</label>';
            })
            ->rawColumns(['action2','action'])
            ->make(true);
    
    }
public function search(Request $request)
{
     if($request->ajax())  
     {
                $output="";
                // 
                $patients = patient::where('Nom','LIKE','%'.trim($request->search)."%")->where('Prenom','LIKE','%'.trim($request->prenom)."%")->where('code_barre','LIKE','%'.$request->code_barre."%")->get();
                // code_barre
                if($patients)
                {
                          $i=0;
                          foreach ($patients as $key => $patient) {
                               $i++;
                               $age = Carbon::createFromDate(date('Y', strtotime($patient->Dat_Naissance)), date('m', strtotime($patient->Dat_Naissance)), date('d', strtotime($patient->Dat_Naissance)))->age;
                                if($patient->Sexe =="M")
                                    $patient->Sexe="Homme";
                                else
                                       $patient->Sexe="Femme";
                               $output.='<tr>'.
                               '<td hidden>'.$patient->id.'</td>'.
                                '<td hidden>'.$patient->code_barre.'</td>'.
                                '<td class ="center chkTrt">'.'<input type="checkbox" class="ace check" name="fusioner[]" onClick="return KeepCount()" value="'.$patient->id.'"/>'.'<span class="lbl"></span>   '.'</td>'.
                                '<td><a href="#" id ="'.$patient->id.'" onclick ="getPatientdetail('.$patient->id.');">'.$patient->Nom.'</a></td>'.
                               '<td>'.$patient->Prenom.'</td>'.
                               '<td>'.$patient->code_barre.'</td>'.
                               '<td>'.$patient->Dat_Naissance.'</td>'.
                               '<td>'.$patient->Sexe.'</td>'.
                               '<td class="numberCircle20">'.$age.'</td>'.
                               '<td>'.$patient->situation_familiale.'</td>'.
                               '<td>'.$patient->Type.'</td>'.
                               '<td>'.'<a href="/patient/'.$patient->id.'" class="'.'btn btn-white btn-sm"><i class="ace-icon fa fa-hand-o-up"></i>&nbsp;</a>'."&nbsp;&nbsp;".'<a href="/patient/'.$patient->id.'/edit" class="'.'btn btn-white btn-sm"><i class="fa fa-edit fa-lg" aria-hidden="true" style="font-size:16px;"></i></a>'.'</td>'.
                               '</tr>';
                          }
                        return Response($output)->withHeaders(['count' => $i]);
                
               }     
        } 
}
    public function AutoCompletePatientname(Request $request)
    {
           return patient::where('Nom', 'LIKE', '%'.$request->q.'%')->get();    
    }
    public function AutoCompletePatientPrenom(Request $request)
     {
            return patient::where('Prenom', 'LIKE', '%'.trim($request->prenom).'%')->get();     
     }
     public function getPatientDetails(Request $request)
     {
          $patient = patient::FindOrFail($request->search);
           $view = view("patient.ajax_patientdetail",compact('patient'))->render();
            return response()->json(['html'=>$view]);
    }
      public function patientsToMerege(Request $request)
     {

           $statuses = array();
           $values;
           $patientResult = new patient;
           $patient1 = patient::FindOrFail($request->search[0]);
           $patient2 = patient::FindOrFail($request->search[1]);    
           $patients=[$patient1->getAttributes(),$patient2->getAttributes()];
          foreach ($patientResult->getFillable() as $field) {
              
                $values = ArrayClass::pluck($patients, $field);      
                // var_dump($values);echo("<br>");
                ArrayClass::removeValue("", $values);
                if (!count($values)) {
                        $statuses[$field] = "none";
                        continue;
                }
               $patientResult->$field = reset($values);
                // One unique value
                if (count($values) == 1) {
                     $statuses[$field] = "unique";
                     continue;
                }
                // Multiple values
                $statuses[$field] = count(array_unique($values)) == 1 ? "duplicate" : "multiple";
           }
          // dd($result);

         // Count statuses
          $counts = array(
            "none"      => 0,
            "unique"    => 0,
            "duplicate" => 0,
            "multiple"  => 0,
          );
          foreach ($statuses as $status) {
                $counts[$status]++;
          }
          //ArrayClass
          $view = view("patient.ajax_patient_merge",compact('patientResult','patient1','patient2','statuses','counts'))->render();
          return response()->json(['html'=>$view]);
             
     }
     public function merge(Request $request)
     {
          /*
          $patient1=patient::FindOrFail($request->patient1_id);
          $patient2=patient::FindOrFail($request->patient2_id);
           //chargement des consultation du patient2 
          $consuls = consultation::where('Patient_ID_Patient',$request->patient2_id)->get();
          $antecedants=antecedant::where('Patient_ID_Patient',$request->patient2_id)->get();
           foreach ($antecedants as $key => $antecedant) {
                     $antecedant->update(["Patient_ID_Patient"=>$patient1->id]);  
          }
          foreach ($consuls as $key => $consult) {
                $consult->update(["Patient_ID_Patient"=>$patient1->id]);  
          }
          // tickets
          $tickets = ticket::where('id_patient',$request->patient2_id)->get();
           foreach ($tickets as $key => $ticket) {
                $ticket->update(["id_patient"=>$patient1->id]);  
           }
           $rdvs = rdv::where('Patient_ID_Patient',$request->patient2_id)->get();
           foreach ($rdvs as $key => $rdv) {
                $rdv->update(["Patient_ID_Patient"=>$patient1->id]);  
           }
           //dd($request->all());
           $patient1 -> update([
                "Nom"=>$request->nom,
                "Prenom"=>$request->prenom,
                "code_barre"=>$request->code,
                "Dat_Naissance"=>$request->datenaissance,
                "Lieu_Naissance"=>$request->lieunaissance,
                "Sexe"=>$request->sexe,
                "Adresse"=>$request->adresse,
                "situation_familiale"=>$request->sf,
                "tele_mobile1"=>$request->mobile1,
                "tele_mobile2"=>$request->mobile2,
                "group_sang"=>$request->gs,
                "rhesus"=>$request->rh, 
                "Assurs_ID_Assure"=>$patient1->Assurs_ID_Assure,
                "Type"=>$request->type,
                "Type_p"=>$request->Type_p,
                "description"=>$request->description,
                "NSS"=> $request->nss,    
                "Date_creation"=>$request->date,  
           ]);
         
           //desactiver patient 2

           $patient2->active=0;$patient2->save();  */

           return redirect()->route('patient.index');
    }
}
