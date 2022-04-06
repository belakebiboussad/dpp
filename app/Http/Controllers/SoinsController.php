<?php

namespace App\Http\Controllers;
use App\modeles\hospitalisation;
use Illuminate\Http\Request;

class SoinsController extends Controller
{
  function index(Request $request)
  {
    $hosp = hospitalisation::FindOrFail($request->id);
    dd($hosp->getlastVisite());
    return view('soins.index', compact('hosp')); 
  }
  public function show(Request $request)
  {
    return redirect()->action('SoinsController@index',$request);
  } 
}
