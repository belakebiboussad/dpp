<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\CIM\chapitre;
use App\modeles\CIM\sChapitre;
use App\modeles\patient;
class CimController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function getChapters(Request $request)
  {
    $chapitre = chapitre::FindOrFail($request->search);
    return $chapitre->schapitres;
  }
  public function index(Request $request)
  {
    $schapitre = sChapitre::FindOrFail($request->search);
    return $schapitre->maladies;
  }
  public function store(Request $request)
  {
    $patient = patient::findOrFail($request->pid);
    $patient->ContagDesease()->attach($request->maladie_id);
    return $request->maladie_id;
  }
  public function destroy(Request $request,$id)
  {
    $patient = patient::findOrFail($request->pid);
    $all = $patient->ContagDesease()->detach($id);
    return $all;
  }
}
