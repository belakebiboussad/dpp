<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\TraitExec;
use Auth;
class TraitExecsController extends Controller
{
  public function store(Request $request)
  {
    $input = $request->all();
    $input['employ_id'] = Auth::user()->employee_id ;
    $exec =TraitExec::create($input);    
    return $exec;
  } 
}
