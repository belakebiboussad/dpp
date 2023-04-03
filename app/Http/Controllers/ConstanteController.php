<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Constante;
use App\modeles\visite;  
use DB;
class ConstanteController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(Request $request)
  {
    $hosp_id = $request->hosp_id;
    $const = Constante::FindOrFail($request->id);
    $view = view("soins.ajax_AddconstVal",compact('const','hosp_id'))->render();
    return($view);
  }
  public function edit(Request $request,$id)
  {/*if($request->ajax()){$const = Constante::find($id);return $const;}*/
    $visite = visite::find($id);
    return $visite->constantes;
  }
  public function store(Request $request)
  {
    $visite = visite::find($request->visit_id); 
    $visite->constantes()->attach($request->nom, ['obs' => $request->obs]);
    return $visite->constantes;
  }
  public function destroy(Request $request, $id)
  {
    $visite = visite::FindOrFail($request->visit_id);
    return $visite->constantes()->detach($id);
  }
}