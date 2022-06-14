<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\LettreOrientation;
class LettreOrientationController extends Controller
{
	public function __construct()
  {
    $this->middleware('auth');
  }
  public function store(Request $request)
  { 
    if($request->ajax()) {
      $orient =LettreOrientation::create($request->all());
      $orient->load('Specialite');
      return $orient;
    }
  }
  public function edit($id)
  {
      $orient = LettreOrientation::with('Specialite')->FindOrFail($id);
      return $orient;
  }
  public function update(Request $request, $id)
  {
    $orient = LettreOrientation::find($id);
    $orient->update($request->all());
    $orient->load('Specialite');
    return $orient;
  }
  public function destroy($id)
  {
    $orient = LettreOrientation::destroy($id);
    return $orient;
  }
}
