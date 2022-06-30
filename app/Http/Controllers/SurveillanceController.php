<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\surveillance;
use App\modeles\consigne;
use Illuminate\Support\Facades\Auth;


class SurveillanceController extends Controller
{
	public function Store(Request $request,$id)
  {
    $s=new surveillance;
    $s->id_consigne=$request->idcons;
    $s->date=$request->datesur;
    $s->heure=$request->heuresur;
    $s->app=$request->ap;
    $s->description=$request->desc;
    $s->observation=$request->obs;
    $s->id_employe=Auth::User()->employee_id;
    $s->save();          
    return back()->with('message','Surveillance ajoutée avec succès!');

    }
}
