<?php

namespace App\Http\Controllers;
use DB;
use App\modeles\patient;
use App\modeles\consultation;
use App\modeles\antecedant;
use App\modeles\codesim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\modeles\Lieuconsultation;
use App\modeles\DemandeHospitalisation;
use App\modeles\examenbiologique;
use App\modeles\examenimagrie;
use App\modeles\examenanapath;
use App\modeles\hospitalisation;
use App\modeles\service;
use App\modeles\examen_cliniqu;
use App\modeles\ordonnance;
use App\modeles\employ;
use App\modeles\demandeExamImag;
use App\modeles\demandeexb;
use App\User;
use App\modeles\Specialite;
use App\modeles\LettreOrientation;
use App\modeles\specialite_exb;
use App\modeles\infosupppertinentes;
use App\modeles\exmnsrelatifdemande;
use App\modeles\examenradiologique;
use App\modeles\demandeexr;
use App\modeles\CIM\chapitre;
use App\modeles\facteurRisqueGeneral;
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
      return view('consultations.index');
    }
    public function detailcons($id_cons)
    { 
      $consultation = consultation::FindOrFail($id_cons);
      return view('consultations.resume_cons', compact('consultation'));
    }
       public function detailconsXHR(Request $request)
       {
          $consultation = consultation::FindOrFail($request->id);
          $view =  view("consultations.inc_consult",compact('consultation'))->render();
          return response()->json(['html'=>$view]);
        }
        public function listecons($id)
        {
               $patient = patient::with('Consultations.patient','Consultations.docteur','Consultations.docteur.service')->FindOrFail($id);
              return Response::json($patient->Consultations)->withHeaders(['patient' => $patient->Nom . " " . $patient->Prenom]);
        }
        /**
       * Show the form for creating a new resource.
       *
        * @return \Illuminate\Http\Response
       */
        public function create(Request $request,$id_patient)
        {
          $employe=Auth::user()->employ;
          $modesAdmission = config('settings.ModeAdmissions') ;
          $patient = patient::FindOrFail($id_patient);//$codesim = codesim::all();
          //dd($patient->facteurRisque);
          $chapitres = chapitre::all();
          $services = service::all();
          $meds = User::where('role_id',1)->get()->all();
          $specialites = Specialite::orderBy('nom')->get();
          $specialitesExamBiolo = specialite_exb::all();
          $infossupp = infosupppertinentes::all();
          $examens = exmnsrelatifdemande::all();//CT,RMN
          $examensradio = examenradiologique::all();//pied,poignet
          return view('consultations.create_consultation',compact('patient','employe','chapitres','meds','specialites','specialitesExamBiolo','modesAdmission','services','infossupp','examens','examensradio'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
          $request->validate([
              "motif" => 'required',
              "resume" => 'required',
          ]);
          $validator = Validator::make($request->all(), [
            'motif' => 'required|max:255',
            'resume' => 'required',
          ]);
          if($validator->fails())
                return redirect()->back()->withErrors($validator)->withInput();
          $fact = facteurRisqueGeneral::updateOrCreate( ['patient_id' =>  request('patient_id')], $request->all());
          $consult = consultation::create([
                "Motif_Consultation"=>$request->motif,
                "histoire_maladie"=>$request->histoirem,
                "Date_Consultation"=>Date::Now(),
                "Diagnostic"=>$request->diagnostic,
                "Resume_OBS"=>$request->resume,
                "isOriented"=> (!empty($request->isOriented) ? 1 : 0),
                "lettreorientaioncontent"=>(!empty($request->isOriented) ? $request->lettreorientaioncontent  : null),
                "Employe_ID_Employe"=>Auth::User()->employee_id,
                "Patient_ID_Patient"=>$request->patient_id,
                "id_code_sim"=>$request->codesim,
                "id_lieu"=>session('lieu_id'),
           ]);
          foreach($consult->patient->rdvs as $rdv)
          {
               if( $rdv->Date_RDV->setTime(0, 0)  == $consult->Date_Consultation->setTime(0, 0) )
                    $rdv->update(['Etat_RDV'=>1]);
          }
          if($request->poids != 0 || $request->temp != null || $request->taille !=0 || $request->autre)
          {
               $exam = new examen_cliniqu;
               $exam->taille = $request->taille;
               $exam->poids  = $request->poids;
               $exam->temp   = $request->temp;
              $exam->autre  = $request->autre;
              $exam->IMC    = $request->imc;
              $exam->Etat   = $request->etatgen;
              $exam->peaupha =$request->peaupha; // $exam->id_consultation=$consultID;
              $consult->examensCliniques()->save($exam);
        }
        if(($request->motifOr != "") ||(isset($request->specialite))){
          $this->LettreOrientationCTRL->store($request,$consult->id);
        }
        if($request->liste != null) //save Ordonnance
        {
          $ord = new ordonnance;
          $ord->date = Date::Now();
          $consult->ordonnances()->save($ord);
          foreach (json_decode($request->liste) as $key => $trait) {
            $ord->medicamentes()->attach($trait->med,['posologie' => $trait->posologie]);     
          }
        }
        if($request->exm  != null)  //save ExamBiolo
        {
          $demandeExamBio = new demandeexb;
          $consult->demandeexmbio()->save($demandeExamBio);
          foreach($request->exm as $id_exb) {
            $demandeExamBio->examensbios()->attach($id_exb);
          }
        }
        if(!empty($request->ExamsImg) && count(json_decode($request->ExamsImg)) > 0)
        {
              $demandeExImg = new demandeexr;
              $demandeExImg->InfosCliniques = $request->infosc;
              $demandeExImg->Explecations = $request->explication;
              $demandeExImg->id_consultation = $consult->id;
              $consult->examensradiologiques()->save($demandeExImg);
              if(isset($request->infos))
              {
                foreach ($request->infos as $id_info) {
                  $demandeExImg->infossuppdemande()->attach($id_info);
                }
              }
              foreach (json_decode ($request->ExamsImg) as $key => $value) {       
                 $demandeExImg ->examensradios()->attach($value->acteImg, ['examsRelatif' => $value->types]);
              }
        }
        if($request->modeAdmission != null)
        {
          $dh =new DemandeHospitalisation;
          $dh->modeAdmission = $request->modeAdmission;
          $dh->service = $request->service;
          $dh->specialite = $request->specialiteDemande; // $dh->id_consultation = $consult->id;  // $dh->etat = "en attente";
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
      $consultation = consultation::FindOrFail($id);
      $patient = patient::FindOrFail($consultation->Patient_ID_Patient);
      $antecedants = antecedant::where('Patient_ID_Patient',$patient->id)->get();
      return view('consultations.show_consultation', compact('consultation','patient','antecedants'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function edit(consultation $consultation){}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, consultation $consultation){}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(consultation $consultation){}
    public function choix()
    {
       return view('consultations.add');
    } 
}