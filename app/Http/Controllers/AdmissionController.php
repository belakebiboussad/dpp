<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\colloque;
use App\modeles\DemandeHospitalisation;
use App\modeles\Lit;
use App\modeles\admission;
use App\modeles\rdv_hospitalisation;
use App\modeles\service;
use App\modeles\employ;
use App\User;
use App\modeles\dem_colloque;
use Illuminate\Support\Facades\Auth;
use App\modeles\hospitalisation;
use App\modeles\ModeHospitalisation;
use App\modeles\Etatsortie;
use Response;
class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \App\modeles\colloque
     * @return \App\modeles\DemandeHospitalisation
     * @return \App\modeles\Lit
     * @return \App\modeles\admission
     * @return \App\modeles\rdv_hospitalisation
     */
    public function __construct()
      {
          $this->middleware('auth');
      }
      public function index()
      {
              $rdvs = rdv_hospitalisation::with('bedReservation','demandeHospitalisation.bedAffectation')
                                          ->whereHas('demandeHospitalisation', function($q){
                                                 $q->where('etat', 1);
                                          })->where('etat','=',null)->where('date','=',date("Y-m-d"))->get();
              $demandesUrg = DemandeHospitalisation::with('bedAffectation')
                                                   ->whereHas('consultation', function($q){
                                                      $q->where('date', date("Y-m-d"));
                                                   })->where('modeAdmission',2)->where('etat',1)->get();
              $etatsortie = Etatsortie::where('type','1')->get();
              return view('home.home_agent_admis', compact('rdvs','demandesUrg','etatsortie'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      { 
        $now = \Carbon\Carbon::now();
        if(isset($request->id_RDV))
        {
               $demande =  DemandeHospitalisation::find($request->demande_id);
              $adm=admission::create([     
                    "id_rdvHosp"=>$request->id_RDV,
                    "demande_id"=>$request->demande_id,
                    "date"=>$now,        
                    "id_lit"=>(isset($demande->bedAffectation) ? $demande->bedAffectation->lit_id  : null)
          ]);
          $adm->rdvHosp->demandeHospitalisation->update([ "etat" =>2  ]);// "admise"
          $adm->rdvHosp->update([  "etat" => 1    ]);
        }else
        {
          if(isset($request->demande_id))
          {
            $demande = DemandeHospitalisation::FindOrFail($request->demande_id); 
            $adm=admission::create([     
                "demande_id"=>$request->demande_id,
                "date"=>$now,        
                "id_lit"=>$demande->bedAffectation->lit_id
            ]);
            $demande->update([  "etat" =>2  ]);
            }
        }
        return redirect()->action('AdmissionController@index');
      }  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)   {  }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* public function edit(Request $request, $id)   {       $adm =  admission::find($id);   }*/

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy(Request $request, $id) {
      $adm = admission::findOrFail($id);
        if($adm->demandeHospitalisation->getModeAdmissionID($adm->demandeHospitalisation->modeAdmission) != 2)
        {
              $adm->rdvHosp->update(['etat'=>0]);//redonner un rendez-vous
              $adm->demandeHospitalisation->setEtatAttribute(5);
       }else
               $adm->demandeHospitalisation->setEtatAttribute(null);
        $adm->demandeHospitalisation->save();
        $adm->demandeHospitalisation->bedAffectation->lit->update(['affectation'=>0]);
        $adm->demandeHospitalisation->bedAffectation()->delete();// liberer le lit
        $adm->delete();
        if($request->ajax())   
          return Response::json($adm);   
        else   
          return redirect()->action('HospitalisationController@create');
   } 
    public function sortir()
    {
      $hospitalistions = hospitalisation::with('admission.demandeHospitalisation')->whereHas('admission', function ($q) {
                                            $q->where('etat',null);
                                        })->where('etat','1')->where('Date_Sortie' , date('Y-m-d'))->get();
      //dd($hospitalistions);
      $etatsortie = Etatsortie::where('type','2')->get();//etets de sortie por hospital
      return view('admission.sorties', compact('hospitalistions','etatsortie')); 
    }
    public function updateAdm(Request $request, $id)
    {
           if($request->ajax())  
          {
                $adm =  admission::find($id);
                $adm->update([ 'etat'=>1 ]);
                return Response::json($adm ); 
          }
     }
     public function getSortiesAdmissions(Request $request)
     {
        if($request->ajax())  
        { 
          if($request->field != 'Date_Sortie')
            if($request->value != "0")   
              $adms = admission::with('hospitalisation','demandeHospitalisation.consultation.patient','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation.lit.salle.service')
                               ->where(trim($request->field),'LIKE','%'.trim($request->value)."%")->get();
            else
              $adms = admission::with('hospitalisation','demandeHospitalisation.consultation.patient','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation.lit.salle.service')
                                ->whereHas('hospitalisation',function($q){
                                   $q->where('etat','=',"1");
                                })->where('etat','=',null)->get();
          else
          {
            $adms = admission::with('hospitalisation','demandeHospitalisation.consultation.patient','demandeHospitalisation.Service','demandeHospitalisation.bedAffectation.lit.salle.service')
                              ->whereHas('hospitalisation',function($q) use ($request){
                                $q->where(trim($request->field),'LIKE','%'.trim($request->value)."%");  
            })->get();
          }
          return Response::json($adms);
        }
    }
    public function getDetails($id)
    { 
      $adm =  admission::find($id);
      $medecins = employ::where('service',Auth::user()->employ->service)->orderBy('nom')->get();
      $modesHosp = ModeHospitalisation::all();  
      $to = $from =  \Carbon\Carbon::now()->format('Y-m-d');
      $nbr=0;
      if($adm->demandeHospitalisation->getModeAdmissionID($adm->demandeHospitalisation->modeAdmission) !=2)
      {
                $toDate = \Carbon\Carbon::createFromFormat('Y-m-d', $adm->rdvHosp->date_Prevu_Sortie);
                $to =  \Carbon\Carbon::parse($toDate)->format('Y-m-d');
                $fromDate = \Carbon\Carbon::createFromFormat('Y-m-d', $adm->rdvHosp->date);
                $from =  \Carbon\Carbon::parse($fromDate)->format('Y-m-d');
                $nbr = $toDate->diffInDays($fromDate);
      }
      $view = view("admission.ajax_adm_detail",compact('adm','medecins','modesHosp','from','nbr','to'))->render();
      return response()->json(['html'=>$view]);
    }
}