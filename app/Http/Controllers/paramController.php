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
use App\modeles\Parametre;
use Config;
class paramController extends Controller
{
	public function index()
	{
    switch (Auth::user()->role_id) {
      case 14:
      case 13:
        $consts = Constante::all();
        $specialites = specialite_exb::all();
      	$examensImg = TypeExam::all();
        $vaccins = Vaccin::all();
        $antecTypes = antecType::orderBy('id')->get();
        $appareils = appareil::orderBy('id')->get();
        $specialite = (Auth::user()->role_id == 13) ? 16 :Auth::user()->employ->specialite;
        $consConsts = json_decode((specialite::FindOrFail($specialite))->consConst, true);
        $hospConsts = json_decode((specialite::FindOrFail($specialite))->hospConst, true);
        $specExamsBio = json_decode((specialite::FindOrFail($specialite))->exmsbio, true);
        $specExamsImg = json_decode((specialite::FindOrFail($specialite))->exmsImg, true);
        $specAntecTypes = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->antecTypes, true);
        $specvaccins = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->vaccins, true);
        $specappreils = json_decode((specialite::FindOrFail(Auth::user()->employ->specialite))->appareils, true);
        return view('parametres.medicale.index',compact('consts','consConsts','hospConsts','specialites','specExamsBio','specExamsImg','examensImg','antecTypes','specAntecTypes','vaccins','specvaccins','specappreils','appareils'));
        break;
      case 4:
      case 8:
        $parametres =  Parametre::all();
        return view('parametres.administratif.index',compact('parametres'));
        break;
    }
  }   
  public function store(Request $request)
  {
    switch (Auth::user()->role_id) {
      case 4://admin
      case 8://direc
        $parametres =  Parametre::all();
        foreach ($parametres as $key => $param) {
          if(in_array($param->nom, $request->keys()))
          {
            $nomv = $param->nom;
            $param->update(['value'=>$request->$nomv]);
          }
        }
        break;
      case 13://med chef
      case 14://chef de service
        $specialite = (Auth::user()->role_id == 13) ? 16 :Auth::user()->employ->specialite;
        $specialite = specialite::FindOrFail($specialite);
        $input = $request->all();
        $input['consConst'] = $request->consConsts;
        $input['hospConst'] = $request->hospConsts;
        $input['exmsbio'] = $request->exmsbio;
        $input['exmsImg'] = $request->exmsImg;
        $input['antecTypes'] = $request->antecTypes;
        $input['vaccins'] = $request->vaccs;
        $input['appareils'] = $request->appareils;
        $specialite->update($input);
        break;
    }  
    return redirect()->action('paramController@index');
  }           
}
