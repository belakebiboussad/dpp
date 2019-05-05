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
use App\User;
use App\modeles\Specialite;
use App\modeles\LettreOrientation;
use App\modeles\specialite_exb;
use App\modeles\infosupppertinentes;
use App\modeles\exmnsrelatifdemande;
use App\modeles\examenradiologique;
use Config;
class ConsultationsController extends Controller
{

        protected $OrdonnanceCTLR,$ExamCliniqueCTLR,$ExamBioloqiqueCTLR,$ExamImagerieCTLR,$ExamAnapathCTLR,$DemandeHospCTRL,
                          $LettreOrientationCTRL;
      public function __construct(OrdonnanceController $OrdonnaceCtrl,
                                       ExamenCliniqueController $ExamCliniqCtrl,
                                       DemandeExbController $ExamBiologiqCtrl,
                                       DemandeExamenRadio $ExamImagCtrl,   //ExmImgrieController $ExamImagCtrl,
                                       ExmAnapathController $ExamAnapathCtrl,
                                       DemandeHospitalisationController $DemandeHospCtrl,
                                       LettreOrientationController $LettreOrientationCtrl)
    {
                $this->OrdonnanceCTLR = $OrdonnaceCtrl;
                $this->ExamCliniqCTLR = $ExamCliniqCtrl;
                $this->ExamBioloqiqueCTLR = $ExamBiologiqCtrl;
                $this->ExamImagerieCTLR = $ExamImagCtrl;
                $this->ExamAnapathCTLR = $ExamAnapathCtrl;
                $this->DemandeHospCTRL = $DemandeHospCtrl;
                 $this->LettreOrientationCTRL = $LettreOrientationCtrl;
    }
    public function demandeExm($id_cons)
    {
        $consultation = consultation::FindOrFail($id_cons);
        $id_patient = $consultation->Patient_ID_Patient;
        $patient = patient::FindOrFail($id_patient);
        return view('consultations.demande_examen',compact('id_cons','patient'));
    }
    public function detailcons($id_cons)
    {  

           $consultation = consultation::FindOrFail($id_cons);
           // liste des consultations du patient
           $consults = consultation::join('employs','employs.id','=','consultations.Employe_ID_Employe')->leftjoin('codesims', 'codesims.id', '=', 'consultations.id_code_sim')->select('consultations.*','employs.Nom_Employe','employs.Prenom_Employe','codesims.description')->where('consultations.Patient_ID_Patient', $consultation->patient->id)->get();
                //$examensbios = examenbiologique::where("id_consultation",$id_cons)->get();// $examensimg = examenimagrie::where("id_consultation",$id_cons)->get(); 
           $demande = demandeExamImag::where("id_consultation",$id_cons)->get(['examsImagerie'])->first(); 
           if(isset($demande))
                    $examensimg = json_decode($demande->examsImagerie); 
           $exmclin = examen_cliniqu::where("id_consultation",$id_cons)->get()->first();
             //$ordennances = ordonnance::where("id_consultation",$id_cons)->get(['medicaments'])->first();
           $examsRadio = $consultation->examensradiologiques;
           $ordonnance= $consultation->ordonnances;
           if($ordonnance != null )
                $medicaments =  $ordonnance->medicamentes;  
           return view('consultations.resume_cons', compact('consultation', 'examensimg', 'exmclin', 'ordonnance', 'examsRadio', 'medicaments','consults'));
     }
     public function detailconsXHR(Request $request)
     {

           $consultation = consultation::FindOrFail($request['id']);
           $demande = demandeExamImag::where("id_consultation",$request['id'])->get(['examsImagerie'])->first(); 
           if(isset($demande))
                    $examensimg = json_decode($demande->examsImagerie); 
           $exmclin = examen_cliniqu::where("id_consultation",$request['id'])->get()->first();
           $examsRadio = $consultation->examensradiologiques;
           $ordonnance= $consultation->ordonnances;
           if($ordonnance != null )
                $medicaments =  $ordonnance->medicamentes;  
           //$view = view("consultations.ajax_consult_detail",compact('consultation','examensimg','exmclin','ordonnance','examsRadio', 'medicaments'))->render();
           $view =  view("consultations.inc_consult",compact('consultation','exmclin','examsRadio'))->render();
           return response()->json(['html'=>$view]);

     }
    public function listecons()
    {
           $consultations = consultation::all();
             return view('consultations.liste_consultations', compact('consultations'));
    }

    public function index($id)
    {
        $patient = patient::FindOrFail($id);
        $consultations = consultation::where("Patient_ID_Patient",$patient->id)->get()->all();
        return view('consultations.index_consultation', compact('patient','consultations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id_patient)
    {
            $employe= employ::where("id",Auth::user()->employee_id)->get()->first() ;
            $modesAdmission = [
                'Ambulatoire' => "Ambulatoire",
                'urgence' => "urgence",
                 'programme' => "programme",
             ];
            $patient = patient::FindOrFail($id_patient);
            $codesim = codesim::all();
            $lieus = Lieuconsultation::all(); 
            $services = service::all();
            $antecedants = antecedant::where('Patient_ID_Patient',$patient->id)->get();
            $meds = User::where('role_id',1)->get()->all(); 
            $specialites = Specialite::orderBy('nom')->get();
            $specialitesExamBiolo = specialite_exb::all();
            $infossupp = infosupppertinentes::all();
           $examens = exmnsrelatifdemande::all();
           $examensradio = examenradiologique::all();
            return view('consultations.create_consultation',compact('patient','employe','antecedants','codesim','lieus','meds','specialites','specialitesExamBiolo','modesAdmission','services','infossupp', 
              'examens','examensradio'));
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
                "motif" => 'required',   // "histoirem" => 'required',
                "resume" => 'required',
           ]);

           $nomlieu = Config::get('constants.lieuc');
           $lieu = Lieuconsultation::where('Nom', $nomlieu)->first();
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
                     "id_lieu"=> $lieu->id,
           ]);  
           if($request->poids != 0 || $request->temp != null || $request->taille !=0 || $request->autre)
                      $this->ExamCliniqCTLR->store( $request,$consult->id); //save examen clinique
          if(isset($request->isOriented)){
                          $this->LettreOrientationCTRL->store($request,$consult->id);
           }   
           if($request->liste != null)
                $this->OrdonnanceCTLR->store( $request,$consult->id);    //save Ordonnance
       
          if($request->exm  != null)  //save ExamBiolo
          {  
                  $this->ExamBioloqiqueCTLR->store( $request,$consult->id); 
          }
           
           if(isset($request->exmns))
               $this->ExamImagerieCTLR->store( $request,$consult->id); 

          if(isset($request->examen_Anapath)) 
                           $this->ExamAnapathCTLR->store( $request,$consult->id);
           if($request->modeAdmission != null)
                $this->DemandeHospCTRL->store($request,$consult->id);    

           // if(array_key_exists('RX', $request->examRad) || ($request->examRad["AutRX"][0] != null) || (array_key_exists('ECHO', $request->examRad)) || (array_key_exists('CT', $request->examRad)) || ($request->examRad['AutCT'][0] != null) || (array_key_exists('RMN', $request->examRad))  || ($request->examRad['AutRMN'][0] != null) || ($request->examRad['AutECHO'][0] != null))
           //            $this->ExamImagerieCTLR->store( $request,$consult->id); 
           // return redirect()->route('consultations.show',$consult->id);    return redirect()->action('PatientController@index');
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
