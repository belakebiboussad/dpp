<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Commune;

class CommuneController extends Controller
{
  //
  public function AutoCompleteCommune(Request $request)
  {
    // return  Commune::select('communes.*','wilayas.*')
    //                     ->join('daira','communes.Id_daira','=','daira.Id_daira')
    //                     ->join('wilayas','daira.id_wilaya','=','wilayas.id')
    //                     ->select('communes.*','communes.id as id_Commune' ,'wilayas.*','wilayas.id as Id_wilaya')
    //                     ->where('nom_commune', 'LIKE', '%'.trim($request->com).'%')->get();
    $search = $request->search;
    if($search == ''){
         $communes = Commune::with('daira.wilaya')->orderby('nom_commune','asc')->select('id','nom_commune')->limit(10)->get();
    }else{
         $communes = Commune::with('daira.wilaya')->orderby('nom_commune','asc')->select('id','nom_commune')->where('nom_commune', 'like', '%'.trim($search).'%')->limit(10)->get();
    }

    $response = array();
    foreach($communes as $com){
      // $response[] = array("value"=>$com->id,"label"=>$com->nom_commune,"wilayaId"=>$com->Id_wilaya,"wilaya"=>$com->nom_wilaya );
      $response[] = array("value"=>$com->id,"label"=>$com->nom_commune,"wvalue"=>$com->daira->wilaya->id,"wlabel"=>$com->daira->wilaya->nom_wilaya);
     }

      return response()->json($response);

  }
}
