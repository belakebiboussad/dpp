<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App/modeles/homme_conf;

class HommeConfianceController extends Controller
{
    //
	public function store(Request $request)
  {

  	return( $request->patientId);
  }
  public function save()
  {
  	return('hh');
  }
}
