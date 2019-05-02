<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\specialite_exb;
use App\modeles\consultation;
use Jenssegers\Date\Date;
use App\modeles\demandeexb;
use Illuminate\Support\Facades\Storage;
use PDF;

class DemandeExbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createexb($id)
    {
        $specialites = specialite_exb::all();
        $consultation = consultation::FindOrFail($id);
        return view('examenbio.demande_exb', compact('specialites','consultation')); 
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$consultId)
    {

             $date = Date::now();
               
             $demande = demandeexb::FirstOrCreate([
                     "DateDemande" => $date,
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
        return view('examenbio.show_exb', compact('demande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function detailsdemandeexb($id)
    {
        $demande = demandeexb::FindOrFail($id);
        return view('examenbio.details_exb', compact('demande'));
    }

    public function uploadresultat(Request $request)
    {
        $demande = demandeexb::FindOrFail($request->id_demande);
        $demande->update([
            "etat" => "V",
            "resultat" => $request->file('resultat')->getClientOriginalName(),
        ]);
        $filename = $request->file('resultat')->getClientOriginalName();
        $file = file_get_contents($request->file('resultat')->getRealPath());
        Storage::disk('local')->put($filename, $file);
        return redirect()->route('homelaboexb');
    }

    public function listedemandesexb()
    {
        $demandesexb = demandeexb::where('etat','E')->get();
        return view('examenbio.liste_demande_exb', compact('demandesexb'));
    }

    public function show_demande_exb($id)
    {

        $demande = demandeexb::FindOrFail($id);
        $pdf = PDF::loadView('examenbio.demande_exb', compact('demande'));
        return $pdf->stream('demande_examen_biologique.pdf');
    }
}
