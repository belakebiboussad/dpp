<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\modeles\patient;
use App\modeles\PatientType;
use App\Utils\ArrayClass;
use App\modeles\assur;
use App\modeles\rdv;
use App\modeles\consultation;
use App\modeles\examenbiologique;
use App\modeles\DemandeHospitalisation;
use App\modeles\hospitalisation;
use App\modeles\Specialite;
use App\modeles\homme_conf;
use App\modeles\antecedant;
use App\modeles\ticket;
use App\modeles\etablissement;
use App\modeles\demandeexb;
use App\modeles\demandeexr;
use App\modeles\ordonnance;
use Validator;
use Redirect;
use MessageBag;
use Carbon\Carbon;
use Session;
use View;
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
    public function index()//Request $request
    {
      if(request()->ajax())  
      {
        $today = Carbon::now(); $sub17 = ($today->subYears(17))->format('Y-m-d');
        $sub65 = ($today->subYears(65))->format('Y-m-d');$q = request()->value;
        $field= request()->field;
        switch(Auth::user()->employ->specialite)
        {       
          case 3 :
            $patients = patient::where($field,'LIKE', "$q%")->active()
                                ->where('Dat_Naissance', '>', $sub17)->get();
            break;
          case 5 :
            $patients = patient::where($field,'LIKE', "$q%")->active()
                                ->where('Sexe','F')->get();
            break;
          case 8 :
            $patients = patient::where($field,'LIKE', "$q%")->active()
                               ->where('Dat_Naissance', '<=', $sub65)->get();
                   break;
          default :
            $patients = patient::where($field,'LIKE', "$q%")->active()->get();
              break;    
          }
          return $patients; 
      } else
        return view('patient.index');
    }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function create( $NSS = null, $type = null, $nomprenom =  null)
    {
      $types =PatientType::all();
      return view('patient.create',compact('types'));
    }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  
   * @return \Illuminate\Http\Response
   */
  public function store()//Request $request
  {
    $DOB="";
    static $assurObj;
    $date = Carbon::now();
    if(isset(request()->presume))
    {
      switch(request()->presume)
      {
        case 1:
            $DOB= ($date->subYears(16))->format('Y-m-d');
            break;
        case 2:
            $DOB= ($date->subYears(64))->format('Y-m-d');
             break; 
        case 3:
          $DOB= ($date->subYears(65))->format('Y-m-d');
          break;
      }
    }else
      $DOB  = request()->datenaissance;   
    $rule = array(
      "nom" => 'required',
      "prenom" => 'required',//"datenaissance" =>'required|date|date_format:Y-m-d', 
      "nomf" => 'required_if:type,2,3,4,5',
      "prenomf" => 'required_if:type,2,3,4,5'
    );  
    $messages = [
      "required"     => "Le champ :attribute est obligatoire.", // "NSSValide"    => 'le numéro du securite sociale est invalide ',
      "date"         => "Le champ :attribute n'est pas une date valide.",
    ];
    $validator = Validator::make(request()->all(),$rule,$messages);   
    if ($validator->fails()) {
      return back()->withInput(request()->input())->withErrors($validator->errors());
    }
    if(request()->type !=6)
    {  
      $assure = assur::where('NSS', request()->nss)->first(); 
      if ($assure === null) {
        if(request()->type == 1)
        {
          $assurObj = assur::firstOrCreate([
            "Nom"=>request()->nom,
            "Prenom"=>request()->prenom,
            "Date_Naissance"=>request()->datenaissance,
            "lieunaissance"=>request()->idlieunaissance,
            "Sexe"=>request()->sexe,
            'sf'=>request()->sf,
            "adresse"=>request()->adresse,      
            "commune_res"=>request()->idcommune,
            'wilaya_res'=>isset(request()->idwilaya) ?request()->idwilaya:'49',
            "grp_sang"=>request()->gs.request()->rh,
            "NSS"=>request()->nss
          ]);
        }else
        {
          $assurObj = assur::firstOrCreate([
            "Nom"=>request()->nomf,
            "Prenom"=>request()->prenomf,
            "Date_Naissance"=>request()->datenaissancef,
            "lieunaissance"=>request()->idlieunaissancef,
            "Sexe"=>request()->sexef,
            'sf'=>request()->SituationFamille,
            "adresse"=>request()->adressef,      
            "commune_res"=>request()->idcommunef,
            'wilaya_res'=>isset(request()->idwilayaf) ?request()->idwilayaf:'49',
            "grp_sang"=>request()->gsf.request()->rhf,
            "NSS"=>request()->nss
          ]);
        }          
      }else
      {
        $assurObj = $assure->update([
          "Nom"=>request()->nomf,
          "Prenom"=>request()->prenomf,
          "Date_Naissance"=>request()->datenaissancef,
          "lieunaissance"=>request()->idlieunaissancef,
          "Sexe"=>request()->sexef,
          'sf'=>request()->SituationFamille,
          "adresse"=>request()->adressef,
          "commune_res"=>request()->idcommunef,
          "wilaya_res"=>request()->idwilayaf,
          "grp_sang"=>request()->gsf.request()->rhf,
          "NSS"=>request()->nss
        ]);           
      }
    }  
    $patient = patient::firstOrCreate([
        "Nom"=>request()->nom,"Prenom"=>request()->prenom,
        "Dat_Naissance"=>$DOB,
        "Lieu_Naissance"=>request()->idlieunaissance,
        "Sexe"=>request()->sexe,"sf"=>request()->sf,
        "nom_jeune_fille"=>request()->nom_jeune_fille, 
        "Adresse"=>request()->adresse,
        'commune_res'=>request()->idcommune,
        'wilaya_res'=>request()->idwilaya,
        "tele_mobile1"=>request()->mobile1,"tele_mobile2"=>request()->mobile2,
        "group_sang"=>request()->gs,"rhesus"=>request()->rh,
        "Assurs_ID_Assure"=> (request()->nss !=null) ? request()->nss : null ,
        "type_id"=>request()->type,
        "description"=> request()->description,
        "NSS"=>request()->nsspatient,
        'nationalite'=>request()->nationalite
    ]);
    $sexe = (request()->sexe == "M") ? 1:0;
    $ipp =$sexe.$date->year.$patient->id;
    $patient->update([ "IPP" => $ipp ]);
    return redirect(Route('patient.show',$patient->id));
  } 
  /**
     * Display the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
       public function show(patient $patient)
       {  
          $id = $patient->id ;
          $specialites = Specialite::all();
          $employe=Auth::user()->employ;
          $rdvs = (Auth::user()->is(15)) ? $patient->rdvs : $patient->rdvsSpecialite( $employe->specialite)->get();
          $correspondants = homme_conf::where("id_patient", $id)->where("etat_hc", "actuel")->get();
          $demandesExB= demandeexb::whereHas('visite', function($query) use($id){
                                      $query->where('pid', $id);
                                   })->orWhereHas('consultation',function($q) use($id){
                                      $q->where('pid', $id);   
                                  })->get();
          $demandesExR= demandeexr::whereHas('visite', function($query) use($id){
                                      $query->where('pid', $id);
                                  })->orWhereHas('consultation',function($q) use($id){
                                      $q->where('pid', $id);   
                                  })->get();
           $ordonnances = ordonnance::with('consultation')->whereHas('consultation',function($q) use($id){
                                      $q->where('pid', $id);
                                    })->get();
      return view('patient.show',compact('patient','rdvs','employe','correspondants','specialites','demandesExB','demandesExR','ordonnances'));
        }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
      public function edit(patient $patient)//,$asure_id =null
      {  
        $assure=null;
        $types =PatientType::all();
        if($patient->type_id != 6)
          $assure =  $patient->assure;
        return view('patient.edit',compact('patient','assure','types')); 
      }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, patient $patient)
    { 
      $ayants = array("2", "3", "4","5");
      $ayantsAssure = array("1", "2", "3","4","5");
      $assure = new assur;
      if($request->type != 6)
      {
        if(($request->type == $patient->type_id) || ((in_array($request->type, $ayants) && (in_array($patient->type_id, $ayants)))))
        {
          $assure = assur::FindOrFail($patient->Assurs_ID_Assure);
          $assure->update([
              "Nom"=>$request->nomf,
              "Prenom"=>$request->prenomf,
              "Date_Naissance"=>$request->datenaissancef,
              "lieunaissance"=>$request->idlieunaissancef,
              "Sexe"=>$request->sexef,
              'sf'=>$request->SituationFamille,
              "adresse"=>$request->adressef,
              "commune_res"=>$request->idcommunef,
              "wilaya_res"=>$request->idwilayaf,
              "grp_sang"=>$request->gsf.$request->rhf,
              "NSS"=>$request->nss
            ]);
        }else
        {
          if($request->type == 1)
          {
            $assure = $assure->firstOrCreate([
              "Nom"=>$request->nom,
              "Prenom"=>$request->prenom,
              "Date_Naissance"=>$request->datenaissance,
              "lieunaissance"=>$request->idlieunaissance,
              "Sexe"=>$request->sexe,
              "adresse"=>$request->adresse,
              "commune_res"=>$request->idcommune,
              "wilaya_res"=>$request->idwilaya,
              "grp_sang"=>$request->gs.$request->rh,
              "NSS"=>$request->nss
            ]);
          }
          else
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
              "NSS"=>$request->nss
              ]);
          }
        }
      }
      $patient -> update([
        "Nom"=>$request->nom,"Prenom"=>$request->prenom,
        "Dat_Naissance"=>$request->datenaissance,
        "Lieu_Naissance"=>$request->idlieunaissance,
        "Sexe"=>$request->sexe,"Adresse"=>$request->adresse,
        "commune_res"=>$request->idcommune,'wilaya_res'=>$request->idwilaya,
         "sf"=>$request->sf,             
         "nom_jeune_fille"=>$request->nom_jeune_fille, 
         "tele_mobile1"=>$request->mobile1,
         "tele_mobile2"=>$request->mobile2,
         "group_sang"=>$request->gs,
         "rhesus"=>$request->rh, 
         "Assurs_ID_Assure"=>isset($assure->NSS)? $assure->NSS : null,
         "type_id"=>$request->type,
         "description"=>isset($request->description)? $request->description:null,
         "NSS"=>($patient->type_id !=6)? (($request->type == "Assure" )? $request->nss : $request->nsspatient) : null,
         'nationalite'=>request()->nationalite
        ]);
         return redirect(Route('patient.show',$patient->id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\patient  $patient
     * @return \Illuminate\Http\Response
     */
      public function destroy(Request $request , patient $patient)
      {
        $patient->delete();
        if($request->ajax())        
          return $patient;
        else       
          return redirect()->route('patient.index');
      } 
  public function getPatientsList(Request $request)
  {
    $output="";$today = Carbon::now();$sub17 = ($today->subYears(17))->format('Y-m-d');$sub65 = ($today->subYears(65))->format('Y-m-d');
    if($request->ajax())  
    {
        switch($request->specialite){
          case 3 ://ped
              $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")->where('Dat_Naissance', '!=', null)
                                 ->where('Dat_Naissance', '>', $sub17)->get();
              break;
          case 5 ://geneco
              $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")
                                  ->where('Dat_Naissance', '!=', null)->where('Sexe','F')->get();
              break;
          case 8  ://geriatrie
              $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")
                                  ->where('Dat_Naissance', '!=', null)->where('Dat_Naissance', '<=', $sub65)->get();
              break;
          default :
              $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")
                                  ->where('Dat_Naissance', '!=', null)->get();
               break;
             }
            foreach ($patients as $key => $pat) {         
              $output.='<li onclick="Fill('.$pat->id.',\''.$pat->full_name.'\')">'.$pat->full_name.'</li>';   
            }
        return $output;
    }
  }
  public function getPatientDetails($id)
  { 
    $patient = patient::FindOrFail($id);
    $view = view("patient.ajax_patient_detail",compact('patient'))->render();
    return $view;
  }
  public function AutoCompletePatientField(Request $request)
  {
    $today = Carbon::now();
    $response = [];
    $sub17 = ($today->subYears(17))->format('Y-m-d');$sub65 = ($today->subYears(65))->format('Y-m-d');
    $field = trim($request->field);
    switch(Auth::user()->employ->specialite)
    {       
      case 3 ://ped
        $patients = patient::where($field, 'LIKE', '%'.trim($request->q).'%')->active()->where('Dat_Naissance', '>',$sub17)->limit(15)->get();  
        break;
      case 5 ://geneco
        $patients = patient::where($field, 'LIKE', '%'.trim($request->q).'%')->active()->where('Sexe','F')->limit(15)->get();
        break;
      case 8 ://Geriatrie
        $patients = patient::where($field, 'LIKE', '%'.trim($request->q).'%')->active()->where('Dat_Naissance', '<=', $sub65)->limit(15)->get();
        break;
      default :
        $patients = patient::where($field, 'LIKE', '%'.trim($request->q).'%')->limit(15)->get();
        break;
    }
    foreach($patients as $patient){
      $response[] = array("label"=>$patient->$field);
    }
    return $response;
  } 
  public function patientsToMerege(Request $request)
  {
    $statuses = []; $values="";
    $patientResult = new patient;
    $patient1 = patient::FindOrFail($request->search[0]);
    $patient2 = patient::FindOrFail($request->search[1]);    
    $patients = [$patient1->getAttributes(),$patient2->getAttributes()];
    foreach ($patientResult->getFillable() as $field) {
      $values = ArrayClass::pluck($patients, $field);    
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
     $counts = array("none" => 0,"unique" => 0,"duplicate" => 0, "multiple"  => 0 );
     foreach ($statuses as $status) {
           $counts[$status]++;
     }  
      $view = view("patient.ajax_patient_merge",compact('patientResult','patient1','patient2','statuses','counts'))->render();
    return(['html'=>$view]);
  }
  public function merge(Request $request)
  {
    $patient1=patient::FindOrFail($request->patient1_id);
    $patient2=patient::FindOrFail($request->patient2_id);
    //chargement des consultation du patient2 
    $consuls = consultation::where('pid',$request->patient2_id)->get();
    $antecedants=antecedant::where('pid',$request->patient2_id)->get();
    foreach ($antecedants as $key => $antecedant) {
       $antecedant->update(["pid"=>$patient1->id]);  
    }
    foreach ($consuls as $key => $consult) {
          $consult->update(["pid"=>$patient1->id]);  
    }
    $tickets = ticket::where('id_patient',$request->patient2_id)->get(); // tickets
    foreach ($tickets as $key => $ticket) {
      $ticket->update(["id_patient"=>$patient1->id]);  
    }
    $rdvs = rdv::where('patient_id',$request->patient2_id)->get();
    foreach ($rdvs as $key => $rdv) {
      $rdv->update(["patient_id"=>$patient1->id]);  
    }
    $patient1 -> update([
          "Nom"=>$request->nom,
          "Prenom"=>$request->prenom,
          "IPP"=>$request->code,
          "Dat_Naissance"=>$request->datenaissance,
          "Lieu_Naissance"=>$request->idlieunaissance,
          "Sexe"=>$request->sexe,
          "Adresse"=>$request->adresse,
          "sf"=>$request->sf,
          "tele_mobile1"=>$request->mobile1,
          "tele_mobile2"=>$request->mobile2,
          "group_sang"=>$request->gs,
          "rhesus"=>$request->rh, 
          "Assurs_ID_Assure"=>$patient1->Assurs_ID_Assure,
          "type_id"=>$request->type,
          "description"=>$request->description,
          "NSS"=> $request->nss,
    ]);   
    $patient2->active=0;$patient2->save();  //desactiver patient 2  // return redirect()->route('patient.index')->with('success','Item created successfully!');
    return view('patient.index');
  }
}