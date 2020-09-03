<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\CIM\chapitre;
use App\modeles\CIM\sChapitre;
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
      $schapitre = sChapitre::FindOrFail($request->search);
      return count($schapitre->maladies);
    }
    
}
