<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\infosupppertinentes;
use App\modeles\exmnsrelatifdemande;
use App\modeles\examenradiologique;
use App\modeles\demandeexr;
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
             if($request->ajax())  
             {    
                   $demande = $request->id_demandeexr;
                   $examen = $request->id_examenradio;
                   if ($files = $request->file('resultat'))
                   {
                          $file = $request->resultat->store('public/documents');
                          return Response()->json([
                              "success" => true,
                              "dem" =>$demande,
                          ]);
                  }else
                          return Response()->json([
                              "success" => false,
                          ]);

             }
       }
       public function upload_exr(Request $request)
       {
              $request->validate([
                     'resultat' => 'required',
             ]);
      $demande = demandeexr::FindOrFail($request->id_demande);
      $filename = $request->file('resultat')->getClientOriginalName();
      $filename =  ToUtf::cleanString($filename);
      $file = file_get_contents($request->file('resultat')->getRealPath());
      Storage::disk('local')->put($filename, $file);
      $demande->update([
          "etat" => "V",
          "resultat" => $filename,
      ]);
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
        $demande ->examensradios()->attach($value->acteImg, ['examsRelatif' => $value->types]);
         //$demande ->examensradios()->attach($value->acteImg, ['examsRelatif' => json_encode($value->types)]);
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
    public function update(Request $request, $id) {

    }
  
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
        $pdf = PDF::loadView('examenradio.demande_exr', compact('demande'));
        return $pdf->stream('demande_examen_radiologique.pdf');
    }
}
