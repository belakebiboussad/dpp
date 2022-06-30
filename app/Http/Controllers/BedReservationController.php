<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\modeles\rdv_hospitalisation;
use App\modeles\service;
use App\modeles\BedReservation;
class BedReservationController extends Controller
{
	public function __construct()
  {
      $this->middleware('auth');
  }
	public function index()
	{
		$tomorrow = date("Y-m-d", strtotime('now'));
		$services =service::where('type','!=',"2")->get();
		$rdvs =	rdv_hospitalisation::doesntHave('bedReservation')->whereHas('demandeHospitalisation',function ($q){
																			$q->doesntHave('bedAffectation')->where('service',Auth::user()->employ->service_id);    
																		})->where('date','>=',$tomorrow)->where('etat','=',null)->get();
		return view('reservation.index', compact('rdvs','services'));
	}
	public function store(Request $request)
	{
		BedReservation::firstOrCreate([
          "id_rdvHosp"=>$request->rdv_id,
          "id_lit" =>$request->lit_id,
    ]);      
		return redirect()->action('BedReservationController@index');
	}
}
