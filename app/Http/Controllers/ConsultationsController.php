<?php

namespace App\Http\Controllers;//use DB;
use App\modeles\patient;
use App\modeles\consultation;
use App\modeles\Constantes;
use App\modeles\antecedant;
use App\modeles\codesim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\modeles\Etablissement;
use App\modeles\DemandeHospitalisation;
use App\modeles\examenbiologique;
use App\modeles\examenimagrie;
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
      $this->LettreOrientationCTRL = $LettreOrientationCtrl;
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
            $consultation = consultation::with('patient','medecin')->FindOrFail($request->id);
            $etablissement = Etablissement::first();
            $patient =   $consultation->patient;
            $employe =   $consultation->medecin;
            $view =  view("consultations.inc_consult",compact('consultation','patient','etablissement','employe'))->render();
            return response()->json(['html'=>$view]);
    }
    public function listecons($id)
    {
          $patient = patient::with('Consultations.patient','Consultations.medecin','Consultations.medecin.service')->FindOrFail($id);
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
        $modesAdmission = config('settings.ModeAdmissions') ;
        $infossupp = infosupppertinentes::all();//$examens = TypeExam::all();//CT,RMN
        $examensradio = examenradiologique::all();//pied,poignet
        $patient = patient::FindOrFail($id_patient);//$codesim = codesim::all();
        $chapitres = chapitre::all();
        $services = service::all();
        $apareils = appareil::all();
        $meds = User::where('role_id',1)->get()->all();
        $specialites = Specialite::where('type','!=',2)->orderBy('nom')->get();
        $specialite = Specialite::findOrFail($employe->specialite);     //,'specialitesExamBiolo'
        return view('consultations.create',compact('patient','employe','etablissement','chapitres','apareils','meds','specialites','modesAdmission','services','infossupp','examensradio','specialite'));
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      {      //$request->validate([   "motif" => 'required',    "resume" => 'required',     ]);
               $specialite = Specialite::findOrFail((Auth::user()->employ)->specialite);  
             $validator = Validator::make($request->all(), [
                    'motif' => 'required|max:255',
                    'resume' => 'required',
              ]);
              if($validator->fails())
                     return redirect()->back()->withErrors($validator)->withInput();
              $etablissement = Etablissement::first(); 
              $fact = facteurRisqueGeneral::updateOrCreate( ['patient_id' =>  request('patient_id')], $request->all());
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
                       "id_lieu"=>$etablissement->id// "id_lieu"=>session('lieu_id'),
               ]);
              foreach($consult->patient->rdvs as $rdv)
             {
                   if( $rdv->date->setTime(0, 0)  == $consult->date->setTime(0, 0) )
                           $rdv->update(['etat'=>1]);
             }
               if(($request->poids > 0.5) || ($request->taille > 10) ||($request->temp !=37))//$request->temp != null ||
              {
                      $apareils = appareil::all();
                      $exam = new examen_cliniqu;
                      $input = $request->all();
                      $input['id_consultation'] = $consult->id ;
                     $exam = examen_cliniqu::create($input);
                      $input['examCl_id'] = $exam->id ;
                      $const =Constantes::create($input);
                      $consult->examensCliniques()->save($exam);
              }
                foreach (json_decode ($specialite->appareils ) as  $appareil) {   
                      $appareil = appareil::FindOrFail($appareil);
                      if( null !== $request->input($appareil->nom))
                      {
                             $examAppareil = new examAppareil;
                             $examAppareil->appareil_id = $appareil->id;
                             $examAppareil->description = $request->input($appareil->nom);
                             $consult->examsAppareil()->save($examAppareil);
                      }
                }
               if(($request->motifOr != "") ||(isset($request->specialite))){
                         $this->LettreOrientationCTRL->store($request,$consult->id);
               }
             if($request->liste != null)//save Ordonnance
             {
                    $ord = new ordonnance;
                    $ord->date = Date::Now();
                    $consult->ordonnances()->save($ord);
                    foreach (json_decode($request->liste) as $key => $trait) {
                          $ord->medicamentes()->attach($trait->med,['posologie' => $trait->posologie]);     
                   }
             }
            if($request->exmsbio  != null && (count($request->exmsbio) >0 ))//save ExamBiolo
            {
                  $demandeExamBio = new demandeexb;
                  $consult->demandeexmbio()->save($demandeExamBio);
                  foreach($request->exmsbio as $id_exb) {
                    $demandeExamBio->examensbios()->attach($id_exb);
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
                  $exam->demande_id = $demandeExImg->id;
                  $exam->exm_id = $acte->acteId;
                  $exam->type_id = $acte->type;
                  $exam->save();
                }
            } 
            if($request->modeAdmission != null)
            {
                    $dh = new DemandeHospitalisation;
                    $dh->modeAdmission = $request->modeAdmission;  $dh->service = $request->service;
                    $dh->specialite = $request->specialiteDemande; 
                    $consult->demandeHospitalisation()->save($dh);
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
              $consultation = consultation::with('patient','medecin')->FindOrFail($id);
              return view('consultations.show', compact('consultation'));
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
     */
    public function choix()
    {
       return view('consultations.add');
    }
      public function getConsultations(Request $request)
      {
              if($request->ajax())  
              {         
                if($request->field == 'date')
                  $consults =consultation::with('patient','medecin')->where(trim($request->field),'=',trim($request->value))->get();
                else
                  $consults =consultation::with('patient','medecin')->whereHas('patient',function($q) use ($request){
                                                              $q->where(trim($request->field),'LIKE','%'.trim($request->value)."%");  
                                                          })->get();
                return Response::json($consults);
              }
      }
}