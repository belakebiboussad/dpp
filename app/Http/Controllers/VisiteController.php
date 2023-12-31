<?php
namespace App\Http\Controllers;
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
      $specialitesProd = specialite_produit::all();//trait
      $infossupp = infosupppertinentes::all();
      $examens = TypeExam::all();//CT,RMN
      $examensradio = examenradiologique::all();
      $codesNgap = NGAP::all();
      $consts = consts::all();
      $isHosp =true;
      $specialite = (! is_null(Auth::user()->employ->specialite)) ? $specialite = Auth::user()->employ->Specialite : Auth::user()->employ->Service->Specialite;
      $hosp = hospitalisation::with('patient')->FindOrFail($id_hosp);
      $lastVisite = $hosp->getlastVisiteWitCsts();
      $obj = $hosp->visites()->create([
        'date'=>$date,'heure'=>$date->format("H:i"),
        'pid'=>$hosp->patient->id,'date'=>$date,
        'id_employe'=>Auth::user()->employ->id
       ]); 
     
      return view('visite.add',compact('consts', 'obj','specialitesProd','infossupp','examens','examensradio','etab','codesNgap','specialite','lastVisite','isHosp'));
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
      }
      foreach ($request->consts as $key =>$const) {
         $visite->constantes()->attach($const, ['obs' =>$request->obs[$key]]);
      }
      return redirect()->action('HospitalisationController@index');
    }
    public function edit($id)
    {
      $ngaps='';  $specs='';
      $visite = visite::find($id);// $codesNgap = NGAP::all();
      $specialitesProd = specialite_produit::all();
      $specialite = (! is_null(Auth::user()->employ->specialite)) ? $specialite = Auth::user()->employ->Specialite : Auth::user()->employ->Service->Specialite;
      $ngaps = format_string(NGAP::all(),'code','code');
      $examensradio = format_string(examenradiologique::all(),'id','nom');
      $specs = format_string($specialitesProd,'id','nom'); $ngaps=  addslashes($ngaps);
      return view('visite.edit',compact('visite','specialite','ngaps','specs','examensradio'));  
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
    public function teste()//a supprimer utilisé pour teste de bootsrap
    {
      return view('teste');
    }
}
