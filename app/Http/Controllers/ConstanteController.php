<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Constante;
use App\modeles\Constantes;
use App\modeles\prescription_constantes;  
use Carbon\Carbon;
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
  public function store(Request $request)
  {
    $input = $request->all();
    $input['date'] = Carbon::now() ;
      Constantes::create($input);
      return redirect()->back()->with('succes', 'prescription inserer avec success');  
  }

}
