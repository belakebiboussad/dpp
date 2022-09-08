<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\modeles\Planning;
use Session;
class PlanningController extends Controller
{
  public function index()
  {
    $plannings = Planning::where('employee_id',Auth::user()->employee_id)->get();
    return view('plannings.index', compact('plannings'));
  }
  public function create()
  {
    return view('plannings.create', compact(Auth::user()->employ));
  }
  public function edit($id)
  {
    $demande = Planning::FindOrFail($id);
    $employe = Auth::user()->employ ;
    return view('plannings.edit', compact('demande','employe'));
  }
  public function store(Request $request)
  {
    $input = $request->all();
    $input['employee_id'] = Auth::user()->employee_id ;
    $planning = Planning::create($input);
    $planning->employee()->associate($request->get('employee_id'));
    $plannings = Planning::where('employee_id',Auth::user()->employee_id)->get();
    Session::flash('message','demande  crée avec succès'); 
    return view('plannings.index',compact('plannings'));
  }
  public function update(Request $request, $id)
  {
    $demande = Planning::FindOrFail($id);
    $demande->update([
         "role"=>$request->rolename,
    ]);
    return redirect(Route('planning.index'));   
  }
  public function destroy($id)
  {
    $dem = Planning::find($id);
    $dem->delete();
    $plannings = Planning::where('employee_id',Auth::user()->employee_id)->get();
    Session::flash('message','Demande supprimé avec succès');
    return view('plannings.index',compact('$plannings'));  // return redirect(Route('role.index'))->withSuccess('Rôle supprimé avec succès!');
  }
}
