<?php

namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\modeles\examenanapath;
class ExmAnapathController extends Model
{
    //
  	public function store(Request $request,$consultID)
        	{
        		 examenanapath::create([
                                "id_consultation"=>$consultID,
                                "nom"=>$request->examen_Anapath
                            ]);
        	}
}
