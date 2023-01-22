<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\infosupppertinentes;
use App\modeles\TypeExam;
use App\modeles\examenradiologique;
use App\modeles\demandeexr;
use App\modeles\Demande_Examenradio;
use App\modeles\Etablissement;
use App\modeles\service;
use App\modeles\Specialite;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use PDF;
use ToUtf;
use Response;
use Auth;
use DNS1D;
use File;
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
    public function index(Request $request)
    {
      if($request->ajax())  
      {
        $q = $request->value ; $field = $request->field;
        if($request->field != "service")  
        {
          if(isset($request->value))
            $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->where($field,'LIKE', "$q%")->get();
          else
            $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->whereNull($field)->get();
        }else
        {
          $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')
                          ->whereHas('consultation.medecin.Service', function($query) use ($q) {
                                  $query->where('id', $q);
                          })->orWhereHas('visite.medecin.Service', function($query) use ($q) {
                                  $query->where('id', $q);
                              })->get();
        }
        return $demandes;
      }else
      {
        $services =service::where('type',0)->orwhere('type',1)->get();
        $demandesexr = demandeexr::with('consultation','visite')->whereNull('etat')->get();
        return view('examenradio.index', compact('demandesexr','services')); 
      }
    }
/* public function search(Request $request){if($request->field != "service"){if(isset($request->value))
$demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->where($request->field,'LIKE', trim($request->value)."%")->get();else$demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->where($request->field, null)->get();}else{$serviceID = $request->value;$demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->whereHas('consultation.medecin.Service', function($q) use ($serviceID){$q->where('id', $serviceID);})->orWhereHas('visite.medecin.Service', function($q) use ($serviceID){$q->where('id', $serviceID);})->get();}return $demandes;}*/
    public function details($id)
    {
      $demande = demandeexr::FindOrFail($id);
      $etab = Etablissement::first();
      if(isset($demande->id_consultation))
      {
          $obj = $demande->consultation;
          $patient = $demande->consultation->patient;
      }else
      {
        $obj = $demande->visite;
         $patient = $demande->visite->hospitalisation->patient;
      }
      return view('examenradio.details', compact('demande','obj','patient','etab'));   
    }
    public function upload(Request $request)
    {
      $filename= ""; $isImg = 0;
      $ex = Demande_Examenradio::FindOrFail($request->exam_id);
      if($request->hasfile('resultat')){
        $ext = $request->file('resultat')->getClientOriginalExtension();
        $filename = pathinfo($request->file('resultat')->getClientOriginalName(), PATHINFO_FILENAME);
        if($ext == "")
          $filename = $filename.'_'.time();
        else
          $filename = $filename.'_'.time().'.'.$ext;
        $request->file('resultat')->move(public_path('files'), $filename);
      }
      $ex->update([  "etat" =>1, "resultat"=>$filename]);
      return(['exId'=>$ex->id,'fileName'=>$filename,'isImg'=>$isImg]);
    }
    public function examCancel(Request $request)
    {
      $ex = Demande_Examenradio::FindOrFail($request->exmId);
      if($ex->Crr)
        $ex->Crr()->delete();
      $ex->update(['observation'=>$request->observation,"etat"=>0]);
      return $ex->id;
    }
    public function update(Request $request, demandeexr $demande)
    { 
      $state = true;
      $dr = demandeexr::FindOrFail($request->demande_id);  
      if(Auth::user()->is(12))//radiologe
      {
        foreach ($dr->examensradios as $key => $exam)
        {
          if($state)
            if($exam->getEtatID($exam->etat) ==="")
              $state==false;
        } 
        if($state)
        {
          $dr->update([ "etat" => 1 ]);
          $dr->save();
        }
        return redirect()->action('DemandeExamenRadio@index');
      }else
      {
        if (!empty($request->ExamsImg))
        {
          $dr->infossuppdemande()->sync($request->infos); 
          $dr->update([
            'InfosCliniques' =>$request->infosc,
            'Explecations' =>$request->explication
          ]);
          $examsIds = array_diff(json_decode ($request->ExamsImg), $dr->examensradios()->pluck('exm_id')->toArray());
          if (!empty($examsIds))
          {
            foreach ($examsIds as $key => $id)
            {
              $dr->examensradios()->create([
                 'exm_id' =>$id,
                'type_id' => (json_decode ($request->types))[$key]
              ]);
            }
          }
        }else
        $dr->delete();
        return redirect(Route('consultations.show',$dr->id_consultation));   
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
      public function store(Request $request){
        if($request->ajax())    
        {
          $dr = demandeexr::FirstOrCreate([
            "InfosCliniques" => $request->infosc,
            "Explecations" => $request->explication
          ]);
          if(isset($request->id_consultation))
            $dr->update([ "id_consultation" => $request->id_consultation]);
          else
            $dr->update([ "visite_id" => $request->visite_id]);
          if(isset($request->infos))
            $dr->infossuppdemande()->attach(json_decode($request->infos));
          foreach (json_decode ($request->ExamsImg) as $key => $id)
          {
            $dr->examensradios()->create([
              'exm_id' =>$id,
              'type_id' => (json_decode ($request->types))[$key]
            ]);
          }   
          return $dr;
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
        $specialite = Specialite::findOrFail((Auth::user()->employ)->specialite);
        return view('examenradio.edit', compact('demande','infossupp','examensradio','examens','specialite')); 
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
      $demande = demandeexr::destroy($id);    
      return $demande;
    }
   
    public function delResult(Request $request)
    {
      $ex = Demande_Examenradio::FindOrFail($request->examId);
      if(isset($ex->resultat))
        File::delete('files/'.$ex->resultat);
      if(isset($ex->Crr))
        $ex->Crr->delete();
      $ex ->update([   "etat" => null,  "resultat" => null ,"crr_id"=> null]);
      return $ex;
    }
    public function examDestroy($id)
    {
      $ex = Demande_Examenradio::FindOrFail($id);
      $ex->delete();
      return $ex;
    }
    public function print($id)
    {
      $demande = demandeexr::FindOrFail($id); 
      $etab = Etablissement::first();
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
      //teste
      $barcode = new DNS1D($patient->IPP, 'C128');
      $pdf = PDF::loadView('examenradio.demandePDF', compact('demande','patient','date','etab','barcode'));
      return $pdf->stream($filename);
    }
}