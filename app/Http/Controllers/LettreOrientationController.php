<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\LettreOrientation;
use App\modeles\Etablissement;
use PDF;
use Storage;
use Response;
use File;
class LettreOrientationController extends Controller
{
	public function __construct()
  {
    $this->middleware('auth');
  }
  public function store(Request $request)
  { 
    if($request->ajax()) {
      $orient =LettreOrientation::create($request->all());
      $orient->load('Specialite');
      return $orient;
    }
  }
  public function edit($id)
  {
    $orient = LettreOrientation::with('Specialite')->FindOrFail($id);
    return $orient;
  }
  public function update(Request $request, $id)
  {
    $orient = LettreOrientation::find($id);
    $orient->update($request->all());
    $orient->load('Specialite');
    return $orient;
  }
  public function destroy($id)
  {
    $orient = LettreOrientation::destroy($id);
    return $orient;
  }
  public function print($id)
  {
    $orient = LettreOrientation::with('consultation.medecin','consultation.patient')->find($id);
    $etab = Etablissement::first();
    $pdf = PDF::loadView('consultations.EtatsSortie.orienLetterPDFAjax', compact('orient','etab'));
    $filename =  "temp.pdf";
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
}
