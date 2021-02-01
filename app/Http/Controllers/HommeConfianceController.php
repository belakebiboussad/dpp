<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\homme_conf;
use App\modeles\patient;
use Auth;
use Response;
class HommeConfianceController extends Controller
{
  public function edit($id)
  {
    $homme = homme_conf::find($id);
    return Response::json($homme);
  }
  //
	public function store(Request $request)
  {
   	$homme =homme_conf::create($request->all());
    return Response::json($homme);
  }
  public function show($id)
  {
    if($request->ajax())  
    {
      $homme = homme_conf::find($id);  // $homme = homme_conf::FindOrFail($id);
      return Response::json($homme);
    }
  }
  public function update(Request $request, $id)
  {
    $homme = homme_conf::find($id);
    $homme -> update($request->all());
    $homme->save();
    return Response::json($homme);
  } // public function show($id){$atcd = homme_conf::find($id);//return Response::json($atcd); }
  public function destroy($id)
  {
  	$homme = homme_conf::destroy($id);
    return Response::json($homme);
  } 
}
