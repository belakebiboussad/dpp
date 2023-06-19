<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\patient;
use App\modeles\employ;
use App\modeles\ordonnance;
use App\modeles\medicament;
use App\modeles\Etablissement;
use PDF;
use Response;
use Storage;
use File;
use View;
use Carbon\Carbon;
class OrdonnanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function create($id_consultation)
    {
      $consultation = consultation::where("id",$id_consultation)->get()->first();
      $patient = patient::where("id",$consultation->pid)->first();
      return view("ordennance.create_ordennance",compact('consultation','patient'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id_consultation)
    {
/*$date =Carbon::now();$ordonnance = ordonnance::FirstOrCreate([
"id_consultation" => $id_consultation, ]);$listes = json_decode($request->liste);
for ($i=0; $i < count($listes); $i++){$id_med = $listes[$i]->med;       $ordonnance->medicamentes()->attach($id_med,['posologie' => $listes[$i]->posologie]);}*/
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){ }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // _ordonnance

    public function show($id)
    {  
       $ordonnance = ordonnance::FindOrFail($id);
       return view('ordennance.show', compact('ordonnance'));
    }
    public function print($id)
    {  
      $ordonnance = ordonnance::FindOrFail($id);
      $etab = Etablissement::first();
      $pdf = PDF::loadView('ordennance.ordonnancePDF', compact('ordonnance','etab'));
      $filename = $ordonnance->Consultation->patient->Nom . "-" . $ordonnance->Consultation->patient->Prenom . ".pdf";
      Storage::put('public/pdf/'.$filename,$pdf->output());
      $file = storage_path() . "/app/public/pdf/" . $filename;
      if (File::isFile($file))
      {
        $file = File::get($file);
        $response = Response::make($file, 200);
        $response->header('Content-Type', 'application/pdf');
        Storage::deleteDirectory('/public/pdf/');
        return $response;
      } 
    }
    public function destroy($id)
    {
      return ordonnance::destroy($id);
    }
}