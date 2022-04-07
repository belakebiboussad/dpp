<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\patient;
use App\modeles\antecedant;
use Date;
use App\Http\Controllers\Session;
class AntecedantsController extends Controller
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
            $patient = patient::FindOrFail($id);
            $atcds = antecedant::where("pid",$patient->id)->get()->all();
            return view('antecedents.index',compact('patient','atcds'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_patient)
    {
        $patient = patient::FindOrFail($id_patient);
        return view('antecedents.create_antec',compact('patient'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $atcd =antecedant::create($request->all());
      return $atcd;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $atcd = antecedant::find($id);
      return $atcd;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atcd = antecedant::FindOrFail($id);
        $patient = patient::FindOrFail($atcd->pid);
        return view('antecedents.edit',compact('atcd','patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $atcd = antecedant::find($id);
        $atcd->update($request->all()); 
        return $atcd; 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atcd = antecedant::destroy($id);
        return $atcd;
    }

}
