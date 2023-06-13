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
  public function index(Request $request)
  { 
    $response = [];
    $search = $request->search;
    if($search == ''){
         $communes = Commune::orderby('name','asc')->limit(15)->get();
    }else{
         $communes = Commune::orderby('name','asc')->where('name', 'like', '%'.trim($search).'%')->limit(15)->get();
    }
    foreach($communes as $com){
      $response[] = array("value"=>$com->id,"label"=>$com->name,"wvalue"=>$com->daira->wilaya->id,"wlabel"=>$com->daira->wilaya->nom);
    }
    return $response;
  }
  public function search(Request $request)
  { 
    $response = [];
    $search = $request->search;
    if($search == ''){
         $communes = Commune::orderby('name','asc')->limit(15)->get();
    }else{
    $communes = Commune::orderby('name','asc')->where('name', 'like','%'.$search.'%')->limit(15)->get();
    }
    foreach($communes as $com){
      $response[] = array("value"=>$com->id,"label"=>$com->name,"wvalue"=>$com->daira->wilaya->id,"wlabel"=>$com->daira->wilaya->nom);
    }
    return $response;
  }
}