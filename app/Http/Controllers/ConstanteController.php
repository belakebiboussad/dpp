<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Constante;  
class ConstanteController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function edit(Request $request,$id)
  {
    if($request->ajax())  
    {
      $const = Constante::find($id);
      return $const;
    }
  }

}
