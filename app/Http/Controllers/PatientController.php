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
use App\modeles\Profession;
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
                                      ->where('dob', '>', $sub17)->get();
                  break;
          case 5 :
            $patients = patient::where($field,'LIKE', "$q%")->active()
                                ->where('Sexe','F')->get();
            break;
          case 8 :
            $patients = patient::where($field,'LIKE', "$q%")->active()
                               ->where('dob', '<=', $sub65)->get();
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
      $profs =Profession::all();
      return view('patient.create',compact('types','profs'));
    }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  
   * @return \Illuminate\Http\Response
   */
  public function store()//Request $request
  {
     $rule = array(
      "nom" => 'required',"prenom" => 'required',
      "type" => 'required',"nomf" => 'required_if:type,2,3,4,5',
      "prenomf" => 'required_if:type,2,3,4,5',
      "nss"=>'required_if:type,1,2,3,4,5'
    );  
    $messages = [
      "required"     => "Le champ :attribute est obligatoire.", 
      "date"         => "Le champ :attribute n'est pas une date valide.",
    ];
    $validator = Validator::make(request()->all(),$rule,$messages);   
    if ($validator->fails()) 
      return back()->withInput(request()->input())->withErrors($validator->errors());
    $DOB="";
    static $assurObj;$date = Carbon::now();
    if(isset(request()->presume))
    {
      switch(request()->presume)
      {
        case 1:
          $dob= ($date->subYears(16))->format('Y-m-d');
          break;
        case 2:
          $dob= ($date->subYears(64))->format('Y-m-d');
          break; 
        case 3:
          $dob= ($date->subYears(65))->format('Y-m-d');
          break;
      }
    }else
     $dob  = request()->datenaissance;   
    if(request()->type !=6)
    {  
      $assure = assur::where('NSS', request()->nss)->first(); 
      if(is_null($assure))
      {
        if(request()->type == 1)
        {
          $assurObj = assur::firstOrCreate([
            "Nom"=>request()->nom, "Prenom"=>request()->prenom,
            "dob"=>request()->datenaissance,
            "pob"=>request()->idlieunaissance,
            "Sexe"=>request()->sexe, 'sf'=>request()->sf,
            "adresse"=>request()->adresse, "commune_res"=>request()->idcommune,
            "wilaya_res"=>isset(request()->idwilaya) ?request()->idwilaya:'49',
            "gs"=>request()->gs.request()->rh, "NSS"=>request()->nss
          ]);
        }else
          (new AssurController)->store(request());
               
      }else
        (new AssurController)->update(request(),request()->nss);  
    }  
    $patient = patient::firstOrCreate([
        "Nom"=>request()->nom,"Prenom"=>request()->prenom,
        "dob"=>$dob, "pob"=>request()->pob,
        "Sexe"=>request()->sexe,"sf"=>request()->sf,
        "nom_jeune_fille"=>request()->nom_jeune_fille, 
        "Adresse"=>request()->adresse,'commune_res'=>request()->idcommune,
        'wilaya_res'=>request()->idwilaya,
        "mob"=>request()->mobile1,"mob2"=>request()->mobile2,
        "gs"=>request()->gs,"rh"=>request()->rh,'nationalite'=>request()->nationalite,
        'prof_id'=>request()->prof_id,
        "assur_id"=> (request()->nss !=null) ? request()->nss : null,
       "type_id"=>request()->type,  "description"=> request()->description,
       "NSS"=>request()->nsspatient,  
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
     $profs =Profession::all();
    if($patient->type_id != 6)
      $assure =  $patient->assure;
    dd($assure);
    return view('patient.edit',compact('patient','assure','types','profs')); 
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
    $rule = array(
      "nom" => 'required',
      "prenom" => 'required',
      "type" => 'required',
      "nomf" => 'required_if:type,2,3,4,5',
      "prenomf" => 'required_if:type,2,3,4,5',
      "nss"=>'required_if:type,1,2,3,4,5'
    );  
    $messages = [
      "required"     => "Le champ :attribute est obligatoire.", 
      "date"         => "Le champ :attribute n'est pas une date valide.",
    ];
    $validator = Validator::make(request()->all(),$rule,$messages);   
    if ($validator->fails()) 
      return back()->withInput(request()->input())->withErrors($validator->errors());
    $ayants = array("2", "3", "4","5");
    $assure = new assur;
    if($request->type != 6)
    {
      if(($request->type == $patient->type_id)||((in_array($request->type, $ayants)&&(in_array($patient->type_id, $ayants)))))
      {//voir s'il y'à lieu de créer l'assurer
        $assure = assur::Find($patient->assur_id);
        (new AssurController)->update($request,$patient->assur_id);
      }else
      {
        if($request->type == 1)
        {
         $assure = assur::Find($request->nss);
          if(!is_null($assure))
            return back()->withErrors(['le numéro &quot;NSS&quot; doit étre unique']);
          $assure = assur::create([
            "Nom"=>$request->nom,"Prenom"=>$request->prenom,
            "dob"=>$request->datenaissance,"pob"=>$request->idpob,
            "Sexe"=>$request->sexe,"adresse"=>$request->adresse,
            "commune_res"=>$request->idcommune,
            "wilaya_res"=>$request->idwilaya,
            "gs"=>$request->gs.$request->rh,"NSS"=>$request->nss
          ]);//suprimer l'assurer quan il na pas de patient
        }else
        {//test3
          $assure = assur::find($request->nss);
          if(!is_null($assure))
            (new AssurController)->update($request,$assure->NSS);  
          else
            (new AssurController)->store($request);
        }
      }
    }
    $patient->update([
      "Nom"=>$request->nom,"Prenom"=>$request->prenom,
      "dob"=>$request->dob,"pob"=>$request->idpob,
      "Sexe"=>$request->sexe,"Adresse"=>$request->adresse,
      "commune_res"=>$request->idcommune,'wilaya_res'=>$request->idwilaya,
      "sf"=>$request->sf,             
      "nom_jeune_fille"=>$request->nom_jeune_fille, 
      "mob"=>$request->mobile1, "mob2"=>$request->mobile2,
      "gs"=>$request->gs,"rh"=>$request->rh,
      "assur_id"=>isset($assure->NSS)? $assure->NSS : null,
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
            $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")->where('dob', '!=', null)
                        ->where('dob', '>', $sub17)->get();
            break;
          case 5 ://geneco
            $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")
                                ->where('dob', '!=', null)->where('Sexe','F')->get();
            break;
          case 8  ://geriatrie
            $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")
                                ->where('dob', '!=', null)->where('dob', '<=', $sub65)->get();
            break;
          default :
            $patients = patient::where(trim($request->field),'LIKE','%'.trim($request->value)."%")
                                ->where('dob', '!=', null)->get();
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
        $patients = patient::where($field, 'LIKE', '%'.trim($request->q).'%')->active()->where('dob', '>',$sub17)->limit(15)->get();  
        break;
      case 5 ://geneco
        $patients = patient::where($field, 'LIKE', '%'.trim($request->q).'%')->active()->where('Sexe','F')->limit(15)->get();
        break;
      case 8 ://Geriatrie
        $patients = patient::where($field, 'LIKE', '%'.trim($request->q).'%')->active()->where('dob', '<=', $sub65)->limit(15)->get();
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
  public function patientsToMeregeNew(Request $request)
  {
    $statuses = []; $values="";
    $patientResult = new patient;
    $patients = patient::find($request->search);
    //   $values =$patients->toArray('id','Nom');
    return $values;
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
      if(!count($values)) {
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
    $counts = array("none" => 0,"unique"=> 0,"duplicate" => 0, "multiple"=> 0 );
    foreach ($statuses as $status) {
      $counts[$status]++;
    }
    //return  $patientResult;
    $view = view("patient.ajax_patient_merge",compact('patientResult','patient1','patient2','statuses','counts'))->render();
    return(['html'=>$view]);
  }
  public function merge(Request $request)
  {
    $p1=patient::FindOrFail($request->pid1);
    $p2=patient::FindOrFail($request->pid2);
    foreach ($p2->antecedants as $key => $antecedant) {
       $antecedant->update(["pid"=>$request->pid1]);  
    }
    foreach ($p2->Consultations as $key => $consult) {
          $consult->update(["pid"=>$request->pid1]);  
    }
    foreach ($p2->rdvs as $rdv) {
      $rdv->update(["patient_id"=>$request->pid1]);  
    }
    $patient1 -> update([
      "Nom"=>$request->nom,"Prenom"=>$request->prenom,
      "IPP"=>$request->code,"dob"=>$request->datenaissance,
      "pob"=>$request->idlieunaissance,"Sexe"=>$request->sexe,
      "Adresse"=>$request->adresse,"sf"=>$request->sf,
      "mob"=>$request->mobile1,"mob2"=>$request->mobile2,
      "gs"=>$request->gs,"rh"=>$request->rh,"assur_id"=>$patient1->assur_id,
      "type_id"=>$request->type,"description"=>$request->description,"NSS"=> $request->nss, 
    ]);   
    $patient2->active=0;$patient2->save();  //desactiver patient 2  // return redirect()->route('patient.index')->with('success','Item created successfully!');
    return view('patient.index');
  }
}