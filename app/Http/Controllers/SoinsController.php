<?php

namespace App\Http\Controllers;
use App\modeles\hospitalisation;
use Illuminate\Http\Request;

class SoinsController extends Controller
{
  function index(Request $request)
  {
    $hosp = hospitalisation::FindOrFail($request->id);
    $lastVisite = $hosp->getlastVisite(); //dd($lastVisite->prescreptionconstantes);
    return view('soins.index', compact('hosp','lastVisite')); 
  }
  public function show(Request $request)
  {
    return redirect()->action('SoinsController@index',$request);
  } 
}
