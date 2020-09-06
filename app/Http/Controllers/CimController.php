<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\CIM\chapitre;
use App\modeles\CIM\sChapitre;
use Response;
class CimController extends Controller
{
    //
	  public function getChapters(Request $request)
    {
      $chapitre = chapitre::FindOrFail($request->search);
      return $chapitre->schapitres;
    }
    public function getdiseases(Request $request)
    {
      $output="";
      $schapitre = sChapitre::FindOrFail($request->search);
      foreach ($schapitre->maladies as $key => $maladie) {
         $output.='<tr>'.'<td>'.$maladie->CODE_DIAG.'</td>'.'</tr>'; 
      }
      return Response($output);
      //return Response::json($schapitre->maladies);
     // return count($schapitre->maladies);
    }
    public function diseases(Request $request)
    {
      $schapitre = sChapitre::FindOrFail(910);
      dd( $schapitre->maladies);
    }
    
}
