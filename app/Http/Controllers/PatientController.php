<?php
namespace App\Http\Controllers;
use DB;
use App\modeles\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\ArrayClass;
use App\modeles\assur;
use App\modeles\rdv;
use App\modeles\consultation;
use App\modeles\examenbiologique;
use App\modeles\DemandeHospitalisation;
use App\modeles\hospitalisation;
use App\modeles\Specialite;
use App\modeles\grade;
use App\modeles\homme_conf;
use App\modeles\antecedant;
use App\modeles\ticket;
use App\modeles\etablissement;
use Validator;
use Redirect;
use MessageBag;
use Carbon\Carbon;
use Session;
use View;
use Response;
use Flashy;
use \COM;
class PatientController extends Controller
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
    return view('patient.index');
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  /*public function create() {$grades = grade::all(); return view('patient.add',compact('grades')); }
  */
    public function create( $NSS = null, $type = null, $nomprenom =  null)
    {
      if(isset($NSS))
      {
        $assure = assur::FindOrFail($NSS);
        if(($type != 2) && ($type != 0) )
        {
          $identite = explode(' ',$nomprenom,2);//je supposer un vide entre nom et prenom
          $nom = $identite[0];
          $prenom = $identite[1];
        }else
        {
          $nom = $assure->Nom;
          if($type == 2)
           $prenom = $nomprenom;
          else
           $prenom = $assure->Prenom;         
        } //return view('patient.addP',compact('assure','NSS','type','prenom')); 
        return view('patient.addP',compact('assure','NSS','type','nom','prenom')); 

      }
      else
      {
        $grades = grade::all();
        return view('patient.add',compact('grades'));
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
    static $assurObj;
    $date = Date::Now();
    $rule = array(
              "nom" => 'required',
              "prenom" => 'required',//"datenaissance" => 'required|date|date_format:Y-m-d',"idlieunaissance" => 'required',"mobile1"=> ['required', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
              "Type_p" =>'required_if:type,Ayant_droit',//"nss" => 'required_if:type,Assure|required_if:type,Ayant_droit|NSSValide',
              "nomf" => 'required_if:type,Ayant_droit',
              "prenomf"=> 'required_if:type,Ayant_droit',// "datenaissancef"=> 'required_if:type,Ayant_droit|date|date_format:Y-m-d',//"nss2"=> 'required_if:type,Ayant_droit,unique,',
              "idlieunaissancef"=> 'required_if:type,Ayant_droit', //"NMGSN"=> 'required_if:type,Ayant_droit',
              "prenom_homme_c"=>'required_with:nom_homme_c', 
              "type_piece_id"=>'required_with:nom_homme_c', 
              "npiece_id"=>'required_with:nom_homme_c', //"lien"=>'required_with:nom_homme_c', //"date_piece_id"=>'required_with:nom_homme_c',    
              "mobile_homme_c"=>['required_with:nom_homme_c'],
              "operateur_h"=>'required_with:mobileA',// , 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/' 
    );  
    $messages = [
      "required"     => "Le champ :attribute est obligatoire.", // "NSSValide"    => 'le numéro du securite sociale est invalide ',
      "date"         => "Le champ :attribute n'est pas une date valide.",
    ];
    $validator = Validator::make($request->all(),$rule,$messages);   
    if ($validator->fails()) {
      $grades = grade::all();//$errors = $validator->errors(); 
      return view('patient.add',compact('grades'))->withErrors($validator->errors());
    }
    if( $request->type !="5")
    {  
      $assure = assur::where('NSS', $request->nss)->first(); 
      if ($assure === null) {
        $assurObj = assur::firstOrCreate([
          "Nom"=>$request->nomf,
          "Prenom"=>$request->prenomf,
          "Date_Naissance"=>$request->datenaissancef,
          "lieunaissance"=>$request->idlieunaissancef,
          "Sexe"=>$request->sexef,
          'SituationFamille'=>$request->SituationFamille,
          "adresse"=>$request->adressef,      
          "commune_res"=>$request->idcommunef,   // "wilaya_res"=>$request->idwilayaf,//'commune_res'=>isset($request->idcommunef) ?$request->idcommunef:'1556',
          'wilaya_res'=>isset($request->idwilayaf) ?$request->idwilayaf:'49',
          "grp_sang"=>$request->gsf.$request->rhf,
          "Matricule"=>$request->mat,
          "Service"=>$request->service,
          "Grade"=>$request->grade,
          "Position"=>$request->Position,
          "NSS"=>$request->nss,
          "NMGSN"=>$request->NMGSN, 
        ]);            
      }else
      {
        $assurObj = $assure->update([
          "Nom"=>$request->nomf,
          "Prenom"=>$request->prenomf,
          "Date_Naissance"=>$request->datenaissancef,
          "lieunaissance"=>$request->idlieunaissancef,
          "Sexe"=>$request->sexef,
          'SituationFamille'=>$request->SituationFamille,
          "adresse"=>$request->adressef,
          "commune_res"=>$request->idcommunef,
          "wilaya_res"=>$request->idwilayaf,//'commune_res'=>isset($request->idcommunef) ?$request->idcommunef:'1556','wilaya_res'=>isset($request->idwilayaf) ?$request->idwilayaf:'49',
          "grp_sang"=>$request->gsf.$request->rhf,
          "Matricule"=>$request->mat,
          "Service"=>$request->service,
          "Grade"=>$request->grade,
          "Position"=>$request->Position,
          "NSS"=>$request->nss,
          "NMGSN"=>$request->NMGSN, 
        ]);           
      } 
    }
    $patient = patient::firstOrCreate([
        "Nom"=>$request->nom,// "code_barre"=>$codebarre,
        "Prenom"=>$request->prenom,
        "Dat_Naissance"=>$request->datenaissance,
        "Lieu_Naissance"=>$request->idlieunaissance,
        "Sexe"=>$request->sexe,
        "situation_familiale"=>$request->sf,
        "nom_jeune_fille"=>$request->nom_jeune_fille, 
        "Adresse"=>$request->adresse,
        'commune_res'=>$request->idcommune,//'commune_res'=>isset($request->idcommune) ?$request->idcommune:'1556',
        'wilaya_res'=>$request->idwilaya,//'wilaya_res'=>isset($request->idwilaya) ?$request->idwilaya:'49',
        "tele_mobile1"=>$request->operateur1 . $request->mobile1,
        "tele_mobile2"=>$request->operateur2 . $request->mobile2,
        "group_sang"=>$request->gs,
        "rhesus"=>$request->rh,
        "Assurs_ID_Assure"=> $assurObj !=null ? $request->nss : null ,
        "Type"=>$request->type,
        "description"=> $request->description,
        "NSS"=>$request->nsspatient,
        "Date_creation"=>Date::Now(),
        "updated_at"=>Date::Now(),
    ]);
    $sexe = ($request->sexe == "H") ? 1:0;
    $ipp =$sexe.$date->year.$patient->id;
    $patient->update([
           "IPP" => $ipp,
    ]);
    if(isset($request->nom_homme_c) &&($request->nom_homme_c!="")) 
    {  
      $homme = homme_conf::firstOrCreate([
              "id_patient"=>$patient->id,
              "nom"=>$request->nom_homme_c,
               "prenom"=>$request->prenom_homme_c, 
               "date_naiss"=>$request->datenaissance_h_c,
               "lien_par"=>$request->lien,
               "type_piece"=>$request->type_piece_id,
               "num_piece"=>$request->npiece_id,
               "date_deliv"=>$request->date_piece_id,
               "adresse"=>$request->adresseA,
               "mob"=>$request->operateur_h.$request->mobile_homme_c,
              "created_by"=>Auth::user()->employee_id,
      ]);
    }
    return redirect(Route('patient.show',$patient->id));
  }
  public function storePatient(Request  $request) ///store ptient from assure
  {
    $date = Date::Now();
    $rule = array(
        "nom" => 'required',
        "prenom" => 'required',
        //"datenaissance" => 'required|date|date_format:Y-m-d',//"idlieunaissance"=>'required',//"mobile1"=> ['required', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],//"Type_p" =>'required_if:type,Ayant_droit', //"nss" => 'required_if:type,Assure|required_if:type,Ayant_droit|NSSValide',
        "prenom_homme_c"=>'required_with:nom_homme_c', 
        "type_piece_id"=>'required_with:nom_homme_c', 
        "npiece_id"=>'required_with:nom_homme_c', //"lien"=>'required_with:nom_homme_c', //"date_piece_id"=>'required_with:nom_homme_c',    
        "mobile_homme_c"=>['required_with:nom_homme_c'],
        "operateur_h"=>'required_with:mobileA',
    );
    $messages = [
        "required"     => "Le champ :attribute est obligatoire.", // "NSSValide"    => 'le numéro du securite sociale est invalide ',
        "date"         => "Le champ :attribute n'est pas une date valide.",
    ];
    $validator = Validator::make($request->all(),$rule,$messages);   
    if ($validator->fails()) {
      $errors=$validator->errors(); 
      return view('patient.add')->withErrors($errors);
    }
    $patient = patient::firstOrCreate([
        "Nom"=>$request->nom,// "code_barre"=>$codebarre,
        "Prenom"=>$request->prenom,
        "Dat_Naissance"=>$request->datenaissance,
        "Lieu_Naissance"=>$request->idlieunaissance,
        "Sexe"=>$request->sexe,
        "situation_familiale"=>$request->sf,
        "nom_jeune_fille"=>$request->nom_jeune_fille, 
        "Adresse"=>$request->adresse,
        'commune_res'=>$request->idcommune,//'commune_res'=>isset($request->idcommune) ?$request->idcommune:'1556',
        'wilaya_res'=>$request->idwilaya,//'wilaya_res'=>isset($request->idwilaya) ?$request->idwilaya:'49',
        "tele_mobile1"=>$request->operateur1 . $request->mobile1,
        "tele_mobile2"=>$request->operateur2 . $request->mobile2,
        "group_sang"=>$request->gs,
        "rhesus"=>$request->rh,
        "Assurs_ID_Assure"=>$request->assure_id ,
        "Type"=>$request->typePatient, "description"=> $request->description,
        "NSS"=>$request->nsspatient,
        "Date_creation"=>$date,
        "updated_at"=>$date,
    ]); 
    $sexe = ($request->sexe == "H") ? 1:0;
    $ipp =$sexe.Date::Now()->year.$patient->id;
    $patient->update([
       "IPP" => $ipp,
    ]);
    if(isset($request->nom_homme_c) &&($request->nom_homme_c!="")) 
    {  
      $homme = homme_conf::firstOrCreate([
                "id_patient"=>$patient->id,
                "nom"=>$request->nom_homme_c,
                 "prenom"=>$request->prenom_homme_c, 
                 "date_naiss"=>$request->datenaissance_h_c,
                 "lien_par"=>$request->lien,
                 "type_piece"=>$request->type_piece_id,
                 "num_piece"=>$request->npiece_id,
                 "date_deliv"=>$request->date_piece_id,
                 "adresse"=>$request->adresseA,
                 "mob"=>$request->operateur_h.$request->mobile_homme_c,
                "created_by"=>Auth::user()->employee_id,
      ]);
    }
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
          $specialites = Specialite::all();
          $grades = grade::all(); 
          $patient = patient::FindOrFail($id);
          $employe=Auth::user()->employ;
          $correspondants = homme_conf::where("id_patient", $id)->where("etat_hc", "actuel")->get();//->first();
          return view('patient.show',compact('patient','employe','correspondants','specialites','grades'));
        }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$asure_id =null)
    {  
      $patient = patient::FindOrFail($id);
      $correspondants = homme_conf::where("id_patient", $id)->where("etat_hc", "actuel")->get();
      if(!(isset($asure_id)))
      {
        $assure=null ;
        $grades = grade::all(); 
        if($patient->Type != "5")
          $assure =  $patient->assure;
        return view('patient.edit',compact('patient','assure','correspondants','grades'));
      }else//ce chemin est introuvable
      {
        return view('patient.editP',compact('patient','correspondants'));
      }
 
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request,$id)
      {
        $assure = new assur;
        $ayants = array("1", "2", "3","4");
        $ayantsAssure = array("0","1", "2", "3","4");
        $date = Date::Now();
        $patient = patient::FindOrFail($id);
        if($request->type != "5")
        {
          if(($request->type == $patient->Type) || ((in_array($request->type, $ayants) && (in_array($patient->Type, $ayants)))))
          { 
            $assure = assur::FindOrFail($patient->Assurs_ID_Assure);
            $assure->update([
                      "Nom"=>$request->nomf,
                      "Prenom"=>$request->prenomf,
                      "Date_Naissance"=>$request->datenaissancef,
                      "lieunaissance"=>$request->idlieunaissancef,
                      "Sexe"=>$request->sexef,
                      'SituationFamille'=>$request->SituationFamille,
                      "adresse"=>$request->adressef,
                      "commune_res"=>$request->idcommunef,
                      "wilaya_res"=>$request->idwilayaf,
                      "grp_sang"=>$request->gsf.$request->rhf,
                      "Matricule"=>$request->matf, 
                      "Service"=>$request->service,
                      "Position"=>$request->Position,
                      "Grade"=>$request->grade,
                      "NMGSN"=>$request->NMGSN,
                      "NSS"=>$request->nss,
            ]);
          }else
          {     
              if(((in_array($patient->Type, $ayants)) && ($request->type =="0")) || (in_array($request->type, $ayants) && ($patient->Type =="0")) ||(($patient->Type == "5") && (in_array($request->type, $ayantsAssure))))
             { 
            $assure = $assure->firstOrCreate([
                              "Nom"=>$request->nomf,
                              "Prenom"=>$request->prenomf,
                              "Date_Naissance"=>$request->datenaissancef,
                              "lieunaissance"=>$request->idlieunaissancef,
                              "Sexe"=>$request->sexef,
                              "adresse"=>$request->adressef,
                              "commune_res"=>$request->idcommunef,
                              "wilaya_res"=>$request->idwilayaf,
                              "grp_sang"=>$request->gsf.$request->rhf,
                              "Matricule"=>$request->matf, 
                              "Service"=>$request->service,
                              "Position"=>$request->Position,
                              "Grade"=>$request->grade,
                              "NMGSN"=>$request->NMGSN,
                              "NSS"=>$request->nss,
            ]);
          }
        }
        }
        $patient -> update([
                       "Nom"=>$request->nom,
                       "Prenom"=>$request->prenom,
                       "Dat_Naissance"=>$request->datenaissance,
                       "Lieu_Naissance"=>$request->idlieunaissance,
                       "Sexe"=>$request->sexe,
                       "Adresse"=>$request->adresse,
                       "commune_res"=>$request->idcommune,
                       'wilaya_res'=>$request->idwilaya,
                       "situation_familiale"=>$request->sf,
                       "nom_jeune_fille"=>$request->nom_jeune_fille, 
                       "tele_mobile1"=>$request->operateur1.$request->mobile1,
                       "tele_mobile2"=>$request->operateur2.$request->mobile2,
                       "group_sang"=>$request->gs,
                       "rhesus"=>$request->rh, 
                       "Assurs_ID_Assure"=>isset($assure->NSS)?$assure->NSS : null,
                       "Type"=>$request->type,
                       "description"=>isset($request->description)? $request->description: null,
                       "NSS"=>($request->type != "Autre" )? (($request->type == "Assure" )? $request->nss : $request->nsspatient) : null,
                       "Date_creation"=>$date,  
        ]);
         Flashy::message('Welcome Aboard!', 'http://your-awesome-link.com');
        return redirect(Route('patient.show',$patient->id));
    }
    public function updateP(Request $request,$id) 
    {
      $patient = patient::FindOrFail($id);
      $patient -> update([
               "Nom"=>$request->nom,
               "Prenom"=>$request->prenom,
               "Dat_Naissance"=>$request->datenaissance,
               "Lieu_Naissance"=>$request->idlieunaissance,
               "Sexe"=>$request->sexe,
               "Adresse"=>$request->adresse,
               "commune_res"=>$request->idcommune,
               'wilaya_res'=>$request->idwilaya,
               "situation_familiale"=>$request->sf,
               "nom_jeune_fille"=>$request->nom_jeune_fille, 
               "tele_mobile1"=>$request->operateur1.$request->mobile1,
               "tele_mobile2"=>$request->operateur2.$request->mobile2,
               "group_sang"=>$request->gs,
               "rhesus"=>$request->rh, 
               "Assurs_ID_Assure"=>$request->assure_id,
               "Type"=>$request->type,
               "description"=>isset($request->description)? $request->description: null,
               "NSS"=>($request->type != "Autre" )? (($request->type == "Assure" )? $request->nss : $request->nsspatient) : null,
               "Date_creation"=>Date::Now(),  
      ]);
      return redirect(Route('patient.show',$id)); 
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
      public function destroy(Request $request , $id)
      {
        if($request->ajax())  
        {
                $patient = patient::destroy($id);
                return Response::json($patient);   
        }else{
                patient::destroy($id);
                return redirect() -> route('patient.index');
        }
      } 
    public function getpatientconsult()
    {
        $patientes = patient::select(['id','IPP','Nom', 'Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
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
        $patients = patient::select(['id','IPP','Nom','Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
        return Datatables::of($patients)
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
        $patiente = patient::select(['id','IPP','Nom','Prenom', 'Dat_Naissance','Sexe','Adresse','Type','Date_creation']);
        return Datatables::of($patients)
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
  public function getPatientsArray(Request $request)
  {
    if($request->ajax())  
    {           
              $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")->select('patients.id','patients.Nom','patients.IPP','patients.Prenom')->get(); 
              return ['success' => true, 'data' => $patients]; 
    }
  }
  public function search(Request $request)
  {
    if($request->ajax())  
    {
      $patients = patient::where($request->field,'LIKE', trim($request->value)."%")->where('active','=',1)->get();// $patients = patient::where($request->field,'LIKE','%'.trim($request->value)."%")->where('active','=',1)->get();
      return Response::json($patients);
    }
  }
  public function getPatientDetails($id)
  { 
    $patient = patient::FindOrFail($id);
    if($patient->Type !="Autre")
    {
      $assure=  assur::FindOrFail($patient->Assurs_ID_Assure); 
      $view = view("patient.ajax_patient_detail",compact('patient','assure'))->render();
    }
    else
    {
      $view = view("patient.ajax_patient_detail",compact('patient'))->render();
    }
    return response()->json(['html'=>$view]);
  }

  public function AutoCompletePatientField(Request $request)
  {
    $field = trim($request->field);
    $patients = patient::where($field, 'LIKE', '%'.trim($request->q).'%')->limit(15)->get();
    $response = array();
    foreach($patients as $patient){
      $response[] = array("label"=>$patient->$field);
    }
    return response()->json($response);     
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
            $values = ArrayClass::pluck($patients, $field);   // var_dump($values);echo("<br>");     
            ArrayClass::removeValue("", $values);
            if (!count($values)) {
                  $statuses[$field] = "none";
                  continue;
           }
          $patientResult->$field = reset($values);  // One unique value
           if (count($values) == 1) {
               $statuses[$field] = "unique";
               continue;
          }// Multiple values
           $statuses[$field] = count(array_unique($values)) == 1 ? "duplicate" : "multiple";
       }// Count statuses
       $counts = array(
              "none"      => 0,
              "unique"    => 0,
              "duplicate" => 0,
              "multiple"  => 0,
       );
       foreach ($statuses as $status) {
             $counts[$status]++;
       }    //ArrayClass
         $view = view("patient.ajax_patient_merge",compact('patientResult','patient1','patient2','statuses','counts'))->render();
      return response()->json(['html'=>$view]);
  }
  public function merge(Request $request)
  {
      $patient1=patient::FindOrFail($request->patient1_id);
      $patient2=patient::FindOrFail($request->patient2_id); //chargement des consultation du patient2 
      $consuls = consultation::where('Patient_ID_Patient',$request->patient2_id)->get();
      $antecedants=antecedant::where('Patient_ID_Patient',$request->patient2_id)->get();
      foreach ($antecedants as $key => $antecedant) {
         $antecedant->update(["Patient_ID_Patient"=>$patient1->id]);  
      }
      foreach ($consuls as $key => $consult) {
            $consult->update(["Patient_ID_Patient"=>$patient1->id]);  
      }
      $tickets = ticket::where('id_patient',$request->patient2_id)->get(); // tickets
      foreach ($tickets as $key => $ticket) {
        $ticket->update(["id_patient"=>$patient1->id]);  
      }
      $rdvs = rdv::where('Patient_ID_Patient',$request->patient2_id)->get();
      foreach ($rdvs as $key => $rdv) {
        $rdv->update(["Patient_ID_Patient"=>$patient1->id]);  
      }
      $patient1 -> update([
            "Nom"=>$request->nom,
            "Prenom"=>$request->prenom,
            "IPP"=>$request->code,
            "Dat_Naissance"=>$request->datenaissance,
            "Lieu_Naissance"=>$request->idlieunaissance,
            "Sexe"=>$request->sexe,
            "Adresse"=>$request->adresse,
            "situation_familiale"=>$request->sf,
            "tele_mobile1"=>$request->mobile1,
            "tele_mobile2"=>$request->mobile2,
            "group_sang"=>$request->gs,
            "rhesus"=>$request->rh, 
            "Assurs_ID_Assure"=>$patient1->Assurs_ID_Assure,
            "Type"=>$request->type,
            "description"=>$request->description,
            "NSS"=> $request->nss,    
            "Date_creation"=>$request->date,  
      ]);   
      $patient2->active=0;$patient2->save();  //desactiver patient 2  // return redirect()->route('patient.index')->with('success','Item created successfully!');
      Return View::make('patient.index');
  }
}