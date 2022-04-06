<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\ActeExec;
use Response;
use Auth;
class ActeExecController extends Controller
{
  public function store(Request $request)
  {
    $input = $request->all();
    $input['employ_id'] = Auth::user()->employee_id ;
    $exec =ActeExec::create($input);    
    return Response::json($exec);
  } 
}
