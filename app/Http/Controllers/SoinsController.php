<?php

namespace App\Http\Controllers;
use App\modeles\hospitalisation;
use Illuminate\Http\Request;
use App\modeles\Constantes;
use Carbon\Carbon;
class SoinsController extends Controller
{
  function index(Request $request)
  {
    $hosp = hospitalisation::FindOrFail($request->id);
    $lastVisite = $hosp->getlastVisiteWitCsts();
    return view('soins.index', compact('hosp','lastVisite')); 
  }
  public function show(Request $request)
  {
    return redirect()->action('SoinsController@index',$request);
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