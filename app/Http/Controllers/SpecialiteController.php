<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\modeles\Specialite;
class SpecialiteController extends Controller
{
  public function index(Request $request)
  {
    $specs = Specialite::where('type',$request->type)->get();
    return $specs; 
  } 
}
