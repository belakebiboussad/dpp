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
  	$output="<tr>";
  	// $homme = homme_conf::firstOrCreate([  "id_patient" =>$_POST['id_patient'],
   //                        "nom"        =>$_POST['nom'],
   //                        "prenom"     =>$_POST['prenom'],
   //                        "date_naiss" =>$_POST['datenaiss'],
   //                        "lien_par"   =>$_POST['relation'],
   //                        "type_piece" =>$_POST['typePiece'],
   //                        "num_piece"  =>$_POST['number'],
   //                        "date_deliv" =>$_POST['datePiece'],
   //                        "adresse"    =>$_POST['adresse'],
   //                        "mob"        =>$_POST['mobile_h'],
   //                        "created_by" =>Auth::user()->employee_id,
   //  ]);
  	// $output .=  '<td hidden>'.$homme->id_patient.'</td>'.
  	// 				    '<td >'.$homme->nom.'</td>'.
  	// 				    '<td >'.$homme->prenom.'</td>'.
  	// 				    '<td >'.$homme->date_naiss.'</td>'.
  	// 				    '<td >'.$homme->adresse.'</td>'.
  	// 				    '<td >'.$homme->mob.'</td>'.
  	// 				    '<td >'.$homme->lien_par.'</td>'.
  	// 				    '<td >'.$homme->type_piece.'</td>'.
  	// 				    '<td >'.$homme->num_piece.'</td>'.  
  	// 				    '<td >'.$homme->date_deliv.'</td>'.
  	// 				    '<td class="center"><button type="button" class = "btn btn-xs btn-info open-modal" value="'.$homme->id.'" ><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;<button type="button" class="btn btn-xs btn-danger delete-garde" data-method="DELETE" data-confirm="Etes Vous Sur de supprimer?"  value="'.$homme->id.'"><i class="fa fa-trash-o fa-xs"></i></button></td>'.                          
   //              '</tr>';
  	// return Response($output); 
    alert($request->date_naiss);
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
      // $link->url = $request->url;
      // $link->description = $request->description;
      // $link->save();
      $homme -> update([
              "nom"        =>$request->nom,
              "prénom"     =>$request->prenom,
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
