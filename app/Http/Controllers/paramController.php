<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\modeles\Specialite;
use App\modeles\specialite_exb;
use App\modeles\TypeExam;
class paramController extends Controller
{
	public function index()
	{
  		$specialites = specialite_exb::all();
  		$examensImg = TypeExam::all();//CT,RMN
  		$specExamsBio = (specialite::FindOrFail(Auth::user()->employ->specialite))->exmsbio;
  		$specExamsImg = (specialite::FindOrFail(Auth::user()->employ->specialite))->exmsImg;
  		return view('parametres.index',compact('specialites','specExamsBio','specExamsImg','examensImg'));
  	}
  	public function store(Request $request)
      {
      		$specialite = specialite::FindOrFail(Auth::user()->employ->specialite);
      		$input = $request->all();
      		$input['exmsbio'] = $request->input('exmsbio');
      		$input['exmsImg'] = $request->input('exmsImg');
      		$specialite->update($input);
      		return redirect()->action('paramController@index'); 
      }    
}
