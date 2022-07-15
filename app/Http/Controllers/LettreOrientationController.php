<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\LettreOrientation;
use App\modeles\Etablissement;
use PDF;
use Dompdf\Dompdf;
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
    $pdf->setPaper('A4', 'portrait');
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
/*  $html = view("consultations.EtatsSortie.orienLetterPDFAjax",compact('orient','etab'))->render();
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $canvas = $dompdf->get_canvas();
    $font = $dompdf->getFontMetrics()->get_font("helvetica", "bold");*/
       /* $canvas->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0)); $canvas->line(10,730,800,730,array(0,0,0),1);*/
   /* $footer = $canvas->open_object();
    $w = $canvas->get_width();
    $h = $canvas->get_height();
    $entete = public_path('img\\') . 'entete.png';
    $canvas->image($entete,'png', 0, 0, 80, 5);   */
    //$foot = public_path('img\\') . 'footer.png';$canvas->image($foot,'png', $h-60, 0, 60, 20);
/*  $canvas->page_text($w - 605, $h - 50, "____________________________________________________________________________________________________________________________________________________________________", $font, 6, array(0, 0, 0));
    $canvas->page_text($w-60,$h-30,"Page {PAGE_NUM} de {PAGE_COUNT}",$font ,7);
    $canvas->page_text($w-590,$h-32,"EHSN;12 Chemin des Glycines,El Biara, Alger C.P. 16000 Tel. 021 239 284", $font,7);
    $canvas->page_text($w - 590, $h - 22, "Fax Directions  (021) 691005. Fax Secrétariat: (021) 230883 / 2637941 ", $font, 6, array(0, 0, 0)); 
    $canvas->close_object(); $canvas->add_object($footer,"all");
      
   */
  }  
}
