<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\colloque;
use App\modeles\DemandeHospitalisation;
use App\modeles\Lit;
use App\modeles\admission;
use App\modeles\rdv_hospitalisation;
use App\modeles\service;
use App\modeles\employ;
use App\User;
use App\modeles\dem_colloque;
use Illuminate\Support\Facades\Auth;
class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \App\modeles\colloque
     * @return \App\modeles\DemandeHospitalisation
     * @return \App\modeles\Lit
     * @return \App\modeles\admission
     * @return \App\modeles\rdv_hospitalisation
     */
      public function index()
      {
        $rdvs = rdv_hospitalisation::with('bedReservation')->whereHas('demandeHospitalisation', function($q){
                                           $q->where('etat', 'programme');
                                        })->where('etat_RDVh','=','en attente')->where('date_RDVh','=',date("Y-m-d"))->get(); 
        return view('home.home_agent_admis', compact('rdvs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      {
        $rdvHospi =  rdv_hospitalisation::find($request->id_RDV);
         $adm=admission::create([     
            "id_rdvHosp"=>$request->id_RDV,       
            "id_lit"=>$rdvHospi->bedReservation->id_lit,
        ]);
         $adm->rdvHosp->demandeHospitalisation->update([
              "etat" => "admise",
         ]);
        return redirect()->action('AdmissionController@index');
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      dd("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy($id) {
        $adm = admission::destroy($id);
        return Response::json($adm);   
      } 
    /* public function getAdmissions($date){}  */  
}
