<?php

namespace App\Http\Controllers;
use App\modeles\hospitalisation;
use Illuminate\Http\Request;

class SoinsController extends Controller
{
  function index(Request $request)
  {
    $hosp = hospitalisation::FindOrFail($request->hosp_id);
    return view('soins.index', compact('hosp')); 
  } 
}
