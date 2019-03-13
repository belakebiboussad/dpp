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
use Config;
class ConsultationsController extends Controller
{

    protected $OrdonnanceCTLR,$ExamCliniqueCTLR,$ExamBioloqiqueCTLR,$ExamImagerieCTLR,$ExamAnapathCTLR,
        $DemandeHospCTRL,$LettreOrientationCTRL;
    public function __construct(OrdonnanceController $OrdonnaceCtrl,
                                           ExamenCliniqueController $ExamCliniqCtrl,
                                           ExamenbioController $ExamBiologiqCtrl,
                                           ExmImgrieController $ExamImagCtrl,
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

          $consultation = consultation::join('lieuconsultations','lieuconsultations.id','=','consultations.id_lieu')
          ->where('consultations.id', '=',$id_cons) ->select('consultations.*','lieuconsultations.Nom')->get()->first(); 
          $patient = patient::where("id",$consultation->Patient_ID_Patient)->get()->first();    
          // liste des consultations du patient
          $consults = consultation::join('codesims', 'codesims.id', '=', 'consultations.id_code_sim')
                 ->join('lieuconsultations','lieuconsultations.id','=','consultations.id_lieu')
                ->join('employs','employs.id','=','consultations.Employe_ID_Employe') 
                ->where('consultations.Patient_ID_Patient', $patient->id)
                ->select('consultations.*','codesims.description','lieuconsultations.Nom','employs.Nom_Employe','employs.Prenom_Employe')->get(['consultations.*','codesims.description','lieuconsultations.Nom','employs.Nom_Employe','employs.Prenom_Employe']);
          $examensbios = examenbiologique::where("id_consultation",$id_cons)->get();
          // $examensimg = examenimagrie::where("id_consultation",$id_cons)->get(); 
          $demande = demandeExamImag::where("id_consultation",$id_cons)->get(['examsImagerie'])->first(); 
          if(isset($demande))
               $examensimg = json_decode($demande->examsImagerie); 
         $exmclin = examen_cliniqu::where("id_consultation",$id_cons)->get()->first();
         $ordennances = ordonnance::where("id_consultation",$id_cons)->get(['medicaments'])->first();
        $medicaments = json_decode( $ordennances['medicaments'],true);
     
        return view('consultations.resume_cons', compact('consultation','patient','examensbios','examensimg','exmclin','ordennances','medicaments','consults'));
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
          // dd($employe);
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
              return view('consultations.create_consultation',compact('patient','employe','antecedants','codesim','lieus','meds','specialites','modesAdmission','services'));

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
        "histoire" => 'required',
        "resume" => 'required',
      ]);
      
      $nomlieu = Config::get('constants.lieuc');
      $lieu = Lieuconsultation::where('Nom', $nomlieu)->first();
      $consultation = consultation::create([
        "Motif_Consultation"=>$request->motif,
        "histoire_maladie"=>$request->histoire,
        "Date_Consultation"=>Date::Now(),
        "Diagnostic"=>$request->diag,
        "Resume_OBS"=>$request->resume,
        "isOriented"=> (!empty($request->isOriented) ? 1 : 0),
        "Employe_ID_Employe"=>Auth::User()->employee_id,
        "Patient_ID_Patient"=>$request->id_patient,
        "id_lieu"=> $lieu->id,
      ]);

      return redirect()->route('consultations.show', $consultation->id);

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
        return view('consultations.show_consultation', compact('consultation'));
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
