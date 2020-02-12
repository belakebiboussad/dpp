<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\hospitalisation;
class SoinsController extends Controller
{
  //
  public function index($id)
  {
  	dd($id);
  }
  public function edit($id)
  {
  	$hosp = hospitalisation::find($id); 
  	
  }

}
