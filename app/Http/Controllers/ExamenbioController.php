<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\modeles\examenbiologique;
use App\modeles\demandeexb;
use Illuminate\Support\Facades\Auth;
use Response;
class ExamenbioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
      {
          $this->middleware('auth');
      }
    public function index($id){}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create(){}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$consultID){
      if($request->AutreBiol != null)  //save examen biologique autre 
      {
        $tags = explode(",", $request->AutreBiol);
        foreach($tags as $k=>$v){    
          examenbiologique::create([
                    "id_consultation"=>$consultID,
                    "classe"=>"Autre",
                    "nom"=>$v
                ]);
        }
      }
      if($request->exambio != null)
      {
        foreach($request->exambio as $k=>$v){  
          foreach($v as $value)
          {
            examenbiologique::create(["id_consultation"=>$consultID,"classe"=>$k,"nom"=>$value]);
          }
        }
      }
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {}
/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request,$id){ dd($id);}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      $demande = demandeexb::FindOrFail($request->demande_id);
      return $demande->examensbios()->detach($id);
    }
}