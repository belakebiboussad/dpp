<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\specialite_exb;
use App\modeles\consultation;
use Jenssegers\Date\Date;
use App\modeles\demandeexb;
use App\modeles\Etablissement;
use App\modeles\patient;
use App\modeles\employ;
use App\modeles\service;
use Illuminate\Support\Facades\Storage;
use PDF;
use ToUtf;
use Response;
//use View;
class DemandeExbController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
        public function __construct()
        {
          $this->middleware('auth');
        }/*public function createexb($id){$specialites = specialite_exb::all();$consultation = consultation::FindOrFail($id);return view('examenbio.demande_exb', compact('specialites','consultation'));}*/
        public function index() {
          $services =service::where('type','!=',"2")->get();
          $demandesexb = demandeexb::with('consultation.patient','visite.hospitalisation.patient')->where('etat',null)->get();
          return view('examenbio.index', compact('demandesexb','services'));
        }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {  }
  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)//,$consultId
  {

    if($request->ajax())    
    { 
      if(isset($request->id_consultation))
        $demande = demandeexb::FirstOrCreate([ "id_consultation" => $request->id_consultation]);
      else
         $demande = demandeexb::FirstOrCreate([ "visite_id" => $request->visite_id]);
      $exams = json_decode($request->exams);
      $demande->examensbios()->attach($exams);
      return $demande;
    }
  }
  /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
   {
      $demande = demandeexb::FindOrFail($id);
      if(isset($demande->consultation))
      {
        $medecin =$demande->consultation->medecin ; 
        $patient = $demande->consultation->patient;    
       }
       else
      {
        $medecin = $demande->visite->medecin ;
        $patient = $demande->visite->hospitalisation->patient;          
      }
      return view('examenbio.show', compact('demande','medecin','patient'));
   }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $demande = demandeexb::FindOrFail($id);
      return view('examenbio.edit', compact('demande'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id){
      $demande = demandeexb::FindOrFail($request->demande_id);  
      if($demande->examensbios->count() == 0)
        $demande->delete();
      else
        $demande->save();
      return redirect(Route('consultations.show',$demande->id_consultation));  
    }
    public function destroy(Request $request ,$id)
    { 
      $demande = demandeexb::FindOrFail($id);
      $const_id = $demande->id_consultation;
      $demande = demandeexb::destroy($id);
      if($request->ajax())  
        return $demande;
      else
        return redirect()->action('ConsultationsController@show', $const_id);
     }
    public function detailsdemandeexb($id)
    {
      $demande = demandeexb::FindOrFail($id);
      $etablissement = Etablissement::first();
      if(isset($demande->consultation))
      {
        $medecin =  $patient = $demande->consultation->medecin;     
        $patient = $demande->consultation->patient;
      }
      else
      {
        $medecin =  $patient = $demande->visite->medecin ;   
        $patient = $demande->visite->hospitalisation->patient;   
      }
      return view('examenbio.details', compact('demande','patient','medecin','etablissement'));
    }
    public function uploadresultat(Request $request)
    {
      $request->validate([
          'resultat' => 'required',
      ]);
      $filename= "";
      $demande = demandeexb::FindOrFail($request->id_demande);
      if($request->hasfile('resultat')){
        $ext = $request->file('resultat')->getClientOriginalExtension();
        $filename = ToUtf::cleanString(pathinfo($request->file('resultat')->getClientOriginalName(), PATHINFO_FILENAME)).'_'.time().'.'.$ext;
        $file = file_get_contents($request->file('resultat')->getRealPath());
        $request->file('resultat')->storeAs('public/files',$filename);  
      }  
      $demande->update([ "etat" => 1, "resultat" =>$filename ,"crb"  => $request->crb  ]);
      return  redirect()->action('DemandeExbController@index');
    }
    public function search(Request $request)
    {
      if($request->field != "service")  
      {
        if(isset($request->value))
          $demandes = demandeexb::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->where($request->field,'LIKE', trim($request->value)."%")->get();
        else
          $demandes = demandeexb::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->where($request->field, null)->get();
      }else
      {
        $serviceID = $request->value;
        $demandes = demandeexb::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')
                               ->whereHas('consultation.medecin.Service', function($q) use ($serviceID) {
                                    $q->where('id', $serviceID);
                                })->orWhereHas('visite.medecin.Service', function($q) use ($serviceID) {
                                    $q->where('id', $serviceID);
                                })->get();
      }
      return Response::json($demandes);
    }
    public function print($id)
    {
      $demande = demandeexb::with('visite.hospitalisation.patient')->FindOrFail($id);
      $etablissement = Etablissement::first();
      if(isset($demande->id_consultation))
      {
        $patient = $demande->consultation->patient ;
        $date = $demande->consultation->date ;
        $medecin = $demande->consultation->medecin;

      }  else
      {
        $patient = $demande->visite->hospitalisation->patient ;
        $date = $demande->visite->date;
        $medecin = $demande->visite->medecin;
      }
      $filename = "demandeExamensBio-".$patient->Nom."-".$patient->Prenom.".pdf";
      $pdf = PDF::loadView('examenbio.demandePDF', compact('demande','patient','date','etablissement','medecin'));
      return $pdf->stream($filename);
    }
    public function downloadcrb($id)
    {
      $demande = demandeexb::find($id);
      $crb = $demande->crb;
      if(isset($demande->id_consultation))
      {
        $patient = $demande->consultation->patient ;
        $date = $demande->consultation->date ;
        $medecin = $demande->consultation->medecin;

      }  else
      {
        $patient = $demande->visite->hospitalisation->patient ;
        $date = $demande->visite->date;
        $medecin = $demande->visite->medecin;
      }
      $pdf = PDF::loadView('examenbio.EtatsSortie.crbPDf',compact('patient','medecin','crb'));
      $filename = "Compte-Rendu-BioPDF-".$patient->Nom."-".$patient->Prenom.".pdf";
      return $pdf->stream($filename);
    }
}