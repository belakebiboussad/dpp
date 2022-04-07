<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Commune;
class CommuneController extends Controller
{
  
  public function __construct()
      {
          $this->middleware('auth');
      }
  public function AutoCompleteCommune(Request $request)
  { 
    $response = array();
    $search = $request->search;
    if($search == ''){
         $communes = Commune::orderby('nom_commune','asc')->limit(15)->get();
    }else{
         $communes = Commune::orderby('nom_commune','asc')->where('nom_commune', 'like', '%'.trim($search).'%')->limit(15)->get();
    }
    foreach($communes as $com){
      $response[] = array("value"=>$com->id,"label"=>$com->nom_commune,"wvalue"=>$com->daira->wilaya->id,"wlabel"=>$com->daira->wilaya->nom);
    }
    return $response;
  }
 }

