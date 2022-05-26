<?php

namespace App\Http\Controllers;//use DB;
use App\modeles\patient;
use App\modeles\consultation;
use App\modeles\Constantes;
use App\modeles\constante;
use App\modeles\antecedant;
use App\modeles\codesim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\modeles\Etablissement;
use App\modeles\DemandeHospitalisation;
use App\modeles\examenbiologique;
use App\modeles\examenimagrie;
use App\modeles\demandeexb_examenbio;
use App\modeles\Demandeexr_Examenradio;
use App\modeles\examenanapath;
use App\modeles\hospitalisation;
use App\modeles\service;
use App\modeles\examen_cliniqu;
use App\modeles\examAppareil;
use App\modeles\ordonnance;
use App\modeles\employ;
use App\modeles\demandeExamImag;
use App\modeles\demandeexb;
use App\User;
use App\modeles\Specialite;
use App\modeles\LettreOrientation;
use App\modeles\infosupppertinentes;
use App\modeles\TypeExam;
use App\modeles\examenradiologique;
use App\modeles\demandeexr;
use App\modeles\appareil;
use App\modeles\CIM\chapitre;
use App\modeles\facteurRisqueGeneral;
use App\modeles\Etatsortie;
use Carbon\Carbon;//use PDF;
use Validator;
use Response;
class ConsultationsController extends Controller
{
    protected $DemandeHospCTRL;
    public function __construct(LettreOrientationController $LettreOrientationCtrl)
    {
      $this->middleware('auth');
      //$this->LettreOrientationCTRL = $LettreOrientationCtrl;
    }
    public function index()
    {
      $etatsortie = Etatsortie::where('type',null)->get();
      return view('consultations.index', compact('etatsortie'));
    }
    public function detailcons($id_cons)
    { 
      $consultation = consultation::FindOrFail($id_cons);
      return view('consultations.resume_cons', compact('consultation'));
    }
    public function detailconsXHR(Request $request)
    {
      $etablissement = Etablissement::first();
      $specialite = Specialite::findOrFail(Auth::user()->employ->specialite);
      $consultation = consultation::FindOrFail($request->id);
      $view =  view("consultations.inc_consult",compact('consultation','etablissement','specialite'))->render();
      return (['html'=>$view]);
    }
    public function listecons($id)
    {
      $patient = patient::with('Consultations.patient','Consultations.medecin.Specialite')->FindOrFail($id);
      $consults= consultation::with('patient','medecin.Specialite')
                              ->whereHas('patient', function($q) use ($id) {
                                $q->where('pid', $id);
                              })->get();        
      return Response::json($patient->Consultations)->withHeaders(['patient' => $patient->full_name ]);
      
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create(Request $request,$id_patient)
      {
        $etablissement = Etablissement::first(); 
        $employe = Auth::user()->employ;
        $specialite = Specialite::findOrFail($employe->specialite);
        $modesAdmission = config('settings.ModeAdmissions') ;
        $infossupp = infosupppertinentes::all();//$examens = TypeExam::all();//CT,RMN
        $examensradio = examenradiologique::all();//pied,poignet
        $patient = patient::FindOrFail($id_patient);//$codesim = codesim::all();
        $chapitres = chapitre::all();$services = service::all();$apareils = appareil::all();
        $meds = User::whereIn('role_id', [1,13,14])->get();
        $specialites = Specialite::where('type','<>',null)->orderBy('nom')->get();
        return view('consultations.create',compact('patient','employe','etablissement','chapitres','apareils','meds','specialites','modesAdmission','services','infossupp','examensradio','specialite'));
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      { //$request->validate([   "motif" => 'required',    "resume" => 'required',     ]);
        $constvalue =  collect();$exam;
        $etablissement = Etablissement::first(); 
        $validator = Validator::make($request->all(), [
                'motif' => 'required',
                'resume' => 'required',
         ]);
         if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
        $specialite = Specialite::findOrFail(Auth::user()->employ->specialite);
        $consult = consultation::create([
          "motif"=>$request->motif,
          "histoire_maladie"=>$request->histoirem,
          "date"=>Date::Now(),
          "Diagnostic"=>$request->diagnostic,
          "Resume_OBS"=>$request->resume,
          "isOriented"=> (!empty($request->isOriented) ? 1 : 0),
          "lettreorientaioncontent"=>(!empty($request->isOriented) ? $request->lettreorientaioncontent  : null),
          "employ_id"=>Auth::User()->employee_id,
          "pid"=>$request->patient_id,
          "id_code_sim"=>$request->codesim,
          "id_lieu"=>$etablissement->id
        ]);
        foreach($consult->patient->rdvs as $rdv)
        {
          if( $rdv->date->setTime(0, 0)  == $consult->date->setTime(0, 0) )
            $rdv->update(['Etat_RDV'=>1]);
        }
        if($specialite->consConst) {
          foreach(json_decode($specialite->consConst) as $const)
          {
            $c = Constante::FindOrFail($const);
            if( $c->normale  !=  $request->input($c->nom)  && ($c->min  !=  $request->input($c->nom)) && ($request->input($c->nom)) != null)
              $constvalue->put($c->nom, $request->input($c->nom));
          }
        }
        if($constvalue->count()>0)
        {
          $input = $request->all();
          $input['id_consultation'] = $consult->id ;
          $exam = examen_cliniqu::create($input);
          $constvalue['examCl_id'] = $exam->id ;
          Constantes::create($constvalue->toArray());
          $consult->examensCliniques()->save($exam);
        } 
        if($specialite->appareils) {
          foreach (json_decode ($specialite->appareils ) as  $appareil) {   
            $appareil = appareil::FindOrFail($appareil);
            if( null !== $request->input($appareil->nom))
            {
              if(!isset( $exam->id))
              {
                $input = $request->all();
                $input['id_consultation'] = $consult->id ;
                $exam = examen_cliniqu::create($input);
              }  
              $examAppareil = new examAppareil;
              $examAppareil->appareil_id = $appareil->id;
              $examAppareil->description = $request->input($appareil->nom); 
              $examAppareil->examen_clinique_id =  $exam->id;
              $exam->examsAppareil()->save($examAppareil);
            }
          }  
        }
        if(json_decode($request->orients) !== null) {
          foreach (json_decode($request->orients, true) as $key => $orient) {
            $orient['consultation_id'] = $consult->id ;
            LettreOrientation::create($orient);
          }
        }/*if(($request->motifOr != "") ||(isset($request->specOr))){$this->LettreOrientationCTRL->store($request,$consult->id);}*/
        if($request->liste != null)//save Ordonnance
        {
          $ord = new ordonnance;$ord->date = Date::Now();
          $consult->ordonnances()->save($ord);
          foreach (json_decode($request->liste) as $key => $trait) {
            $ord->medicamentes()->attach($trait->med,['posologie' => $trait->posologie]);     
          }
        }
        if($request->exmsbio  != null && (count($request->exmsbio) >0 ))//save ExamBiolo
        {
          $demandeExamBio = new demandeexb;
          $consult->demandeexmbio()->save($demandeExamBio);
          foreach($request->exmsbio as $id_exb) {//$demandeExamBio->examensbios()->attach($id_exb);
            $exam = new demandeexb_examenbio;
            $exam->id_demandeexb = $demandeExamBio->id;
            $exam->id_examenbio = $id_exb;
            $exam->save();
          }
        }
        if(!empty($request->ExamsImg) && count(json_decode($request->ExamsImg)) > 0)
        { 
          $demandeExImg = new demandeexr;
          $demandeExImg->InfosCliniques = $request->infosc;
          $demandeExImg->Explecations = $request->explication;
          $demandeExImg->id_consultation = $consult->id;
          $demandeExImg->save();
          if(isset($request->infos))
          {
            foreach ($request->infos as $id_info) {
              $demandeExImg->infossuppdemande()->attach($id_info);
            }
          }
          foreach (json_decode ($request->ExamsImg) as $key => $acte) {       
            $exam = new Demandeexr_Examenradio;
            $exam->demande_id = $demandeExImg->id;$exam->exm_id = $acte->acteId;
            $exam->type_id = $acte->type;$exam->save();  
          }
        } 
        if($request->modeAdmission != null)
        {  // $input = $request->all();// $input['etat'] = "en attente" ; $input['id_consultation'] = $consult->id ;
            DemandeHospitalisation::create([
                "modeAdmission"=>$request->modeAdmission,
                "specialite"=>$request->specialiteDemande,
                "service"=>$request->service,
                "etat" => NULL,
                "id_consultation"=>$consult->id
            ]);
        }
         return redirect(Route('patient.show',$request->patient_id));
       }
    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
      public function show($id)
      {
        $consultation = consultation::with('patient','medecin','examensCliniques.Consts')->FindOrFail($id);
        $specialites = Specialite::where('type','<>',null)->orderBy('nom')->get();
        $specialite = Specialite::findOrFail(Auth::user()->employ->specialite);
        return view('consultations.show', compact('consultation','specialite','specialites'));
      }
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     *//* public function choix() { return view('consultations.add'); }*/
      public function getConsultations(Request $request)
      {
        if($request->ajax())  
        {         
          if($request->field == 'date')
            $consults =consultation::with('patient','medecin.Specialite')->where(trim($request->field),'=',trim($request->value))->get();
          else
            $consults =consultation::with('patient','medecin.Specialite')->whereHas('patient',function($q) use ($request){
                                        $q->where(trim($request->field),'LIKE','%'.trim($request->value)."%");  
                                    })->get();
          return $consults;
        }
      }
}