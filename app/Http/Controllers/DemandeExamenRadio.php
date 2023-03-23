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
            $demandes = demandeexr::with('imageable.medecin.Service','imageable.patient')->where($field,'LIKE', "$q%")->get();
          else 
            $demandes = demandeexr::with('imageable.medecin.Service','imageable.patient')->whereNull($field)->get();
        } else
        {
          $demandes = demandeexr::with('imageable.medecin.Service','imageable.patient')
                        ->whereHas('consultation.medecin', function($query) use ($q) {
                            $query->where('service_id', $q);
                          })->orWhereHas('visite.medecin', function($query) use ($q) {
                            $query->where('service_id', $q);
                          })->get();
        }
        return $demandes;
      }else
      {
        $services =service::where('type',0)->orwhere('type',1)->get();
        $demandesexr = demandeexr::with('imageable')->whereNull('etat')->orderBy('id','desc')->get();
        return view('examenradio.index', compact('demandesexr','services')); 
      }
    }
    public function details($id)
    {
      $demande = demandeexr::FindOrFail($id);
      $etab = Etablissement::first();
      if($demande->imageable_type === 'App\modeles\consultation')
        $patient = $demande->imageable->patient;
      else
        $patient = $demande->imageable->hospitalisation->patient;
      return view('examenradio.details', compact('demande', 'patient', 'etab'));   
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
            if($exam->getEtatID() ==="")
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
        return redirect(Route('consultations.show',$dr->imageable_id));   
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
       if(isset($request->consultation_id))
        $obj = consultation::findOrFail($request->consultation_id);
      else
        $obj = visite::findOrFail($request->visite_id);
      $dr = $obj->demandExmImg()->create([
            'InfosCliniques'=>$request->infosc,
            'Explecations'  =>$request->explication,
          ]);
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
        if($demande->imageable_type === 'App\modeles\consultation')
          $patient = $demande->imageable->patient;
        else
          $patient = $demande->imageable->hospitalisation->patient;
        return view('examenradio.show', compact('demande','patient'));
      }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function edit(Request $request,$id) 
      {
        $demande = demandeexr::FindOrFail($id);
        if($request->ajax())    
        {
          return $demande->examensradios->load('Examen','Type');
        }else
        {
          $infossupp = infosupppertinentes::all();
          $examens = TypeExam::all();//CT,RMN
          $examensradio = examenradiologique::all();//pied,poignet
          $specialite = Specialite::findOrFail((Auth::user()->employ)->specialite);
          return view('examenradio.edit', compact('demande','infossupp','examensradio','examens','specialite')); 
        }
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
      return $id;
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
    public function exmDestroy($id)
    {
      $ex = Demande_Examenradio::with('Demande')->FindOrFail($id);
      $ex->delete();
      //si le ernier examen je suprimer la demande
      //if($ex->Demande->examensradios->count() == 0){$ex->Demande->delete();}
      return $ex;
    }
    public function exmStore(Request $request)
    {
    }
    public function print($id)
    {
      $demande = demandeexr::FindOrFail($id); 
      $etab = Etablissement::first();
      $filename = "Demande-Examens-Radio-".$demande->imageable->patient->Nom."-".$demande->imageable->patient->Prenom.".pdf";
      $barcode = new DNS1D($demande->imageable->IPP, 'C128');
      $pdf = PDF::loadView('examenradio.demandePDF', compact('demande','etab','barcode'));
      return $pdf->stream($filename);
    }
}