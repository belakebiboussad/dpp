<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Constante;
use App\modeles\Constantes;
use App\modeles\prescription_constantes;  
use Carbon\Carbon;
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
    $view = view("soins.ajax_const_details",compact('const','hosp_id'))->render();
    return($view);
  }
  public function edit(Request $request,$id)
  {
    if($request->ajax())  
    {
      $const = Constante::find($id);
      return $const;
    }
  }
  public function store(Request $request)
  {
    $input = $request->all();
    $input['date'] = Carbon::now()->format('Y-m-d H:i:s') ;
    $const =  Constantes::create($input);
    if($request->ajax()) 
      return $const;
    else
      return redirect()->back()->with('succes', 'prescription inserer avec success');  
  }
  public function destroy(Request $request)
  {
    $const = Constantes::where('hospitalisation_id',$request->hosp_id)->where($request['constename'],'<>',null)->orderBy('date','desc')->first();
    $const->delete();
    return $const;
  }
  public function getConstData(Request $request)
  {
    if($request->isDate == 1)
      $data = Constantes::select('date')->whereNotNull($request->const_name)->where('hospitalisation_id', $request->hosp_id)->get();
    else
      $data = Constantes::select($request->const_name)->whereNotNull($request->const_name)->where('hospitalisation_id', $request->hosp_id)->get();
    return $data ;
  }
}