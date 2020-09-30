<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\modeles\rdv_hospitalisation;
use App\modeles\service;
class BedReservationController extends Controller
{
   //
	public function index()
	{
		$tomorrow = date("Y-m-d", strtotime('tomorrow'));
		$rdvs =	rdv_hospitalisation::doesntHave('bedReservation')->whereHas('demandeHospitalisation',function ($q){
			$q->where('service',Auth::user()->employ->service);    
		})->where('date_RDVh','>=',$tomorrow)->where('etat_RDVh','en attente')->get();
		$services = service::all();
		return view('reservation.index', compact('rdvs','services'));
	}
	public function create(Request $request)
	{
		if($request->ajax())  
    {
    }
	}
}
