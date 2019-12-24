<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\homme_conf;
use App\modeles\patient;
use Auth;
class HommeConfianceController extends Controller
{
  public function edit($id)
  {
         $homme = homme_conf::FindOrFail($id);
         $patient = patient::FindOrFail($homme->id_patient);
         return view('patient.add_gardeMalade',compact('homme','patient'));
  }
  //
	public function store(Request $request)
  {

  	return( $request->patientId);
  }
  public function createGardejax(Request $request)
  {
  	$output="<tr>";
  	$homme = homme_conf::firstOrCreate([  "id_patient" =>$_POST['pid'],
                          "nom"        =>$_POST['nom'],
                          "prénom"     =>$_POST['prenom'],
                          "date_naiss" =>$_POST['datenaiss'],
                          "lien_par"   =>$_POST['relation'],
                          "type_piece" =>$_POST['typePiece'],
                          "num_piece"  =>$_POST['number'],
                          "date_deliv" =>$_POST['datePiece'],
                          "adresse"    =>$_POST['adresse'],
                          "mob"        =>$_POST['mobile_h'],
                          "created_by" =>Auth::user()->employee_id,
    ]);
  	$output .=  '<td hidden>'.$homme->id.'</td>'.
  					    '<td >'.$homme->nom.'</td>'.
  					    '<td >'.$homme->prénom.'</td>'.
  					    '<td >'.$homme->date_naiss.'</td>'.
  					    '<td >'.$homme->adresse.'</td>'.
  					    '<td >'.$homme->mob.'</td>'.
  					    '<td >'.$homme->lien_par.'</td>'.
  					    '<td >'.$homme->type_piece.'</td>'.
  					    '<td >'.$homme->num_piece.'</td>'.  
  					    '<td >'.$homme->date_deliv.'</td>'.
  					   '<td class="center">
                                              <a class = "btn btn-info btn-xs" data-toggle="tooltip" title="modifier"  href="'.route('hommeConfiance.edit',$homme->id).'"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></a>&nbsp;<a class="btn btn-danger btn-xs" data-method="DELETE" data-confirm="Etes Vous Sur de supprimer?"  href="'.route('hommeConfiance.destroy',$homme->id).'"><i class="fa fa-trash-o fa-xs"></i></a></td>'.
                                         
                                       '</tr>';
  	return Response($output); 
  }
  public function destroy($id)
  {
  	dd($id);
  } 
}
