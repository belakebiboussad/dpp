<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\patient;
use App\modeles\antecedant;
use Date;
use App\Http\Controllers\Session;
use Response;
class AntecedantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeatcd()
    {
        $message ='exemple';
        return response()->json(['response' => $message]); 
    }
    public function index($id)
    {   
        $patient = patient::FindOrFail($id);
        $atcds = antecedant::where("Patient_ID_Patient",$patient->id)->get()->all();

        return view('antecedents.index_atcd',compact('patient','atcds'));
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
         // return view('consultations.Antecedant',compact('patient'));

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
      return Response::json($atcd);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $atcd = antecedant::FindOrFail($id);   // $id_patient = $atcd->Patient_ID_Patient;      // $patient = patient::FindOrFail($id_patient);
        // return view('antecedents.show_atcd',compact('atcd','patient'));
        $atcd = antecedant::find($id);
        return Response::json($atcd);
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
        $patient = patient::FindOrFail($atcd->Patient_ID_Patient);
        return view('antecedents.edit_atcd',compact('atcd','patient'));
     
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
        $atcd->save();
        return Response::json($atcd);  
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
        return Response::json($atcd);   
    }

}
