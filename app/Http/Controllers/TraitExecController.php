<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\TraitExec;
use Auth;
class TraitExecController extends Controller
{
  public function store(Request $request)
  {
    $input = $request->all();
    $input['employ_id'] = Auth::user()->employe_id ;
    $exec =TraitExec::create($input);/*if($exec->Trait->TraitExecs->count() == $exec->Trait->execs)return [ 'exec' =>$exec,];*/
    return $exec;
  } 
}
