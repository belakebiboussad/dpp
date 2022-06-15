<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\CertificatDescriptif;

class CertificatDescriptifController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function store(Request $request)
  { 
    if($request->ajax()) {
      $descript =CertificatDescriptif::create($request->all());
      return $descript;
    }
  }
  public function edit($id)
  {
    $descript = CertificatDescriptif::FindOrFail($id);
    return $descript;
  }
  public function update(Request $request, $id)
  {
    $descript = CertificatDescriptif::find($id);
    $descript->update($request->all());
    return $descript;
  }
  public function destroy($id)
  {
    $descript = CertificatDescriptif::destroy($id);
    return $descript;
  }
}
