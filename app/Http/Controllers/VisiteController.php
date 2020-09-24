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
      return view('visite.choix_patient_visite',compact('patients')); //   return view('visite.choix_patient_visite');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_hosp)
    {
      $hosp = hospitalisation::FindOrFail($id_hosp);//$patient = (hospitalisation::FindOrFail($id_hosp))->admission->demandeHospitalisation->consultation->patient;
      $patient = $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient;
      $date = Carbon\Carbon::now();//$date = Date::Now();
      $visite =new visite;
      $visite->date=$date;
      $visite->heure=$date->format("H:i");
      $visite->id_hosp=$id_hosp;
      $visite->id_employe=Auth::User()->employee_id;
      $visite->save();
      return view('visite.create',compact('hosp','patient'))->with('id',$visite->id);
    }
 /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     return redirect()->action('HospitalisationController@index');
    }
    public function storebouzidi(Request $request,$id)
    {
      $date = Date::Now();
      $v =new visite;
	    $v->date=$date;
	    $v->heuree=$request->heurevisite;
	    $v->id_hosp=$id;
	    $v->id_employe=Auth::User()->employee_id;
      $v->save();
      $cpt=$request->cpt;
      /*****************************/                  
      $c=new consigne;
      $c->consigne=$request->cons[0];
      $c->id_visite=$v->id;
      $c->app='Non';
      $c->duree=$request->dur[0];
      $c->save();
      /************************************/
      if (isset($request->p[0][0]) && !empty($request->p[0][0]))
      {
        if (($request->p[0][0])=='Matin')
        {              
          $p=new periodeconsigne; 
          $p->id_consigne=$c->id;
          $p->id_periode=1;
          $p->save();
        }
      }
                  if (isset($request->p[1][0]) && !empty($request->p[1][0]))
                  {

                  if(($request->p[1][0])=='Midi')
                    {  
                        
                    $p=new periodeconsigne; 
                      $p->id_consigne=$c->id;
                     $p->id_periode=2;
                     $p->save();
                     }
                 }
                  if (isset($request->p[2][0]) && !empty($request->p[2][0]))
                  {
                 
                   if(($request->p[2][0])=='Soir')
                      {
                       
                     $p=new periodeconsigne; 
                     $p->id_consigne=$c->id;
                     $p->id_periode=3;
                     $p->save();
                      }
                  }
       
            for($i=1;$i<$cpt;$i++)
                   {
                   	 $c=new consigne;
                     $c->consigne=$request->cons[$i];
                     $c->id_visite=$v->id;
                     $c->app='Non';
                     $c->duree=$request->dur[$i];
                     $c->save(); 
                        
                 if (isset($request->p[0][$i]) && !empty($request->p[0][$i]))
                  { 
                  
                     
                    if (($request->p[0][$i])=='Matin')
                    {
                       
                   $p=new periodeconsigne; 
                     $p->id_consigne=$c->id;
                      $p->id_periode=1;
                      $p->save();
                      }
                  }
                   if (isset($request->p[1][$i]) && !empty($request->p[1][$i]))
                  {

                  if(($request->p[1][$i])=='Midi')
                    {  
                        
                    $p=new periodeconsigne; 
                      $p->id_consigne=$c->id;
                     $p->id_periode=2;
                     $p->save();
                     }
                 }
                  if (isset($request->p[2][$i]) && !empty($request->p[2][$i]))
                  {
                 
                   if(($request->p[2][$i])=='Soir')
                      {
                       
                     $p=new periodeconsigne; 
                     $p->id_consigne=$c->id;
                     $p->id_periode=3;
                     $p->save();
                      }
                  }
                  

                       }
       
        return redirect('/choixpatvisite')->with('info','Visite ajoutée avec succès!'); //  return redirect()->action('ConsultationsController@create',['id'=>$id]);
       
    }
    public function edit($id)
    {
      $hosp = hospitalisation::find($id);
      return view('visite.edit',compact('hosp'));  
    }
   
	//
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
     
    }
}
