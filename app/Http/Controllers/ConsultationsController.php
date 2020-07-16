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
use Validator;
class ConsultationsController extends Controller
{
    protected $OrdonnanceCTLR,$ExamCliniqueCTLR,$ExamBioloqiqueCTLR,$ExamImagerieCTLR,$ExamAnapathCTLR,$DemandeHospCTRL,$LettreOrientationCTRL;
    public function __construct(OrdonnanceController $OrdonnaceCtrl,ExamenCliniqueController $ExamCliniqCtrl,  DemandeExbController $ExamBiologiqCtrl, DemandeExamenRadio $ExamImagCtrl,ExmAnapathController $ExamAnapathCtrl,
                                      DemandeHospitalisationController $DemandeHospCtrl,
                                      LettreOrientationController $LettreOrientationCtrl)
    {
      $this->middleware('auth');
      $this->OrdonnanceCTLR = $OrdonnaceCtrl;
      $this->ExamCliniqCTLR = $ExamCliniqCtrl;
      $this->ExamBioloqiqueCTLR = $ExamBiologiqCtrl;
      $this->ExamImagerieCTLR = $ExamImagCtrl;
      $this->ExamAnapathCTLR = $ExamAnapathCtrl;
      $this->DemandeHospCTRL = $DemandeHospCtrl;
      $this->LettreOrientationCTRL = $LettreOrientationCtrl;
    }
    // public function demandeExm($id_cons)// {//   $consultation = consultation::FindOrFail($id_cons);
    //   $id_patient = $consultation->Patient_ID_Patient;//   $patient = patient::FindOrFail($id_patient);
    //   return view('consultations.demande_examen',compact('id_cons','patient'));// }
    public function index($id)
    {
      $patient = patient::FindOrFail($id);
      $consultations = consultation::where("Patient_ID_Patient",$patient->id)->get()->all();
      return view('consultations.index_consultation', compact('patient','consultations'));
    }

    public function detailcons($id_cons)
    {  
      $consultation = consultation::FindOrFail($id_cons);
      $consults = $consultation->patient->Consultations;    
      $examensbios = demandeexb::where("id_consultation",$id_cons)->get();
      $demande = $consultation->demandeExamImagegerie;
      if(isset($id_cons))//  $examensimg = json_decode($demande->examsImagerie); 
        $exmclin = examen_cliniqu::where("id_consultation",$id_cons)->get()->first();
      $examsRadio = $consultation->examensradiologiques;
      $ordonnance= $consultation->ordonnances;
      return view('consultations.resume_cons', compact('consultation','examensbios' ,'examensimg', 'exmclin', 'examsRadio', 'ordonnance', 'consults'));
    }
    public function detailconsXHR(Request $request)
     {
        $consultation = consultation::FindOrFail($request->id);
        $ordonnance= $consultation->ordonnances;
        if($ordonnance != null )
          $medicaments =  $ordonnance->medicamentes;  
        $view =  view("consultations.inc_consult",compact('consultation'))->render();
        return response()->json(['html'=>$view]);

     }
    public function listecons()
    {
      $consultations = []; 
      if( null != request('q') )
      {
        $patient = patient::where('Nom', 'like', '%' . request('q') . '%')
                          ->orwhere('Prenom', 'like', '%' . request('q') . '%')->paginate(5);
        $consultations = $patient->first()->Consultations;
      }
      return view('consultations.liste_consultations', compact('consultations'));
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
       $patient = patient::FindOrFail($id_patient);
       $codesim = codesim::all();// $lieus = Lieuconsultation::all(); 
       $services = service::all();
       $meds = User::where('role_id',1)->get()->all(); 
       $specialites = Specialite::orderBy('nom')->get();
       $specialitesExamBiolo = specialite_exb::all();
       $infossupp = infosupppertinentes::all();
       $examens = exmnsrelatifdemande::all();
       $examensradio = examenradiologique::all();
       return view('consultations.create_consultation',compact('patient','employe','codesim','meds','specialites','specialitesExamBiolo','modesAdmission','services','infossupp','examens','examensradio'));
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
         $consult = consultation::create([
                "Motif_Consultation"=>$request->motif,
                "histoire_maladie"=>$request->histoirem,
                "Date_Consultation"=>Date::Now(),
                "Diagnostic"=>$request->diagnostic,
                "Resume_OBS"=>$request->resume,
                "isOriented"=> (!empty($request->isOriented) ? 1 : 0),
                "lettreorientaioncontent"=>(!empty($request->isOriented) ? $request->lettreorientaioncontent  : null),
                "Employe_ID_Employe"=>Auth::User()->employee_id,
                "Patient_ID_Patient"=>$request->id,
                "id_code_sim"=>$request->codesim,
                "id_lieu"=>session('lieu_id'),
          ]);
          if($request->poids != 0 || $request->temp != null || $request->taille !=0 || $request->autre)
            $this->ExamCliniqCTLR->store( $request,$consult->id); //save examen clinique
          if(isset($request->isOriented)){
            $this->LettreOrientationCTRL->store($request,$consult->id);
          }
          if($request->liste != null)
            $this->OrdonnanceCTLR->store( $request,$consult->id);    //save Ordonnance
          if($request->exm  != null)  //save ExamBiolo
            $this->ExamBioloqiqueCTLR->store( $request,$consult->id); 
          if(empty($request->ExamsImg))
            $this->ExamImagerieCTLR->store( $request,$consult->id); 
          if(isset($request->examen_Anapath)) 
            $this->ExamAnapathCTLR->store( $request,$consult->id);
          if($request->modeAdmission != null)
            $this->DemandeHospCTRL->store($request,$consult->id);    
          return redirect(Route('patient.show',$request->id));
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
    public function edit(consultation $consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, consultation $consultation)
     {
     //
       }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
    public function destroy(consultation $consultation)
    {
        //
    }
    
    public function choix()
    {
        $patients = patient::all();
        return view('consultations.choix_patient',compact('patients'));
    } 
}