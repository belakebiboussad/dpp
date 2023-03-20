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
use App\modeles\medcamte;
use App\modeles\specialite_exb;
use App\modeles\infosupppertinentes;
use App\modeles\examenradiologique;
use App\modeles\TypeExam;
use App\modeles\demandeexb;
use App\modeles\demandeexr;
use App\modeles\Demande_Examenradio;
use App\modeles\Etablissement;
use App\modeles\prescription_constantes;
use App\modeles\Constontes;
use App\modeles\Constante;
use App\modeles\consts;
use App\modeles\NGAP;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\modeles\Specialite;
use Carbon;
class VisiteController extends Controller
{   /**
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
      $prescredconst = [];
      $date = Carbon\Carbon::now();
      $etab = Etablissement::first(); 
      $employe = Auth::user()->employ;
      $specialite = (! is_null($employe->specialite)) ? $specialite = $employe->Specialite : $employe->Service->Specialite;
      $hosp = hospitalisation::with('patient')->FindOrFail($id_hosp);
      $lastVisite = $hosp->getlastVisiteWitCstPresc();
      $obj = $hosp->visites()->create([
         'date'=>$date,
        'heure'=>$date->format("H:i"),
        'pid'=>$hosp->patient->id,
        'date'=>$date,
        'id_employe'=>$employe->id
       ]); 
      $specialitesProd = specialite_produit::all();//trait
      $infossupp = infosupppertinentes::all();
      $examens = TypeExam::all();//CT,RMN
      $examensradio = examenradiologique::all();
      $codesNgap = NGAP::all();
      $consts = consts::all();//'patient',
      return view('visite.add',compact('consts', 'obj' , 'employe','specialitesProd','infossupp','examens','examensradio','etab','codesNgap','specialite','lastVisite'));//->with('id',$visite->id);
    }
 /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
      $visite = visite::find($request->id); 
      if((!isset($visite->demandeexmbio)) && (! is_null($request->exmsbio)))
      {
        $db = $visite->demandeexmbio()->create();
        $db->examensbios()->attach($request->exmsbio);
      }
      if((is_null($visite->demandExmImg)) && (!empty($request->ExamsImg)))
      {
        $dr = $visite->demandExmImg()->create([
              'InfosCliniques'=>$request->infosc,
              'Explecations'  =>$request->explication,  
        ]);
        if(isset($request->infos))
            $dr->infossuppdemande()->attach($request->infos);
       foreach (json_decode ($request->ExamsImg) as $key => $id)
        {
          $dr->examensradios()->create([
            'exm_id' =>$id,
            'type_id' => (json_decode ($request->types))[$key]
          ]);
        }  
      }      //à revoire si(observ change et constante change) on crée une prescription
      if(!is_null($visite->hospitalisation->getlastVisiteWitCstPresc()))
        $VisconstIds = $visite->hospitalisation->getlastVisiteWitCstPresc()->prescreptionconstantes->constantes->pluck('id')->toArray();
      if(!is_null($request->consts))
      {     
        $reqintArray = array_map('intval', $request->consts);
      if( ($reqintArray  != $VisconstIds) || ($request->observation != $visite->hospitalisation->getlastVisiteWitCstPresc()->prescreptionconstantes->observation))
        $visite->prescreptionconstantes()->create(["observation" => $request->observation])->constantes()->attach($request->consts); 
      }
      return redirect()->action('HospitalisationController@index');
    }
    public function edit($id)
    {//$actes$visite->actes()->active()->get()->toJson(); 
      $ngaps='';  $specs='';
      $visite = visite::with('actes')->find($id); 
      $codesNgap = NGAP::all(); //$meds = medcamte::all();
      $specialitesProd = specialite_produit::all();
      $ngaps = format_string($codesNgap,'code','code');
      $specs = format_string($specialitesProd,'id','nom');
      $ngaps=  addslashes($ngaps);
      return view('visite.edit5',compact('visite','ngaps','specs'));  
    }
    public function destroy($id)
    {
      $visite = visite::destroy($id);
      return redirect()->action('VisiteController@index');
    }
    public function show($id)
    {
      $visite = visite::with('actes','traitements','patient')->FindOrFail($id);
      return view('visite.show', compact('visite'));
    }
}
