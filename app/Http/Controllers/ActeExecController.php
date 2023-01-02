<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\ActeExec;
use App\modeles\Acte;
use Carbon\Carbon;
use Auth;
class ActeExecController extends Controller
{
  public function index(Request $request)
  {
    $date= Carbon::now()->format('Y-m-d'); 
    $acte = Acte::FindOrFail($request->id);
    $view = view("soins.ajax_acte_details",compact('acte','date'))->render();
    return($view);
 }
  public function store(Request $request)
  {
    $input = $request->all();
    $input['employ_id'] = Auth::user()->employee_id ;
    $exec =ActeExec::create($input);    
    return $exec;
  } 
}
