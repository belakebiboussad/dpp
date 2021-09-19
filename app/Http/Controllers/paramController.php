<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modeles\specialite_exb;
class paramController extends Controller
{
    //
	public function index()
  {
  	 // return view('parametres.index', compact('hospitalisations','etatsortie','chapitres','medecins','etablissement'));
  	$specialitesExamBiolo = specialite_exb::all();
  	return view('parametres.index',compact('specialitesExamBiolo'));

  }  
}
