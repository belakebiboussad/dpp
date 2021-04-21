<?php
namespace App\Http\Controllers;
use App\modeles\patient;
use App\modeles\visite;
use App\modeles\hospitalisation;
use App\modeles\demandehospitalisations;
use App\modeles\consigne;
use App\modeles\periodeconsigne;
use App\modeles\surveillance;
use App\modeles\consultations;
use App\modeles\specialite_produit;
use App\modeles\specialite_exb;
use App\modeles\infosupppertinentes;
use App\modeles\examenradiologique;
use App\modeles\exmnsrelatifdemande;
use App\modeles\demandeexb;
use App\modeles\demandeexr;
use App\modeles\NGAP;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use DB;
use Carbon;
class VisiteController extends Controller
{
    //
	    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return redirect()->action('HospitalisationController@index');
    }
    public function choixpatvisite()
    {    
      $patients=patient::join('consultations','patients.id','=','consultations.Patient_ID_Patient')
                 ->join('demandehospitalisations','consultations.id','=','demandehospitalisations.id_consultation')
                 ->join('hospitalisations','demandehospitalisations.id','=','hospitalisations.id_demande')
                 ->select('patients.Nom','patients.Prenom','patients.Sexe','patients.Dat_Naissance','hospitalisations.Date_entree','hospitalisations.Date_Prevu_Sortie','hospitalisations.id')->get();
      return view('visite.choix_patient_visite',compact('patients'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_hosp)
    {
      $date = Carbon\Carbon::now(); 
      $hosp = hospitalisation::FindOrFail($id_hosp);//$patient = (hospitalisation::FindOrFail($id_hosp))->admission->demandeHospitalisation->consultation->patient;
      $patient = $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient;
      $employe = Auth::user()->employ;
      $visite =new visite;
      $visite->date=$date;
      $visite->heure=$date->format("H:i");
      $visite->id_hosp=$id_hosp;
      $visite->id_employe=Auth::User()->employee_id;
      $specialitesProd = specialite_produit::all();
      $specialitesExamBiolo = specialite_exb::all();
      $infossupp = infosupppertinentes::all();
      $examens = exmnsrelatifdemande::all();//CT,RMN
      $examensradio = examenradiologique::all();
      $codesNgap = NGAP::all();
      $visite->save();
      return view('visite.add',compact('hosp','patient', 'employe','specialitesProd','specialitesExamBiolo','infossupp','examens','examensradio','codesNgap'))->with('id',$visite->id);
    }
 /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Enregistrer Examen Complentaire
      $visite = visite::find($request->id); 
      if($request->exm  != null)  //save ExamBiolo
      {
        $demandeExamBio = new demandeexb;
        $visite->demandeexmbio()->save($demandeExamBio);
        foreach($request->exm as $id_exb) {
          $demandeExamBio->examensbios()->attach($id_exb);
        }
      }
      if(!empty($request->ExamsImg) && count(json_decode($request->ExamsImg)) > 0)
      {
        $demandeExImg = new demandeexr;  $demandeExImg->InfosCliniques = $request->infosc;
        $demandeExImg->Explecations = $request->explication;
        $demandeExImg->visite_id = $request->id;
        
        $visite->examensradiologiques()->save($demandeExImg);
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
      return redirect()->action('HospitalisationController@index');
    }
    public function edit($id)
    {
      $hosp = hospitalisation::find($id);
      return view('visite.edit',compact('hosp'));  
    }
    public function destroy($id)
    {
      $visite = visite::find($id);
      try {
          $obj = $visite->delete();
      } catch (Exception $e) {
        report($e);
        return false;
      }
      $hospitalisations = hospitalisation::where('etat_hosp','=','en cours')->get();
      return response()->json([
         'message' =>$obj
      ]);   
    }
    public function show($id)
    {
      $visite = visite::with('actes','traitements')->FindOrFail($id);
      return view('visite.show', compact('visite'));
    }
}
