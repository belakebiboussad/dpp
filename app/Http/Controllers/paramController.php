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
use App\modeles\ModeHospitalisation;
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
        $specialite_id = (Auth::user()->role_id == 13 || (is_null(Auth::user()->employ->specialite))) ? 16 : Auth::user()->employ->specialite;
        $specialite  = specialite::FindOrFail($specialite_id);
        $consConsts = json_decode($specialite->consConst, true);
        $hospConsts = json_decode($specialite->hospConst, true);
        $specExamsBio = json_decode($specialite->exmsbio, true);
        $specExamsImg = json_decode($specialite->exmsImg, true);
        $specAntecTypes = json_decode($specialite->antecTypes, true);
        $specvaccins = json_decode($specialite->vaccins, true);
        $specappreils = json_decode($specialite->appareils, true);
        $modesHosp = ModeHospitalisation::all(); 
        return view('parametres.medicale.index',compact('specialite','consts','consConsts','hospConsts','specialites','specExamsBio','specExamsImg','examensImg','antecTypes','specAntecTypes','vaccins','specvaccins','specappreils','appareils','modesHosp'));
        break;
      case 4:
      case 8://dir
        $parametres = Auth::user()->role->Parameters;
        return view('parametres.administratif.index');//,compact('parametres')
        break;
    }
  }   
  public function store(Request $request)
  {
    foreach (Auth::user()->role->Parameters as $key => $param) {
      if(in_array($param->nom, $request->keys()))
      {
        $nomv = $param->nom;
        $param->update(['value'=>$request->$nomv ]);
      }else
         $param->update(['value'=>null ]); 
    }
    switch (Auth::user()->role_id) {/*case 4://admincase 8://direc foreach (Auth::user()->role->Parameters as $key => $param) {
if(in_array($param->nom, $request->keys())){$nomv = $param->nom;$param->update(['value'=>$request->$nomv ]); }}break; */
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
        $input['dhValid'] = $request->dhValid;
        $specialite->update($input);
        if(Auth::user()->role_id == 13)
        {
          $modesHosp = ModeHospitalisation::all();
          foreach($modesHosp as $mode) { //$mode = ModeHospitalisation::FindOrFail($id);
           if(in_array($mode->id, $request->hospModes))
              $mode->update(["selected"=>1]);
            else
              $mode->update(["selected"=>null]);
          }
        } 

        break;
    }  
    return redirect()->to('/home');
  }           
}
