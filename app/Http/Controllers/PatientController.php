<?php
namespace App\Http\Controllers;
use DB;
use App\modeles\patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\modeles\assur;
use App\modeles\rdv;
use Yajra\DataTables\Facades\DataTables;
use App\modeles\consultation;
use App\modeles\examenbiologique;
use App\modeles\DemandeHospitalisation;
use App\modeles\hospitalisation;
use App\modeles\Specialite;
use App\modeles\grade;
use App\modeles\Commune;
use App\Utils\ArrayClass;
use App\modeles\homme_conf;
use App\modeles\antecedant;
use App\modeles\ticket;
use Validator;
use Redirect;
use MessageBag;
use Carbon\Carbon;
use Session;
use View;
use Response;
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
    return view('patient.index');
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  /*public function create() {$grades = grade::all(); return view('patient.add',compact('grades')); }
  */
  public function create( $asure_id =null)
  {
    if(isset($asure_id))
    {
      $assure = assur::FindOrFail($asure_id);
      return view('patient.addP',compact('assure'));
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
       $rule = array(
                        "nom" => 'required',
                        "prenom" => 'required',
                        "datenaissance" => 'required|date|date_format:Y-m-d',
                        "idlieunaissance" => 'required',
                        "mobile1"=> ['required', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
                        "Type_p" =>'required_if:type,Ayant_droit', //"nss" => 'required_if:type,Assure|required_if:type,Ayant_droit|NSSValide',
                        "nomf" => 'required_if:type,Ayant_droit',
                        "prenomf"=> 'required_if:type,Ayant_droit',  // "datenaissancef"=> 'required_if:type,Ayant_droit|date|date_format:Y-m-d',
                        "lieunaissancef"=> 'required_if:type,Ayant_droit',
                        "NMGSN"=> 'required_if:type,Ayant_droit',
                        "prenom_homme_c"=>'required_with:nom_homme_c',    //"datenaissance_h_c"=>'required_with:nom_homme_c',  // "adresseA"=>'required_with:nom_homme_c',
                        "type_piece_id"=>'required_with:nom_homme_c', 
                        "npiece_id"=>'required_with:nom_homme_c', //"lien"=>'required_with:nom_homme_c', //"date_piece_id"=>'required_with:nom_homme_c',    
                        "mobile_homme_c"=>['required_with:nom_homme_c'],
                        "operateur_h"=>'required_with:mobileA',
               );  // , 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/' 
        $messages = [
                "required"     => "Le champ :attribute est obligatoire.", // "NSSValide"    => 'le numéro du securite sociale est invalide ',
              "date"         => "Le champ :attribute n'est pas une date valide.",
        ];
        $validator = Validator::make($request->all(),$rule,$messages);   
        if ($validator->fails()) {
            $errors=$validator->errors(); 
            return view('patient.add')->withErrors($errors);
        }  // if(patient::all()->isNotEmpty()){ $nomb = patient::all()->last()->id;}else{$nomb = 0;}
        if( $request->type !="Autre")  
        {    
               $assurObj = assur::firstOrCreate([
                           "Nom"=>$request->nomf,
                            "Prenom"=>$request->prenomf,
                            "Date_Naissance"=>$request->datenaissancef,
                            "lieunaissance"=>$request->idlieunaissancef,
                            "Sexe"=>$request->sexef,
                            "adresse"=>$request->adressef,
                            "grp_sang"=>$request->gsf.$request->rhf,
                            "Matricule"=>$request->mat,
                            "Service"=>$request->service,
                            "Grade"=>$request->grade,
                            "Etat"=>$request->etatf,
                            "NSS"=>$request->nss,
                            "NMGSN"=>$request->NMGSN, 
               ]);            
       }  //  $assurID= $assurObj !=null ? $assurObj->id : null;//$codebarre =$request->sexe.$date->year."/".($nomb+1);
       $patient = patient::firstOrCreate([
              "Nom"=>$request->nom,// "code_barre"=>$codebarre,
              "Prenom"=>$request->prenom,
              "Dat_Naissance"=>$request->datenaissance,
              "Lieu_Naissance"=>$request->idlieunaissance,
              "Sexe"=>$request->sexe,
              "situation_familiale"=>$request->sf,
              "nom_jeune_fille"=>$request->nom_jeune_fille, 
              "Adresse"=>$request->adresse,
              'commune_res'=>isset($request->idcommune) ?$request->idcommune:'1556',
              'wilaya_res'=>isset($request->idwilaya) ?$$request->idwilaya:'49',
              "tele_mobile1"=>$request->operateur1 . $request->mobile1,
              "tele_mobile2"=>$request->operateur2 . $request->mobile2,
              "group_sang"=>$request->gs,
              "rhesus"=>$request->rh,
              "Assurs_ID_Assure"=> $assurObj !=null ? $assurObj->id : null ,
              "Type"=>$request->type,
              "Type_p"=> $request->Type_p,
              "description"=> $request->description,
              "NSS"=>$request->nsspatient,
              "Date_creation"=>$date,
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
    ///store ptient from assure
     public function storePatient(Request $request)
      {
            $rule = array(
                        "nom" => 'required',
                        "prenom" => 'required',
                        "datenaissance" => 'required|date|date_format:Y-m-d',
                        "idlieunaissance" => 'required',
                        "mobile1"=> ['required', 'regex:/[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}/'],
                        "Type_p" =>'required_if:type,Ayant_droit', //"nss" => 'required_if:type,Assure|required_if:type,Ayant_droit|NSSValide',
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
                      'commune_res'=>isset($request->idcommune) ?$request->idcommune:'1556',
                      'wilaya_res'=>isset($request->idwilaya) ?$$request->idwilaya:'49',
                      "tele_mobile1"=>$request->operateur1 . $request->mobile1,
                      "tele_mobile2"=>$request->operateur2 . $request->mobile2,
                      "group_sang"=>$request->gs,
                      "rhesus"=>$request->rh,
                      "Assurs_ID_Assure"=>$request-> assure_id ,
                      "Type"=>$request->type,
                      "Type_p"=> $request->Type_p,
                      "description"=> $request->description,
                      "NSS"=>$request->nsspatient,
                      "Date_creation"=>$date,
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
    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
            $patient = patient::FindOrFail($id);
            $homme_c = homme_conf::where("id_patient", $id)->where("etat_hc", "actuel")->get()->first();
            $consultations =$patient->Consultations; //consultation::where('Patient_ID_Patient',$id)->get(); 
            $hospitalisations = $patient->hospitalisations;//hospitalisation::whereHas('admission.demandeHospitalisation.consultation.patient', function($q) use($id){$q->where('id', $id);})->get();
            $specialites = Specialite::all();
            $grades = grade::all();
            $rdvs = rdv::where('Patient_ID_Patient' ,'=','$id')->get();
            return view('patient.show_patient',compact('patient','consultations','rdvs','hospitalisations','homme_c','specialites','grades'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$asure_id =null)
    {     
      if(!(isset($asure_id)))
      {    
              $assure ;
              $grades = grade::all(); 
              $patient = patient::FindOrFail($id);
              $hommes_c = homme_conf::where("id_patient", $id)->where("etat_hc", "actuel")->get();
              if($patient->Type != "Autre")
                    $assure =  $patient->assure;// else  //   $assure = new assur;
              return view('patient.edit_patient',compact('patient','assure','hommes_c','grades'));
      }else
      {
        $patient = patient::FindOrFail($id);
        $hommes_c = homme_conf::where("id_patient", $id)->where("etat_hc", "actuel")->get();
        return view('patient.editP',compact('patient','hommes_c'));
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
               $date = Date::Now();
               $patient = patient::FindOrFail($id);
              $assure;
              if(!isset($request->assure_id) )
              {
                switch ($patient->Type) {
                      case 'Assure':
                            switch ($request->type) {
                                    case  'Assure':
                                          //dd($request->all());
                                          $assure = assur::FindOrFail($patient->Assurs_ID_Assure);
                                          $assure->update([
                                                "Nom"=>$request->nomf,
                                                "Prenom"=>$request->prenomf,
                                                "Date_Naissance"=>$request->datenaissancef,
                                                "lieunaissance"=>$request->idlieunaissancef,
                                                "Sexe"=>$request->sexef,
                                                "adresse"=>$request->adressef,
                                                "grp_sang"=>$request->gsf,
                                                "Matricule"=>$request->matf, 
                                                "Service"=>$request->service,
                                                "Etat"=>$request->etatf,
                                                "Grade"=>$request->grade,
                                                "NMGSN"=>$request->NMGSN,
                                                "NSS"=>$request->nss,
                                            ]);
                                          break;
                                    case 'Ayant_droit':
                                          $assure = new assur; assur::destroy($patient->Assurs_ID_Assure);
                                          $assure =  $assure->firstOrCreate([
                                                "Nom"=>$request->nomf,
                                                "Prenom"=>$request->prenomf,
                                                "Date_Naissance"=>$request->datenaissancef,
                                                "lieunaissance"=>$request->idlieunaissancef,
                                                "Sexe"=>$request->sexef,
                                                "adresse"=>$request->adressef,
                                                "grp_sang"=>$request->gsf,
                                                "Matricule"=>$request->matf, 
                                                 "Service"=>$request->service,
                                                "Etat"=>$request->etatf,
                                                "Grade"=>$request->grade,
                                                "NMGSN"=>$request->NMGSN,
                                                "NSS"=>$request->nss,
                                          ]);
                                          break;
                                    case 'Autre':    
                                          break;             
                                    default:
                                          # code...
                                          break;
                            }
                            break;
                      case 'Ayant_droit':
                            switch ($request->type) {
                                    case 'Assure':
                                          $assure = new assur;
                                           $assure =  $assure->firstOrCreate([
                                                        "Nom"=>$request->nomf,
                                                        "Prenom"=>$request->prenomf,
                                                        "Date_Naissance"=>$request->datenaissancef,
                                                        "lieunaissance"=>$request->idlieunaissancef,
                                                        "Sexe"=>$request->sexef,
                                                        "adresse"=>$request->adressef,
                                                        "grp_sang"=>$request->gsf,
                                                        "Matricule"=>$request->matf,
                                                        "Service"=>$request->service, 
                                                        "Etat"=>$request->etatf,
                                                        "Grade"=>$request->grade,
                                                        "NMGSN"=>$request->NMGSN,
                                                        "NSS"=>$request->nss,
                                        ]);
                                        break;
                                    case 'Ayant_droit':
                                          $assure = assur::FindOrFail($patient->Assurs_ID_Assure);
                                          $assure->update([
                                                        "Nom"=>$request->nomf,
                                                        "Prenom"=>$request->prenomf,
                                                        "Date_Naissance"=>$request->datenaissancef,
                                                        "lieunaissance"=>$request->idlieunaissancef,
                                                        "Sexe"=>$request->sexef,
                                                        "adresse"=>$request->adressef,
                                                        "grp_sang"=>$request->gsf,
                                                        "Matricule"=>$request->matf,
                                                        "Service"=>$request->service, 
                                                        "Etat"=>$request->etatf,
                                                        "Grade"=>$request->grade,
                                                        "NMGSN"=>$request->NMGSN,
                                                        "NSS"=>$request->nss,
                                           ]);
                                           break;
                                    case 'Autre':
                                        break;             
                                    default:
                                        break;
                            }
                            break;
                     case 'Autre':
                            switch ($request->type) {
                                    case 'Assure':
                                          $assure = new assur;
                                           $assure =  $assure->firstOrCreate([
                                                          "Nom"=>$request->nomf,
                                                          "Prenom"=>$request->prenomf,
                                                          "Date_Naissance"=>$request->datenaissanceff,
                                                          "lieunaissance"=>$request->idlieunaissancef,
                                                          "Sexe"=>$request->sexef,
                                                         "adresse"=>$request->adressef,
                                                         "grp_sang"=>$request->gsf,
                                                          "Matricule"=>$request->matf, 
                                                          "Service"=>$request->service,
                                                          "Etat"=>$request->etatf,
                                                          "Grade"=>$request->grade,
                                                          "NMGSN"=>$request->NMGSN,
                                                          "NSS"=>$request->nss,
                                            ]);
                                           break;
                                    case 'Ayant_droit':
                                           $assure = new assur;
                                           $assure =  $assure->firstOrCreate([
                                                        "Nom"=>$request->nomf,
                                                        "Prenom"=>$request->prenomf,
                                                        "Date_Naissance"=>$request->datenaissanceff,
                                                        "lieunaissance"=>$request->idlieunaissancef,
                                                        "Sexe"=>$request->sexef,
                                                       "adresse"=>$request->adressef,
                                                       "grp_sang"=>$request->gsf,
                                                        "Matricule"=>$request->matf, 
                                                        "Service"=>$request->service,
                                                        "Etat"=>$request->etatf,
                                                        "Grade"=>$request->grade,
                                                        "NMGSN"=>$request->NMGSN,
                                                        "NSS"=>$request->nss,
                                          ]);
                                           break;
                                    case 'Autre': 
                                          break;    
                            }
                            break;
                }
              }else
              {
                 $assure = assur::FindOrFail($request->assure_id);
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
               "Assurs_ID_Assure"=>isset($assure->id)?$assure->id : null,
               "Type"=>$request->type,
               "Type_p"=>isset($request->Type_p) ? $request->Type_p : null,
               "description"=>isset($request->description)? $request->description: null,
               "NSS"=>($request->type != "Autre" )? (($request->type == "Assure" )? $request->nss : $request->nsspatient) : null,
               "Date_creation"=>$date,  
        ]);
        $patient->save();  //(!is_null($h))  
        return redirect(Route('patient.show',$patient->id));
    }
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
        $patients = patient::select(['id','IPP','Nom', 'Prenom', 'Dat_Naissance','Sexe','Date_creation']);
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
      $patients = patient::where('Nom','LIKE','%'.trim($request->search)."%")->where('Prenom','LIKE','%'.trim($request->prenom)."%")->where('IPP','LIKE','%'.trim($request->ipp)."%")->where('Dat_Naissance','LIKE','%'.trim($request->Dat_Naissance)."%")->where('active','=',1)->get();//->paginate(20);
      return Response::json($patients);
    }
  }
  // public function AutoCompletePatientname(Request $request)// {//return patient::where('Nom', 'LIKE', '%'.$request->q.'%')->get();//}
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
  public function AutoCompletePatientname(Request $request)
  {
    return patient::where('Nom', 'LIKE', '%'.trim($request->q).'%')->get();     
  }
  public function AutoCompletePatientPrenom(Request $request)
      {
              return patient::where('Prenom', 'LIKE', '%'.trim($request->prenom).'%')->get();     
  }
  public function AutoCompleteCommune(Request $request)
  {
    return  Commune::select('communes.*','wilayas.*')
                        ->join('daira','communes.Id_daira','=','daira.Id_daira')
                        ->join('wilayas','daira.id_wilaya','=','wilayas.id')
                        ->select('communes.*','communes.id as id_Commune' ,'wilayas.*','wilayas.id as Id_wilaya')
                        ->where('nom_commune', 'LIKE', '%'.trim($request->com).'%')->get();
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
           }
           // Count statuses
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
            "Type_p"=>$request->Type_p,
            "description"=>$request->description,
            "NSS"=> $request->nss,    
            "Date_creation"=>$request->date,  
       ]);   
       $patient2->active=0;$patient2->save();  //desactiver patient 2
       // return redirect()->route('patient.index')->with('success','Item created successfully!');
       Return View::make('patient.index');
  }
}