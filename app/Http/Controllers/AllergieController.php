<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Allergie;
use App\modeles\Patient;
use Response;
class AllergieController extends Controller
{
  public function index(Request $request)
  {
    $allergies = Allergie::all();
    return $allergies;
  }
  public function store(Request $request)
  {
    $patient = Patient::findOrFail($request->pid);
    $patient->Allergies()->attach($request->allergie_id);
    return $request->allergie_id;
  }
  public function destroy(Request $request,$id) 
  {
    $patient = Patient::findOrFail($request->pid);
    $all = $patient->Allergies()->detach($id);
    return $all;
  }
}
