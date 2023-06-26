<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\modeles\specialite_exb;
use App\modeles\consultation;
use App\modeles\visite;
use App\modeles\demandeexb;
use App\modeles\Etablissement;
use App\modeles\employ;
use App\modeles\service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\Helpers\Utf8;
use Response;//use View;
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
    public function index(Request $request) {
      if($request->ajax())  
      {
        $q = $request->value;
        if($request->field != "service")  
        {
          if(isset($request->value))
            $demandes = demandeexb::with('imageable.medecin.Service','imageable.patient')->where($request->field,'LIKE', "$q%")->get();
          else
            $demandes = demandeexb::with('imageable.medecin.Service','imageable.patient')->whereNull($request->field)->get();
        }else
           $demandes = demandeexb::with('imageable.medecin.Service','imageable.patient')
                                ->whereHas('consultation.medecin', function($query) use ($q) {
                                    $query->where('service_id', $q);
                                  })->orWhereHas('visite.medecin', function($query) use ($q) {
                                    $query->where('service_id', $q);
                                  })->get();
        return $demandes;
      }else
      {
        $services =service::where('type',0)->orwhere('type',1)->get();
        $demandesexb = demandeexb::with('imageable')->whereNull('etat')->OrderBy('id','desc')->get();
        return view('examenbio.index', compact('demandesexb','services'));
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
  public function store(Request $request)
  {
    if($request->ajax())    
    { 
      if(isset($request->consultation_id))
             $obj = consultation::findOrFail($request->consultation_id);
      else
        $obj = visite::findOrFail($request->visite_id);
      $db = $obj->demandeexmbio()->create();
      $db->examensbios()->attach(json_decode($request->exams));
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
          $demande = demandeexb::with('imageable.patient','imageable.medecin')->FindOrFail($id);
          return view('examenbio.show', compact('demande'));
    }
        public function resultAdd(Request $request,$id)
       {
             if($request->ajax())    
            {
                    $demande = demandeexb::FindOrFail($id);
                    $html = view("examenbio.uploadResFrm",compact('demande'))->render();
                    return($html);
            }else
            {
                   $demande = demandeexb::with('imageable.patient','imageable.medecin')->FindOrFail($id);
                  $etab = Etablissement::first();
                  return view('examenbio.add', compact('demande','etab'));
            }
      }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
      $demande = demandeexb::FindOrFail($id);
      if($request->ajax())
        return $demande->examensbios->load('Specialite');
      else
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
      $demande = demandeexb::FindOrFail($request->id);  
      if($demande->examensbios->count() == 0)
        $demande->delete();
      else
        $demande->save();
      return redirect(Route('consultations.show',$demande->imageable_id));  
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
    public function uploadresultat(Request $request)
    {
      $fResname= ""; $fCrbname= "";
      $validator = Validator::make($request->all(), [
         'resultat' => 'required|mimes:png,JPG,jpeg,csv,txt, pdf']);
      if ($validator->fails())
        return back()->withInput($request->input())->withErrors($validator->errors());
      $demande = demandeexb::FindOrFail($request->id);
      if($request->hasfile('resultat'))
      {
        $ext = $request->file('resultat')->getClientOriginalExtension();
        $fResname = Utf8::cleanString(pathinfo($request->file('resultat')->getClientOriginalName(), PATHINFO_FILENAME)).'_'.time().'.'.$ext;
        $file = file_get_contents($request->file('resultat')->getRealPath());
        $request->file('resultat')->storeAs('/files',$fResname);  
      }
      if($request->hasfile('crbFile'))
      {
        $ext = $request->file('crbFile')->getClientOriginalExtension();
        $fCrbname = Utf8::cleanString(pathinfo($request->file('crbFile')->getClientOriginalName(), PATHINFO_FILENAME)).'_'.time().'.'.$ext;
        $file = file_get_contents($request->file('resultat')->getRealPath());
        $request->file('resultat')->storeAs('/files',$fCrbname);  
      }
      $demande->update([ "etat" => 1, "resultat" =>$fResname ,"crb"  => $request->crb,"crbfile"=>$fCrbname ]);
      return  redirect()->action('DemandeExbController@index');
    }
    public function downloadRes($id)
    {
      $demande = demandeexb::FindOrFail($id);
      $path = storage_path().'/'.'app'.'/files/'. $demande->resultat;
      if (file_exists($path))
        return Response::download($path);
    }
    public function print($id)
    {
      $demande = demandeexb::with('imageable.patient','imageable.medecin')->FindOrFail($id);
      $etab = Etablissement::first();
      $filename = "demandeExamensBio-".$demande->imageable->patient->Nom."-".$demande->imageable->patient->Prenom.".pdf";
      $pdf = PDF::loadView('examenbio.demandePDF', compact('demande','date','etab'));
      return $pdf->stream($filename);
    }
    public function downloadcrb($id)
    {
      $demande = demandeexb::with('imageable.patient','imageable.medecin')->FindOrFail($id);
      $filename = "Compte-Rendu-Biolog-".$demande->imageable->patient->Nom."-".$demande->imageable->patient->Prenom.".pdf";
      $pdf = PDF::loadView('examenbio.EtatsSortie.crbPDf',compact('demande'));
      return $pdf->stream($filename);
    } 
}