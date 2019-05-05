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
class DemandeExamenRadio extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function liste_exr()
    {
        $demandesexr = demandeexr::all();
        return view('examenradio.liste_exr', compact('demandesexr'));
    }

    public function details_exr($id)
    {
        $demande = demandeexr::FindOrFail($id);
        return view('examenradio.details_exr', compact('demande'));
    }

    public function upload_exr(Request $request)
    {
        $demande = demandeexr::FindOrFail($request->id_demande);
        $demande->update([
            "etat" => "V",
            "resultat" => $request->file('resultat')->getClientOriginalName(),
        ]);

        $filename = $request->file('resultat')->getClientOriginalName();
        $file = file_get_contents($request->file('resultat')->getRealPath());
        Storage::disk('local')->put($filename, $file);

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $consultID)
    {
           //   $request->validate([
           //      "infosc" => "required",
           //      "explication" => "required",
           //      "infos" => "required",
           //      "examensradio" => "required",
           //      "exmns" => "required"
           //  ],[
           //      "infosc.required" => "Ce champ est obligatoire.",
           //      "explication.required" => "Ce champ est obligatoire.",
           //      "infos.required" => "Ce champ est obligatoire.",
           //      "examensradio.required" => "Ce champ est obligatoire.",
           //      "exmns.required" => "Ce champ est obligatoire.",
           // ]); 
        
           $date = Date::now();
             $demande = demandeexr::FirstOrCreate([
                "Date" => $date,
                "InfosCliniques" => $request->infosc,
                "Explecations" => $request->explication,
                "id_consultation" => $consultID,
            ]);
            foreach ($request->infos as $id_info) {
                $demande->infossuppdemande()->attach($id_info);
            }

            foreach ($request->examensradio as $id_exm_radio) {
                $demande->examensradios()->attach($id_exm_radio);
            }

            foreach ($request->exmns as $id_exmn) {
                $demande->examensrelatifsdemande()->attach($id_exmn);
            }
            //return redirect()->route('consultations.show', $request->id_consultation);
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
        return view('examenradio.show_exr', compact('demande'));
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

    public function show_demande_exr($id)
    {
        $demande = demandeexr::FindOrFail($id);
        $pdf = PDF::loadView('examenradio.imprimer', compact('demande'));
        return $pdf->stream('demande_examen_radiologique.pdf');
    }
}
