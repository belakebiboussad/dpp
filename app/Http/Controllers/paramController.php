<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\modeles\Constante;
use App\modeles\Specialite;
use App\modeles\specialite_exb;
use App\modeles\antecType;
use App\modeles\appareil;
use App\modeles\TypeExam;
use App\modeles\Vaccin;
class paramController extends Controller
{
	public function index()
	{
              $consts = Constante::all();
              $specialites = specialite_exb::all();
        	$examensImg = TypeExam::all();
               $vaccins = Vaccin::all();
               $antecTypes = antecType::orderBy('id')->get();
               $appareils = appareil::orderBy('id')->get();
              $consConsts = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->consConst, true);
              $hospConsts = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->hospConst, true);
              $specExamsBio = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->exmsbio, true);
              $specExamsImg = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->exmsImg, true);
              $specAntecTypes = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->antecTypes, true);
              $specvaccins = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->vaccins, true);
               $specappreils = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->appareils, true);
              return view('parametres.index',compact('consts','consConsts','hospConsts','specialites','specExamsBio','specExamsImg','examensImg','antecTypes','specAntecTypes','vaccins','specvaccins','specappreils','appareils'));
        }   
        public function store(Request $request)
        {
              $specialite = specialite::FindOrFail(Auth::user()->employ->specialite);
              $input = $request->all();
              $input['consConst'] = $request->consConsts;
              $input['hospConst'] = $request->hospConsts;
              $input['exmsbio'] = $request->exmsbio;
              $input['exmsImg'] = $request->exmsImg;
              $input['antecTypes'] = $request->antecTypes;
              $input['vaccins'] = $request->vaccs;
              $input['appareils'] = $request->appareils;
              $specialite->update($input);
               return redirect()->action('paramController@index');  
        }           
}
