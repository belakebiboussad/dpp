<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\modeles\Planning;
class PlanningController extends Controller
{
     public function create()
      {
            //$employe = employ::FindOrFail($id);
            return view('plannings.create', compact(Auth::user()->employ));
       }
       public function store(Request $request)
      {
           $planning = new Planning();
            $planning->date = str_replace(" ", "T", $request->get('date'));
            $planning->date_end = str_replace(" ", "T", $request->get('date_end'));
            $planning->employee_id = $request->get('employee_id');
            $planning->employee()->associate($request->get('employee_id'));
            $planning->save();
            return 0;
    }
}
