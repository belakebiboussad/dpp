<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\salle;
use App\modeles\lit;
use App\modeles\service;
use Validator;
use Redirect;
use MessageBag;
use Response;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getsalles()
    {
        $serviceId = $_GET['ServiceID'];
        $start  = $_GET['StartDate']; 
        $end = $_GET['EndDate'];
        $time_start = strtotime($start);  
        $time_end = strtotime($end);  
        $salles = salle::where('service_id',$serviceId)->where('etat','Non bloquee')->get();
        foreach ($salles as $key1 => $salle) {
          foreach ($salle->lits as $key => $lit) {
            $free = $lit->isFree($lit->id,$time_start,$time_end); //return Response::json($free);
            if(! $free)
            {
                $salle->lits->pull($key);
            }
          }
        }
        foreach ($salles as $key => $salle) {
            if((count($salle->lits) == 0))
                $salles->pull($key);
        }
        return $salles;
    }
    public function index()
    {
        $salles = salle::all();
        return view('Salles.index_salle', compact('salles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createsalle()
    {
        $services = service::all();
        return view('Salles.create_salle_2', compact('services'));
    }

    public function create($id)
    {
        $idservice = $id;
        return view('Salles.create_salle', compact('idservice'));
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
          salle::create([
                "num"=>$request->numsalle,
                "nom"=>$request->nomsalle,
                "max_lit"=>$request->maxlits,
                "bolc"=>$request->bloc,
                "etage"=>$request->etage,
                "etat"=>"Non bloquee",
                "service_id"=>$request->idservice,
           ]);
        return redirect()->action('SalleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salle = salle::FindOrFail($id);
        $lits = lit::where("salle_id", $salle->id)->get()->all();
        return view('Salles.show_salle', compact('salle','lits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salle = salle::FindOrFail($id);
        $services = service::all();
        return view('Salles.edit_salle', compact('salle','services'));
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
        $salle = salle::FindOrFail($id);
        $salle->update([
            "num"=>$request->numsalle,
            "nom"=>$request->nomsalle,
            "max_lit"=>$request->maxlits,
            "bolc"=>$request->bloc,
            "etage"=>$request->etage,
            "etat"=>$request->etat,
            "service_id"=>$request->service,
        ]);
        return redirect()->action('SalleController@index');
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
