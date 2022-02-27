<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\infosupppertinentes;
use App\modeles\TypeExam;
use App\modeles\examenradiologique;
use App\modeles\demandeexr;
use App\modeles\Etablissement;
use App\modeles\service;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use PDF;
use ToUtf;
use Response;
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
    public function details_exr($id)
    {
      $demande = demandeexr::FindOrFail($id);
      $etablissement = Etablissement::first();
      if(isset($demande->consultation))
      {
        $medecin =  $patient = $demande->consultation->docteur ;     
        $patient = $demande->consultation->patient;
        $date =$demande->consultation->date ;
      }else
      {
        $medecin =  $patient = $demande->visite->medecin ;   
        $patient = $demande->visite->hospitalisation->patient;
        $date = $demande->visite->date;
      }
      return view('examenradio.details', compact('demande','patient','medecin','etablissement','date'));
    }
    public function upload(Request $request)
    {
      $demande = demandeexr::with('examensradios','consultation','visite')->FindOrFail($request->id_demandeexr);
      if($request->TotalFiles >0) { 
        if(isset($demande->visite))
          $patient = $demande->visite->hospitalisation->patient;
        else
          $patient = $demande->consultation->patient;
        foreach ($demande->examensradios as $key => $exam)
        {
          if( $exam->pivot->id_examenradio == $request->id_examenradio)
          {
                for ($x = 0; $x < $request->TotalFiles; $x++) 
                {
                        if ($request->hasFile('files'.$x)) 
                        {
                              $file = $request->file('files'.$x);
                              $namefile = $file->getClientOriginalName();
                              $file->move(public_path().'/Patients/'.$patient->id.'/examsRadio/'.$request->id_demandeexr.'/'.$request->id_examenradio.'/', $namefile);
                              $data[] = $namefile;
                        }
                 }
                $exam->pivot->resultat = json_encode($data,JSON_FORCE_OBJECT);
                $exam->pivot->etat = 1;
                $exam->pivot->save();
          }
        }
        return Response()->json([ "rowID" => $request->id_examenradio, ]);
      }//if
    }
      public function examCancel(Request $request)
      {
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
      }
      public function update(Request $request, demandeexr $demande)
      {
        $demande = demandeexr::FindOrFail($request->id_demande);
        foreach ($demande->examensradios as $key => $exam)
        {     
               if(!isset($exam->pivot->etat))
                      return redirect()->action('DemandeExamenRadio@index');
        } 
        $demande->update([
                "etat" => "1"
         ]);
         $demande->save();
        return redirect()->action('DemandeExamenRadio@index');
      }
      public function createexr($id)
      {
            $infossupp = infosupppertinentes::all();
            $examens = TypeExam::all();
            $examensradio = examenradiologique::all();
           $consultation = consultation::FindOrFail($id);
           return view('examenradio.demande_exr', compact('consultation','infossupp','examens','examensradio'));
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
                   $date =$demande->consultation->date ;
             }
            else
            {
                    $patient = $demande->visite->hospitalisation->patient;
                    $date = $demande->visite->date;
            }
            return view('examenradio.show', compact('demande','patient','date'));
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
             $demandes = demandeexr::with('consultation.patient','consultation.docteur.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')->where($request->field,'LIKE', trim($request->value)."%")->get();
        else
             $demandes = demandeexr::with('consultation.patient','consultation.docteur.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')->where($request->field, null)->get();
      }else
      {
        $serviceID = $request->value;
        $demandes = demandeexr::with('consultation.patient','consultation.docteur.Service','visite.hospitalisation.patient','visite.hospitalisation.medecin.Service')
                           ->whereHas('consultation.docteur.Service', function($q) use ($serviceID) {
                                $q->where('id', $serviceID);
                            })->orWhereHas('visite.hospitalisation.medecin.Service', function($q) use ($serviceID) {
                                $q->where('id', $serviceID);
                            })->get();
      }
      return Response::json($demandes);
    }
    public function print($id)//imprime
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
      $pdf = PDF::loadView('examenradio.demande_exr', compact('demande','patient','date','etablissement'));
      return $pdf->stream($filename);
    }
}