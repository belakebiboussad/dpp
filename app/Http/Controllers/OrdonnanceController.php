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
           $date = Date::now();
           dd("sdfqd");
           $ordonnance = ordonnance::FirstOrCreate([
                "date" => $date,
                "id_consultation" => $request->id_consultation,   
           ]);
           $listes = json_decode($request->liste);
           for ($i=1; $i < count($listes); $i++) { 
                    $id_med = $listes[$i]->med;
                    $ordonnance->medicamentes()->attach($id_med,['posologie' => $listes[$i]->posologie]); 
           }   //return redirect()->route('consultations.show', $request->id_consultation); 
    }
    public function storeold(Request $request)
    {
           // dd($request->liste);
           $liste = explode(",",$request->liste);
            //dd($liste);
           //unset($liste[0]);
           foreach ($liste as $key => $value) {
                     # code...
                        $tab= explode('|',$value);
                         $liste[$key] = array_reverse($tab);
           }
          // dd($medics);
           $medics = json_encode($liste); //dd($medics);  // dd($medics);
           //dd($medics);
          ordonnance::create([
                    "duree"=>$request->dureeefois.' '.$request->foisss,
                    "medicaments"=>$medics,
                    "id_consultation"=>$consultID,
                ]);
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
