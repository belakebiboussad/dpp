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
use App\modeles\Specialite;
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
      $ex = Demandeexr_Examenradio::FindOrFail($request->exam_id);
      $filename= ""; $isImg = 0;
      if($request->hasfile('resultat')){
        $ext = $request->file('resultat')->getClientOriginalExtension();
        $filename = pathinfo($request->file('resultat')->getClientOriginalName(), PATHINFO_FILENAME);
        if($ext == "")
          $filename = $filename.'_'.time();
        else
          $filename = $filename.'_'.time().'.'.$ext;
        $request->file('resultat')->storeAs('public/files',$filename);  
      }
      $ex->update([  "etat" =>1, "resultat"=>$filename]);/* $extension = request("resultat")->getClientOriginalExtension();if(in_array($extension, config('constants.imageExtensions')))   $isImg = 1;*/
      return(['exId'=>$ex->id,'fileName'=>$filename,'isImg'=>$isImg]);
    }
    public function examCancel(Request $request)
    {
      $ex = Demandeexr_Examenradio::FindOrFail($request->exmId);
      if($ex->Crr)
        $ex->Crr()->delete();
      $ex->update(['observation'=>$request->observation,"etat"=>0]);
      return $ex->id;
    }
    public function update(Request $request, demandeexr $demande)
    { 
      $demande = demandeexr::FindOrFail($request->demande_id);  
      if(Auth::user()->is(12))//radiologe
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
        if (!empty($request->ExamsImg))
        {
          $demande->infossuppdemande()->sync($request->infos); 
          $demande->update([
            'InfosCliniques' =>$request->infosc,
            'Explecations' =>$request->explication
          ]);
          foreach(json_decode($request->ExamsImg) as $exam){
            $examsInp[]=$exam->acteId;
            $typeExamsInp[]=$exam->type;
          }
          Demandeexr_Examenradio::where('demande_id', $demande->id)->whereNotIn('exm_id', $examsInp)->delete();
          $demExam = $demande->examensradios()->pluck('exm_id')->toArray();//dd($demExam);//[16,7,8]
          $examsIds = array_diff($examsInp, $demExam); /*dd($examsIds);//diif 28*/
          if (!empty($examsIds))
          {
            foreach ($examsIds as $index => $id)
            {
              $exam = new Demandeexr_Examenradio;
              $exam->demande_id = $demande->id; $exam->exm_id = $id;
              $exam->type_id = $typeExamsInp[$index];$exam->save();
            }
          }
        }else
        $demande->delete();
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
      public function store(Request $request){
        if($request->ajax())    
        {
          $demande = demandeexr::FirstOrCreate([
            "InfosCliniques" => $request->infosc,
            "Explecations" => $request->explication
          ]);
          if(isset($request->id_consultation))
            $demande->update([ "id_consultation" => $request->id_consultation]);
          else
            $demande->update([ "visite_id" => $request->visite_id]);
          if(isset($request->infos)){
            $infos = json_decode($request->infos);
            $demande->infossuppdemande()->attach($infos);
          }
          $examsImagerie = json_decode ($request->ExamsImg);
          foreach (json_decode ($request->ExamsImg) as $key => $acte) {       
            $exam = new Demandeexr_Examenradio;
            $exam->demande_id = $demande->id;
            $exam->exm_id = $acte->acteId;
            $exam->type_id = $acte->type;$exam->save();  
          }
          /*
          foreach ($examsImagerie as $key => $value) { 
            //$demande->examensradios()->attach($value['acteId'], ['examsRelatif' => $value['type']]);
            $demande->examensradios()->attach($value->acteId, ['type_id' => $value->type]);
          }
          */
          /*$demande->examensradios()->attach($value->acteImg, ['examsRelatif' => $value->types]);*/
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
     public function search(Request $request)
    {
      if($request->field != "service")  
      {
        if(isset($request->value))
             $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->where($request->field,'LIKE', trim($request->value)."%")->get();
        else
             $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')->where($request->field, null)->get();
      }else
      {
        $serviceID = $request->value;
        $demandes = demandeexr::with('consultation.patient','consultation.medecin.Service','visite.hospitalisation.patient','visite.medecin.Service')
                        ->whereHas('consultation.medecin.Service', function($q) use ($serviceID) {
                                $q->where('id', $serviceID);
                        })->orWhereHas('visite.medecin.Service', function($q) use ($serviceID) {//hospitalisation.
                                $q->where('id', $serviceID);
                            })->get();
      }
      return $demandes;
    }
    public function delResult(Request $request)
    {
      $ex = Demandeexr_Examenradio::FindOrFail($request->examId);
      if(isset($ex->resultat))
        Storage::delete('public/files/' . $ex->resultat);
      if(isset($ex->Crr))
        $ex->Crr->delete();
      $ex ->update([   "etat" => null,  "resultat" => null ,"crr_id"=> null]);
      return $ex;
    }
    public function examDestroy($id)
    {
      $ex = Demandeexr_Examenradio::FindOrFail($id);
      $ex->delete();
      return $ex;// Response::json($ex);   
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
      $pdf = PDF::loadView('examenradio.demandePDF', compact('demande','patient','date','etab'));
      return $pdf->stream($filename);
    }
}