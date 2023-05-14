<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\modeles\Constante;
use App\modeles\Specialite;
use App\modeles\specialite_exb;
use App\modeles\antecType;
use App\modeles\Appareil;
use App\modeles\TypeExam;
use App\modeles\Vaccin;
use App\modeles\Parametre;
use App\modeles\param_specialite;
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
        $specialite_id = (Auth::user()->is(13) || (is_null(Auth::user()->employ->specialite))) ? 16 : Auth::user()->employ->specialite;
        $specialite  = specialite::FindOrFail($specialite_id);
        $specvaccins = json_decode($specialite->vaccins, true);
        $modesHosp = ModeHospitalisation::all(); 
        return view('parametres.medicale.index',compact('specialite','consts','specialites','specExamsImg','examensImg','antecTypes','vaccins','specvaccins','appareils','modesHosp'));
        break;
      case 4:
      case 8://dir
        return view('parametres.administratif.index');
        break;
    }
  }   
  public function store(Request $request)
  {
    switch (Auth::user()->role_id) {
      case 4:
      case 8:
        foreach (Auth::user()->role->Parameters as $key => $param) {
            $param->update(['value'=>isset($request[$param->parametre->nom])?$request[$param->parametre->nom]:null]);
        }
        break;
      case 13://med chef
      case 14://chef de service

        //foreach (Auth::user()->employ->Specialite->Parameters as $key => $param) {
        foreach (Auth::user()->role->Parameters as $key => $param) {
           //Auth::user()->employ->Specialite->Parameters->where('param_id', $param->param_id)->updateOrCreate(['value'=>isset($request[$param->parametre->nom])?$request[$param->parametre->nom]:null]);
           $prm = Auth::user()->employ->Specialite->Parameters->where('param_id', $param->param_id)->first();
           if(is_null($prm))
           {
              Auth::user()->employ->Specialite->Parameters()->create([
                'param_id' =>$param->Parametre->id,
                'value' => isset($request[$param->parametre->nom])? $request[$param->parametre->nom]:null
              ]);
           }else
           {
              $prm->update([
                'value' => isset($request[$param->parametre->nom])? $request[$param->parametre->nom]:null
              ]);
           }
          // $param->update(['value'=>isset($request[$param->parametre->nom])?$request[$param->parametre->nom]:null]);
        }
        $specialite = (Auth::user()->is(13)) ? 16 :Auth::user()->employ->specialite;
        $specialite = specialite::FindOrFail($specialite);
        $input = $request->all();
        $specialite->Consts()->sync($request->consts);
        $specialite->BioExams()->sync($request->exmsbio);
        $specialite->ImgExams()->sync($request->exmsImg);
        $specialite->appareils()->sync($request->appareils);
        $specialite->antecTypes()->sync($request->antecTypes);
        $input['vaccins'] = $request->vaccs;
        $input['dhValid'] = $request->dhValid;
        $specialite->update($input);
        if(Auth::user()->is(13))
        {
          $modesHosp = ModeHospitalisation::all();
          foreach($modesHosp as $mode) {
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