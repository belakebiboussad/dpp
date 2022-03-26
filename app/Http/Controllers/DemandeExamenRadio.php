<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\infosupppertinentes;
use App\modeles\TypeExam;
use App\modeles\examenradiologique;
use App\modeles\demandeexr;
use App\modeles\Demandeexr_Examenradio;
use App\modeles\Etablissement;
use App\modeles\service;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use PDF;
use ToUtf;
use Response;
use Auth;
class DemandeExamenRadio extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $services =service::where('type','!=',"2")->get();
      $demandesexr = demandeexr::with('consultation','visite')->where('etat',null)->get();
      return view('examenradio.index', compact('demandesexr','services')); 
    }
    public function details($id)
    {
      $demande = demandeexr::FindOrFail($id);
      $etablissement = Etablissement::first();
/* if(isset($demande->consultation)){ $medecin =  $patient = $demande->consultation->medecin ;
 $patient = $demande->consultation->patient; $date =$demande->consultation->date ;}else
{$medecin =  $patient = $demande->visite->medecin ;$patient = $demande->visite->hospitalisation->patient;   
  $date = $demande->visite->date; }return view('examenradio.details', compact('demande','patient','medecin','etablissement','date'));*///dd($demande->examensradios);
      if(isset($demande->id_consultation))
      {
          $obj = $demande->consultation;
          $patient = $demande->consultation->patient;
      }else
      {
        $obj = $demande->visite;
         $patient = $demande->visite->hospitalisation->patient;
      }
      return view('examenradio.details', compact('demande','obj','patient','etablissement'));   
    }
    public function upload(Request $request)
    {
      $ex = Demandeexr_Examenradio::FindOrFail($request->exam_id);
      $filename= ""; $filename= ""; $isImg = 0;
      if($request->hasfile('resultat')){
        $ext = $request->file('resultat')->getClientOriginalExtension();
        $filename = pathinfo($request->file('resultat')->getClientOriginalName(), PATHINFO_FILENAME);
        if($ext == "")
          $filename = $filename.'_'.time();
        else
          $filename = $filename.'_'.time().'.'.$ext;
        $request->file('resultat')->storeAs('public/files',$filename);  
      }
      $ex->update([  "etat" =>1, "resultat"=>$filename]);
     /* $extension = request("resultat")->getClientOriginalExtension();   if(in_array($extension, config('constants.imageExtensions')))   $isImg = 1;*/
      return Response::json(['exId'=>$ex->id,'fileName'=>$filename,'isImg'=>$isImg]);
    }
    public function examCancel(Request $request)
    {
      /*
      $demande = demandeexr::with('examensradios','consultation','visite')->FindOrFail($request->id_demandeexr);
      foreach ($demande->examensradios as $key => $exam)
      {
        if( $exam->pivot->id_examenradio == $request->id_examenradio)
        {
          $exam->pivot->etat = 0;
          $exam->pivot->observation = $request->observation;
          $exam->pivot->save();
        }
      }
      return Response()->json([ "rowID" => $request->id_examenradio, ]);
      */
      $ex = Demandeexr_Examenradio::FindOrFail($request->exmId);
      if($ex->Crr)
        $ex->Crr()->delete();
      $ex->update(['observation'=>$request->observation,"etat"=>0]);
      return Response()->json($ex->id);
    }
    public function update(Request $request, demandeexr $demande)
    {
              $demande = demandeexr::FindOrFail($request->demande_id);  
               if(Auth::user()->is(12))
                {
                      foreach ($demande->examensradios as $key => $exam)
                      {
                              if($exam->getEtatID($exam->etat) ==="")
                                      return redirect()->action('DemandeExamenRadio@index');
                      } 
                      $demande->update([ "etat" => 1 ]);$demande->save();
                      return redirect()->action('DemandeExamenRadio@index');
               }else
               {
                      if($demande->examensradios->count() == 0)
                             $demande->delete();
                       else
                       {
                              $demande->InfosCliniques = $request->infosc;  $demande->Explecations = $request->explication;
                              $demande->save();
                               $demande->infossuppdemande()->sync($request->infos);
                      }
                      return redirect(Route('consultations.show',$demande->id_consultation));   
               }
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
      public function store(Request $request, $consultID)
      {
         $demande = demandeexr::FirstOrCreate([
                 "Date" => Date::now(),
                 "InfosCliniques" => $request->infosc,
                 "Explecations" => $request->explication,
                 "id_consultation" => $consultID,
         ]);
             $examsImagerie = json_decode ($request->ExamsImg);
              foreach ($examsImagerie as $key => $value) {       
                $demande ->examensradios()->attach($value->acteImg, ['examsRelatif' => $value->types]);
              }
             if(isset($request->infos))
             {
                    foreach ($request->infos as $id_info) {
                         $demande->infossuppdemande()->attach($id_info);
                    }
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
             $demande = demandeexr::FindOrFail($id);
               if(isset($demande->consultation))
              {
                $patient = $demande->consultation->patient;
                $obj = $demande->consultation;
              } else
              {
                  $patient = $demande->visite->hospitalisation->patient;
                  $obj = $demande->visite;
              }
              return view('examenradio.show', compact('demande','obj','patient'));
            }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function edit($id) {
        $demande = demandeexr::FindOrFail($id);
        $infossupp = infosupppertinentes::all();
        $examens = TypeExam::all();//CT,RMN
        $examensradio = examenradiologique::all();//pied,poignet
        return view('examenradio.edit', compact('demande','infossupp','examensradio','examens')); 
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
    public function destroy(Request $request,$id){
      
      $demande = demandeexr::FindOrFail($id);
      $demande = demandeexr::destroy($id);
       if($request->ajax())  
      { 
        return Response::json($demande);
      }else
      {
        $consult_id = $demande->consultation;
        return redirect()->action('ConsultationsController@show',$consult_id);
      }
    }
     public function search(Request $request)
    {
      if($request->field != "service")  
      {
        if(isset($request->value))
             $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')->where($request->field,'LIKE', trim($request->value)."%")->get();
        else
             $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')->where($request->field, null)->get();
      }else
      {
        $serviceID = $request->value;
        $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')
                           ->whereHas('consultation.medecin.Service', function($q) use ($serviceID) {
                                $q->where('id', $serviceID);
                            })->orWhereHas('visite.hospitalisation.medecin.Service', function($q) use ($serviceID) {
                                $q->where('id', $serviceID);
                            })->get();
      }
      return Response::json($demandes);
    }
    public function delResult(Request $request)
    {
      $ex = Demandeexr_Examenradio::FindOrFail($request->examId);
      if(isset($ex->resultat))
        Storage::delete('public/files/' . $ex->resultat);
      $ex ->update([   "etat" => null,  "resultat" => null ]);
        return Response::json($ex->id);
    }
     public function examDestroy($id)
      {
               $ex = Demandeexr_Examenradio::FindOrFail($id);
               $ex->delete();
               return Response::json($ex);   
      }
    public function print($id)
    {
      $demande = demandeexr::FindOrFail($id); 
      $etablissement = Etablissement::first();
      if(isset($demande->consultation))
      {
        $patient = $demande->consultation->patient;
        $date = $demande->consultation->date;
      }
      else
      {
        $patient = $demande->visite->hospitalisation->patient;
        $date = $demande->visite->date;
      }
      $filename = "Demande-Examens-Radio-".$patient->Nom."-".$patient->Prenom.".pdf";
      $pdf = PDF::loadView('examenradio.demandePDF', compact('demande','patient','date','etablissement'));
      return $pdf->stream($filename);
    }
}