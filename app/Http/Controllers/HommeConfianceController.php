<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\modeles\homme_conf;
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
  public function admin_credential_rules(array $data)
    {
      $validator = Validator::make($data, [
       "nom"=> "required",
        "prenom"=> "required",
        "type_piece"=> "required",
        "num_piece"=> "required",
        "mob"=> "required | regex:/[0][245679][0-9]{8}/",
      ]);
      return $validator;
    }  
	public function store(Request $request)
  {
    $request_data = $request->All();
    $validator = $this->admin_credential_rules($request_data);
    if($validator->fails())
     return response()->json(['errors'=>$validator->errors()->all()]);
    $homme =homme_conf::create($request->all());
    return response()->json(['success' => "Homme de confiance crée avec suuccés",'homme'=>$homme ]);
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
    $request_data = $request->All();
    $validator = $this->admin_credential_rules($request_data);
    if($validator->fails())
       return response()->json(['errors'=>$validator->errors()->all()]);
    $homme = homme_conf::find($id);
    $homme -> update($request->all());
    return response()->json(['success' => "Homme de confiance mis à jour avec suuccés",'homme'=>$homme ]);
  }
  public function destroy(homme_conf $homme)
  {
  	return $homme;
  } 
}