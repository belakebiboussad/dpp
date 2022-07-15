<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\examAppareil;
class AppareilExamenCliniqueController extends Controller
{
    	public function __construct()
      {
         	 $this->middleware('auth');
      }
     	//public function index(Request $request){dd($request);}//public function store(Request $request, $ExamClinID, $appareilID, $Desccrip)
      public function store(Request $request)
      {
        if($request->ajax())  
        { 
          $examApp =examAppareil::firstOrCreate($request->all());
          return $examApp;
        }else
     		  $a =examAppareil::firstOrCreate([
    		        "appareil_id"=>$appareilID,
    		        "cons_id"=>$ExamClinID,
    		        "description"=>$Desccrip,
    		 ]);
    	}
      public function update(Request $request, $id)
      {
        examAppareil::where('appareil_id', $id)->where('cons_id', $request->cons_id)
                               ->update($request->all());//
        $examApp = examAppareil::where('appareil_id', $id)->where('cons_id', $request->cons_id)->first();
        return $examApp;
      } 
      public function destroy(Request $request,$id)
      {
        $examApp = examAppareil::where('appareil_id',$id)->where('cons_id', $request->cons_id)->first();
        $examApp->delete();
        return $examApp;
      }
}

