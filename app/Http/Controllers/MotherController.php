<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\Mother;
use App\modeles\patient;
class MotherController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
    public function store(Request $request)
    { 
      // $this->validate($request, [
      //   'nom'=> 'required|string|max:225',
      //   'id_visite'=> 'required',
      // ]);
      $patient = patient::find($request->pid); 
      $mother = $patient->Mother()->create($request->all());
      return $mother;
      
    }
}
