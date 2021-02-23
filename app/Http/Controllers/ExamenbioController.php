<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\modeles\examenbiologique;
use Jenssegers\Date\Date;
//use App\modeles\patient;
//use App\modeles\antecedant;//use App\modeles\consultation;//use App\modeles\Lieuconsultation;//use App\modeles\codesim;
use App\modeles\demandeexb;
use Illuminate\Support\Facades\Auth;

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
    public function index($id)
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
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
                       examenbiologique::create([
                          "id_consultation"=>$consultID,
                          "classe"=>$k,
                          "nom"=>$value,
                      ]);
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
    public function edit($id)   { }
      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($examid, $demandeid)
    { 
        dd($examid);   
        // dd($id);
    }*/
    public function destroy($id)
    { 
      $ids = explode("|", $id);
      dd($id);
      // $demande = demandeexb::FindOrFail($ids[1]); //$examen = examenbiologique::FindOrFail($ids[0]);
      // $demande->examensbios()->detach($ids[0]); //dd($demande->examensbios);
      // return redirect()->action('DemandeExbController@edit',$ids[1]);
    }
}
