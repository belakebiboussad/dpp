<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\infosupppertinentes;
use App\modeles\exmnsrelatifdemande;
use App\modeles\examenradiologique;
use App\modeles\demandeexr;
use App\modeles\Etablissement;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Date\Date;
use PDF;
use ToUtf;
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
    /*public function liste_exr(){ $demandesexr = demandeexr::all(); return view('examenradio.liste_exr', compact('demandesexr'));}*/
    public function details_exr($id)
    {
      $demande = demandeexr::FindOrFail($id);
      if(isset($demande->consultation))
        $patient = $demande->consultation->patient;
      else
        $patient = $demande->visite->hospitalisation->patient;
      return view('examenradio.details_exr', compact('demande','patient'));
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
                  //$file->move(public_path().'/Patients/'.$patient->Nom.$patient->Prenom.'/examsRadio/'.$request->id_demandeexr.'/'.$request->id_examenradio.'/', $namefile);
                  $file->move(public_path().'/Patients/'.$patient->id.'/examsRadio/'.$request->id_demandeexr.'/'.$request->id_examenradio.'/', $namefile);
                  
                  $data[] = $namefile;
                 }
              }
              $exam->pivot->resultat = json_encode($data,JSON_FORCE_OBJECT);
              $exam->pivot->etat = 1;
              $exam->pivot->save();
            }
          }
        return Response()->json([
          "rowID" => $request->id_examenradio,
        ]);
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
      return Response()->json([
        "rowID" => $request->id_examenradio,
      ]);
    }
    public function upload_exr(Request $request)
    {  // $request->validate([  //     'resultat' => 'required',   // ]);
      $demande = demandeexr::FindOrFail($request->id_demande);//$filename = $request->file('resultat')->getClientOriginalName(); $filename =  ToUtf::cleanString($filename); $file = file_get_contents($request->file('resultat')->getRealPath());Storage::disk('local')->put($filename, $file);
      foreach ($demande->examensradios as $key => $exam)
      {
        if(!isset($exam->pivot->etat))
          return redirect()->route('homeradiologue');
      } 
      $demande->update([
          "etat" => "V"// "resultat" => $filename,
      ]);
      $demande->save();
      return redirect()->route('homeradiologue');
    }
    public function createexr($id)
    {
      $infossupp = infosupppertinentes::all();
      $examens = exmnsrelatifdemande::all();
      $examensradio = examenradiologique::all();
      $consultation = consultation::FindOrFail($id);
      return view('examenradio.demande_exr', compact('consultation','infossupp','examens','examensradio'));
    }
    public function index(){}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}

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
        $demande ->examensradios()->attach($value->acteImg, ['examsRelatif' => $value->types]);//$demande ->examensradios()->attach($value->acteImg, ['examsRelatif' => json_encode($value->types)]);
      
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
        $patient = $demande->consultation->patient;
      else
        $patient = $demande->visite->hospitalisation->patient;
      return view('examenradio.show', compact('demande','patient'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      $demande = demandeexr::FindOrFail($id);
      return view('examenradio.edit', compact('demande')); 
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) { }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $demande = demandeexr::FindOrFail($id);
      $consult_id = $demande->consultation;
      $demande = demandeexr::destroy($id);
      return redirect()->action('ConsultationsController@show',$consult_id);
    }
    public function print($id)//imprime
    {
      $demande = demandeexr::FindOrFail($id); 
      $etablissement = Etablissement::first();
      if(isset($demande->consultation))
        $patient = $demande->consultation->patient;
      else
        $patient = $demande->visite->hospitalisation->patient;
      $filename = "Examens-Radio-".$patient->Nom."-".$patient->Prenom.".pdf";
      $pdf = PDF::loadView('examenradio.demande_exr', compact('demande','etablissement'));
      return $pdf->stream($filename);
    }
}
