<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\homme_conf;
use App\modeles\patient;
use Auth;
class HommeConfianceController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function edit($id)
  {
    $homme = homme_conf::find($id);
    return $homme;
  }
	public function store(Request $request)
  {
   	$homme =homme_conf::create($request->all());
    return $homme;
  }
  public function show($id)
  {
    if($request->ajax())  
    {
      $homme = homme_conf::find($id);
      return $homme;
    }
  }
  public function update(Request $request, $id)
  {
    $homme = homme_conf::find($id);
    $homme -> update($request->all());
    return $homme;

  }
  public function destroy(homme_conf $homme)
  {
  	return $homme;
  } 
}