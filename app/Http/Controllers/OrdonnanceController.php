<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\consultation;
use App\modeles\patient;
use App\modeles\employ;
use App\modeles\ordonnance;
use Jenssegers\Date\Date;
use PDF;
use Response;
use View;
class OrdonnanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


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
    public function store(Request $request,$id_consultation)
    {
           $date = Date::now();
           $ordonnance = ordonnance::FirstOrCreate([
                "date" => $date,
                "id_consultation" => $id_consultation,   
           ]);
           $listes = json_decode($request->liste);
           for ($i=0; $i < count($listes); $i++) { 
                    $id_med = $listes[$i]->med;
                    $ordonnance->medicamentes()->attach($id_med,['posologie' => $listes[$i]->posologie]); 
           }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    // _ordonnance

     public function show($id)
     {  
           $ordonnance = ordonnance::FindOrFail($id);
           return view('ordennance.show_ordennance', compact('ordonnance'));
     }
     public function show_ordonnance($id)
     {  
        $ordonnance = ordonnance::FindOrFail($id);
        $pdf = PDF::loadView('ordennance.imprimer', compact('ordonnance'));
        return $pdf->stream('ordonnance.pdf');
    }
    public function print(Request $request)
    {   
        
        $patient = patient::FindOrFail($request->id_patient);
        $employe = employ::FindOrFail($request->id_employe);
        $view = view("consultations.ModalFoms.ordonnancePDF",compact('patient','employe'))->render();
        return response()->json(['html'=>$view]);
       
        // $pdf = PDF::loadView('ordonnancePDF', compact('$patient'))->setPaper('a6','landscape');
        // $name = "Ord.pdf";
        // return $pdf->download($name);
    }

}
