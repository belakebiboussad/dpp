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
use App\modeles\TypeExam;
use App\modeles\demandeexb;
use App\modeles\demandeexr;
use App\modeles\Etablissement;
use App\modeles\prescription_constantes;
use App\modeles\Constontes;
use App\modeles\Constante;
use App\modeles\consts;
use App\modeles\NGAP;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;
use App\modeles\Specialite;
use App\Utils\ArrayClass;//use DB;
use Carbon;
class VisiteController extends Controller
{
    //
	    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }  
    public function index()
    {
      return redirect()->action('HospitalisationController@index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create($id_hosp)
      {
        $prescredconst =array();
        $date = Carbon\Carbon::now();
        $etablissement = Etablissement::first(); 
        $hosp = hospitalisation::FindOrFail($id_hosp);
        $lastViste = $hosp->getlastVisite();
        $patient = $hosp->admission->demandeHospitalisation->consultation->patient;
        $employe = Auth::user()->employ;
        $visite =new visite;
        $visite->date=$date;
        $visite->heure=$date->format("H:i");
        $visite->id_hosp=$id_hosp;
        $visite->id_employe=Auth::User()->employee_id;
        $specialitesProd = specialite_produit::all();
        $specialitesExamBiolo = specialite_exb::all();
        $infossupp = infosupppertinentes::all();
        $examens = TypeExam::all();//CT,RMN
        $examensradio = examenradiologique::all();
        $codesNgap = NGAP::all();
        $specialite = Specialite::findOrFail($employe->specialite);
        $visite->save();
        $consts = consts::all();
        return view('visite.add',compact('consts', 'hosp', 'patient', 'employe','specialitesProd','specialitesExamBiolo','infossupp','examens','examensradio','etablissement','codesNgap','specialite','lastViste'))->with('id',$visite->id);
    }
 /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //Enregistrer Examen Complentaire
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
        $visite->demandExmImg()->save($demandeExImg);
        if(isset($request->infos))
        {
          foreach ($request->infos as $id_info) {
            $demandeExImg->infossuppdemande()->attach($id_info);
          }
        }
        foreach (json_decode ($request->ExamsImg) as $key => $value) {       
           $demandeExImg ->examensradios()->attach($value->acteImg, ['examsRelatif' => $value->types]);
        }
      }// si(observ change et constante change) on crée une prescription
      if(ArrayClass::diffRecursive($visite->hospitalisation->getlastVisite()->prescreptionconstantes->ConstIds->toArray(),$request->consts) ||( $visite->hospitalisation->getlastVisite()->prescreptionconstantes->observation != $request->observation))
      {
        $prescription_constantes = prescription_constantes::FirstOrCreate([
          "visite_id" => $visite->id,
          "observation" => $request->observation
        ]);
        if($request->consts != null)
          $prescription_constantes->constantes()->attach($request->consts);
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
      $visite = visite::destroy($id);
      return redirect()->action('VisiteController@index');
    }
    public function show($id)
    {
      $visite = visite::with('actes','traitements')->FindOrFail($id);
      return view('visite.show', compact('visite'));
    }
}
