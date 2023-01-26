<?php

namespace App\Http\Controllers;
use App\modeles\patient;
use App\modeles\consultation;
use App\modeles\Constantes;
use App\modeles\constante;
use App\modeles\antecedant;//use App\modeles\codesim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\modeles\Etablissement;
use App\modeles\DemandeHospitalisation;
use App\modeles\examenbiologique;
use App\modeles\examenimagrie;
use App\modeles\Demande_Examenradio;
use App\modeles\examenanapath;
use App\modeles\hospitalisation;
use App\modeles\service;
use App\modeles\examen_cliniqu;
use App\modeles\ordonnance;
use App\modeles\employ;
use App\modeles\demandeExamImag;
use App\modeles\demandeexb;
use App\User;
use App\modeles\rdv;
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
use App\modeles\Allergie;
use App\modeles\CIM\maladie;
use Carbon\Carbon;
use Validator;
use Response;
class ConsultationsController extends Controller
{
    protected $DemandeHospCTRL;
    public function __construct(LettreOrientationController $LettreOrientationCtrl)
    {
      $this->middleware('auth');
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
    public function edit(consultation $consultation)
    {
      $etab = Etablissement::first();
      if(isset(Auth::user()->employ->specialite) && (Auth::user()->employ->specialite != null))
        $specialite = Auth::user()->employ->Specialite;
      else
        $specialite = Auth::user()->employ->Service->Specialite;
     $view =  view("consultations.inc_consult",compact('consultation','etab','specialite'))->render();
      return $view; 
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
      public function create(Request $request, $pid)
      {
        $date = Carbon::now(); $etab = Etablissement::first();$employe = Auth::user()->employ; 
        if(isset($employe->specialite))
          $specialite = $employe->Specialite;
        else
          $specialite = $employe->Service->Specialite;
        $modesAdmission = config('settings.ModeAdmissions') ;
        $infossupp = infosupppertinentes::all();//$examens = TypeExam::all();//CT,RMN
        $examensradio = examenradiologique::all();//pied,poignet
        $patient = patient::FindOrFail($pid);
        $chapitres = chapitre::all();$services = service::all();$apareils = appareil::all();
        $meds = User::whereIn('role_id', [1,13,14])->get();
        $specialites = Specialite::where('type','<>',null)->orderBy('nom')->get();
        $consult =new consultation;$consult->date=$date;
        $consult->employ_id=Auth::User()->employee_id;$consult->pid = $pid; 
        $consult->id_lieu =$etab->id;$consult->save();
        $allergies = Allergie::all();$deseases = maladie::contagius();
        return view('consultations.createObj',compact('consult','patient','employe','etab','chapitres','apareils','meds','specialites','modesAdmission','services','infossupp','examensradio','specialite','allergies','deseases'));
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
        $constvalue =  collect();$exam;
        $etab = Etablissement::first(); 
        $validator = Validator::make($request->all(), [
                'motif' => 'required',
                'resume' => 'required',
         ]);
        if($validator->fails())
           return redirect()->back()->withErrors($validator)->withInput();
        if(isset(Auth::user()->employ->specialite) && (!is_null(Auth::user()->employ->specialite)))
          $specialite = Auth::user()->employ->Specialite;
        else
          $specialite = Auth::user()->employ->Service->Specialite;
        $consult = consultation::FindOrFail($request->id);
        $consult -> update([
              "motif"=>$request->motif,
              "histoire_maladie"=>$request->histoirem,
              "Diagnostic"=>$request->diagnostic,
              "Resume_OBS"=>$request->resume,
              "lettreorientaioncontent"=>$request->lettreorientaioncontent,
              "id_code_sim"=>$request->codesim,
              "id_lieu"=>$etab->id
        ]);
        foreach($consult->patient->rdvs as $rdv)
        {
          if( $rdv->date->format('Y-m-d')  == $consult->date)
            $rdv->update(['etat'=>1]);
        }
        if(!is_null($specialite->consConst)) 
        {
          foreach(json_decode($specialite->consConst) as $const)
          {
            $c = Constante::FindOrFail($const);
            if( $c->normale  !=  $request->input($c->nom)  && ($c->min !=  $request->input($c->nom)) && (! is_null($request->input($c->nom))))
              $constvalue->put($c->nom, $request->input($c->nom));
          }
        }
        if($constvalue->count()>0)
        {
          $exam = $consult->examensCliniques()->create($request->all());
          $cst = $exam->Consts()->create($constvalue->toArray());
        }
        if(!is_null($request->listMeds))
        {
          $ord =$consult->ordonnances()->create();
          foreach (json_decode($request->listMeds) as $key => $trait) {
            $ord->medicamentes()->attach($trait->med,['posologie' => $trait->posologie]);     
          }
        }
        if((is_null($consult->demandeexmbio)) && (!is_null($request->exmsbio)))
        {
          $db = $consult->demandeexmbio()->create();
          $db->examensbios()->attach($request->exmsbio);
        }
        if((is_null($consult->demandExmImg)) && (!empty($request->ExamsImg)))
        { 
          $dr = $consult->demandExmImg()->create([
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
        return redirect(Route('patient.show',$request->patient_id));
       }
    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\consultation  $consultation
     * @return \Illuminate\Http\Response
     */
      public function show(consultation $consultation)
      { 
        $specialites = Specialite::where('type','<>',null)->orderBy('nom')->get();
        if(isset(Auth::user()->employ->specialite) && (Auth::user()->employ->specialite != null))
                  $specialite = Auth::user()->employ->Specialite;
         else
                 $specialite = Auth::user()->employ->Service->Specialite;
         return view('consultations.show', compact('consultation','specialite','specialites'));
      }
      public function destroy(Request $request, $id)
      { 
        $consult = consultation::find($id);
        $consult->delete();
        if($request->ajax())  
         return $consult;
        else
          return redirect()->action('PatientController@show',$id); 
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
        $service_id = Auth::user()->employ->service_id;
        if($request->ajax())  
        {    
          $field= $request->field; $q= $request->value;      
          if($field == 'date')
           return $consults =consultation::with('patient','medecin.Specialite','medecin.Service.Specialite')
                            ->whereHas('medecin.Service',function($query) use($service_id){ 
                                  $query->where('id',$service_id);
                            })->where($field, $q)->get();
          else
            return $consults =consultation::with('patient','medecin.Specialite','medecin.Service.Specialite')
                            ->whereHas('medecin.Service',function($query) use($service_id){ 
                                $query->where('id',$service_id);
                            })->whereHas('patient',function($query) use ($request){
                                $query->where($request->field,'LIKE', "%$request->value%");  
                            })->get();
            //return $consults;
        }
       }
}