<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\patient;
use App\modeles\Vaccin;
use Response;
use DB;
class VaccinController extends Controller
{
  public function show(Request $request,$id)
  {
    if($request->ajax())  
    {
      $vaccin = DB::table('patient_vaccin')->where('patient_id', $request->pid)->where('vaccin_id',$id )->first();
      return Response::json($vaccin);
    }
  }
  public function update(Request $request,$id)
  {
    $patient = patient::findOrFail($request->pid);
    $vac = $patient->vaccins()->find($id);
    $vac->pivot->vaccin_id = $request->vaccinid;
    $vac->pivot->date = $request->date;
    $vac->pivot->save();
    return Response::json($vac->pivot);
  }
  public function store(Request $request)
  {
    $patient = patient::findOrFail($request->pid);
    $patient->vaccins()->attach($request->vaccinid, ['date' => $request->date]);
    //return Response::json($patient->vaccins()->find($request->vaccinid)->pivot);
    return $patient->vaccins()->find($request->vaccinid)->pivot;
  }
  public function destroy(Request $request,$id)
  {
     $v = DB::table('patient_vaccin')->where('vaccin_id', $id)->where('patient_id',$request->pid)->delete();
      return Response::json($v);
  } 
}

