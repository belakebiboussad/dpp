<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\CertificatDescriptif;
use App\modeles\Etablissement;
use PDF;
use Response;
use Storage;
use File;// use Dompdf\Dompdf;
use View;
class CertificatDescriptifController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function store(Request $request)
  { 
    if($request->ajax()) {
      $descript =CertificatDescriptif::create($request->all());
      return $descript;
    }
  }
  public function edit($id)
  {
    $descript = CertificatDescriptif::FindOrFail($id);
    return $descript;
  }
  public function update(Request $request, $id)
  {
    $descript = CertificatDescriptif::find($id);
    $descript->update($request->all());
    return $descript;
  }
  public function destroy($id)
  {
    $descript = CertificatDescriptif::destroy($id);
    return $descript;
  }
  public function print($id)
  {
    $certif = CertificatDescriptif::FindOrFail($id);
    $etablissement = Etablissement::first();
    $pdf = PDF::loadView('consultations\EtatsSortie.certifDescPDF', compact('certif','etablissement'));
    //$filename = $ordonnance->consultation->patient->Nom . "-" . $ordonnance->consultation->patient->Prenom . ".pdf";
    $filename ="a.pdf";
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
