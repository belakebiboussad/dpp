<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\CIM\chapitre;
use App\modeles\CIM\sChapitre;
use Response;
class CimController extends Controller
{
	  public function getChapters(Request $request)
      {
            $chapitre = chapitre::FindOrFail($request->search);
          return $chapitre->schapitres;
      }
      public function getdiseases(Request $request)
      {
            $output="";
            $schapitre = sChapitre::FindOrFail($request->search);
            return Response::json($schapitre->maladies);
     }
    /*spublic function diseases(Request $request) { $schapitre = sChapitre::FindOrFail(910);dd( $schapitre->maladies); }*/
}
