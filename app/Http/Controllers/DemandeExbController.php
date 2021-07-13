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
        }
        public function createexb($id)
        {
          $specialites = specialite_exb::all();
          $consultation = consultation::FindOrFail($id);
          return view('examenbio.demande_exb', compact('specialites','consultation')); 
        }
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
  public function store(Request $request,$consultId)
  {
    $demande = demandeexb::FirstOrCreate([  
         "id_consultation" => $consultId,
    ]);
   foreach($request->exm as $id_exb) {
                $demande->examensbios()->attach($id_exb);
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
          $medecin =  $patient = $demande->consultation->docteur ;     
         }
         else
        {
          $medecin =  $patient = $demande->visite->medecin ;//dd($demande->visite->hospitalisation->patient);
        }
        return view('examenbio.show', compact('demande','medecin' ));
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
     public function update(Request $request, $id)
     {
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
      $demande = demandeexb::FindOrFail($id);
      $consult_id = $demande->consultation;
      $demande = demandeexb::destroy($id);
      return redirect()->action('ConsultationsController@show',$consult_id);
    }
      public function detailsdemandeexb($id)
      {
                $demande = demandeexb::FindOrFail($id);
                $etablissement = Etablissement::first();
                if(isset($demande->consultation))
                {
                  $medecin =  $patient = $demande->consultation->docteur ;     
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
      $demande = demandeexb::FindOrFail($request->id_demande);
      $filename = $request->file('resultat')->getClientOriginalName();
      $filename =  ToUtf::cleanString($filename);
      $file = file_get_contents($request->file('resultat')->getRealPath());
      Storage::disk('local')->put($filename, $file);
      $demande->update([
          "etat" => "1",
          "resultat" =>$filename ,
          "crb"  => $request->crb
      ]);
      return  redirect()->action('DemandeExbController@index');//return redirect()->route('homelaboexb');
    }
    public function search(Request $request)
    {
      if($request->field != "service")  
      {
        if(isset($request->value))
          $demandes = demandeexb::with('consultation.patient','consultation.docteur.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')->where($request->field,'LIKE', trim($request->value)."%")->get();
        else
          $demandes = demandeexb::with('consultation.patient','consultation.docteur.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')->where($request->field, null)->get();
      }else
      {
        $serviceID = $request->value;
        $demandes = demandeexb::with('consultation.patient','consultation.docteur.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')
                               ->whereHas('consultation.docteur.Service', function($q) use ($serviceID) {
                                    $q->where('id', $serviceID);
                                })->orWhereHas('visite.hospitalisation.medecin.Service', function($q) use ($serviceID) {
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
        $date = $demande->consultation->Date_Consultation ;
        $medecin = $demande->consultation->docteur;

      }  else
      {
        $patient = $demande->visite->hospitalisation->patient ;
        $date = $demande->visite->date;
        $medecin = $demande->visite->medecin;
      }
      $filename = "Examens-Bio-".$patient->Nom."-".$patient->Prenom.".pdf";
      $pdf = PDF::loadView('examenbio.demande_exb', compact('demande','patient','date','etablissement','medecin'));
      return $pdf->stream($filename);
    }
    public function downloadcrb($id)
    {
      $demande = demandeexb::find($id);
      $crb = $demande->crb;// $etablissement = Etablissement::first();
      if(isset($demande->id_consultation))
      {
        $patient = $demande->consultation->patient ;
        $date = $demande->consultation->Date_Consultation ;
        $medecin = $demande->consultation->docteur;

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
    public function crbClientDownload(Request $request)
    {
      $crb = $request->crb;
      $patient = patient::FindOrFail($request->pid);
      $medecin = employ::FindOrFail($request->mid);
      //return($crb);
      $pdf = PDF::loadView('examenbio.EtatsSortie.crbClientPDf',compact('patient','medecin','crb'));
      $filename = "Compte-Rendu-Bioff-".$patient->Nom."-".$patient->Prenom.".pdf";
      // return ($filename);
      //return $pdf->stream($filename);
      //return $pdf->download($filename); 

      //return view('examenbio.EtatsSortie.crbClientPDf',compact('patient','medecin','crb'))->render();
      // $view = view("examenbio.EtatsSortie.crbClientPDf",compact('patient','medecin','crb'))->render();
      // return response()->json(['html'=>$view]);
      // $pdf->render();
      $pdf->save(storage_path().'_filename.pdf');
      // Finally, you can download the file using download function

    return $pdf->download('customers.pdf');
      
    }

}