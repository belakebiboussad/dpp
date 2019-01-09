<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\patient;
use App\modeles\ordonnance;

class OrdonnanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_consultation)
    {
        $consultation = consultation::where("id",$id_consultation)->get()->first();
        $patient = patient::where("id",$consultation->Patient_ID_Patient)->get()->first();
        return view("ordennance.create_ordennance",compact('consultation','patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$consultID)
    {
        // dd($request->dateord);
          $liste = explode(",",$request->listeMedicaments);unset($liste[0]);
          foreach ($liste as $key => $value) {
              # code...
                $tab= explode('|',$value);
                $liste[$key] = array_reverse($tab);
          }
          $medics = json_encode($liste); //dd($medics);
         // dd($medics);
          ordonnance::create([
            "duree"=>$request->dureeefois.' '.$request->foisss,
            "medicaments"=>$medics,
            "id_consultation"=>$consultID,
        ]);
    }
    public function storeold(Request $request)
    {

        $liste = explode(",",$request->liste);
        dd($liste);
        $medics = json_encode($liste); 
        ordonnance::create([
            // "date"=>$request->dateord,
            "duree"=>$request->dureeefois.' '.$request->foisss,
            "medicaments"=>$medics,
            "id_consultation"=>$request->idcons,
        ]);
        return redirect()->action('ConsultationsController@show',['id'=>$request->idcons]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
