<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\lit;
use App\modeles\salle;
use App\modeles\service;

class LitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $lits=lit::join('salles','lits.salle_id','=','salles.id')
                  ->join('services','salles.service_id','=','services.id')
         ->select('lits.*','salles.nom as nomSalle','services.nom as nomService')->get();
        return view('lits.index_lit', compact('lits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createlit()
    {
        $services = service::all();
        return view('lits.create_lit_2', compact('services'));
    }

    public function create($id_salle = null)
    {
           $services = service::all();
           return view('lits.create_lit', compact('services','id_salle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $etat = 1;
           if(isset($_POST['etat']) )
                 $etat = 0;  
           $l=  lit::create([
                    "num"=>$request->numlit,
                    "nom"=>$request->nom,
                    "etat"=>$etat,
                    "affectation"=>0,
                    "salle_id"=>$request->chambre,
           ]);
           return redirect()->action('LitsController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lit = lit::FindOrFail($id);
        $salle = salle::FindOrFail($lit->salle_id);
        $service = service::FindOrFail($salle->service_id);
        return view('lits.show_lit', compact('lit','service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lit = lit::FindOrFail($id);
        $salles = salle::all();
        return view('lits.edit_lit', compact('lit','salles'));
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

           $lit = lit::FindOrFail($id);
              $etat =1 ;
          if(isset($_POST['etat']) )
                     $etat = 0;   
           $lit->update([
                "num"=>$request->numlit,
                "nom"=>$request->nom,
                "etat"=>$etat,
                "affectation"=>$request->affectation,
                "salle_id"=>$request->salle,
            ]);
           return redirect()->action('LitsController@index');
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

    /**
    function ajax return lits
    */
    // $salleid
    public function getlits()
    {
        //on retourne pas les lits bloque ou occupé 
        $salleId = $_GET['SalleID'];
        $start  = $_GET['StartDate']; 
        $end = $_GET['EndDate'];
        $time_start = strtotime($start);  
        $time_end = strtotime($end);
        //$lits;
        $salle =salle::FindOrFail($salleId);
        foreach ($salle->lits as $key => $lit) {  
            $free = $lit->isFree($lit->id,$time_start,$time_end);
            if( $free)
            {
                $salle->lits->pull($key);
                //$lits->push($lit);
            } 
        }
        // $lits = lit::where('salle_id',$salleid)->where('etat',1)->where("affectation",0)->get();
         return $salle->lits;
    }

}
