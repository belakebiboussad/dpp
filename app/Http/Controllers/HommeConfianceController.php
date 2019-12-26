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
      // $homme = homme_conf::FindOrFail($id);
      // $patient = patient::FindOrFail($homme->id_patient);
      // return view('patient.add_gardeMalade',compact('homme','patient'));
      $homme = homme_conf::find($id);
      // $homme = homme_conf::FindOrFail($id);
      return Response::json($homme);
  }
  //
	public function store(Request $request)
  {

  	  $link =Link::create($request->all());
      return Response::json($link);
  }
  public function createGardejax(Request $request)
  {
    $homme =homme_conf::create($request->all());
    return Response::json($homme);
  }
  public function show($id)
  {
      $homme = homme_conf::find($id);
      // $homme = homme_conf::FindOrFail($id);
      return Response::json($homme);
  }
  public function update(Request $request, $id)
  {
        //
       $homme = homme_conf::find($id);
         $homme -> update([
              "nom"        =>$request->nom,
              "prenom"     =>$request->prenom,
              "date_naiss" =>$request->date_naiss,
              "lien_par"   =>$request->lien_par,
              "type_piece" =>$request->type_piece,
              "num_piece"  =>$request->num_piece,
              "date_deliv" =>$request->date_deliv,
              "adresse"    =>$request->adresse,
              "mob"        =>$request->mob,
              "created_by" =>Auth::user()->employee_id,
      ]);
      $homme->save();
      return Response::json($homme);
  }
  public function destroy($id)
  {
  	$homme = homme_conf::destroy($id);
    return Response::json($homme);
  } 
}
