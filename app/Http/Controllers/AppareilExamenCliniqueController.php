<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\consultation;
class AppareilExamenCliniqueController extends Controller
{
    	public function __construct()
      {
         	 $this->middleware('auth');
      }
      public function store(Request $request)
      {
        if($request->ajax())  
        { 
          $consultation = consultation::FindOrFail($request->cons_id);
          $consultation->examsAppareil()->attach($request->appareil_id, ['description' => $request->description]);
          return $request->appareil_id;
        }
    	}
      public function update(Request $request, $id)
      {
        $consultation = consultation::FindOrFail($request->cons_id);
        $consultation->examsAppareil()->where('appareil_id',$request->appareil_id)->update(["description"=>$request->description]);
        return $request->appareil_id;
      } 
      public function destroy(Request $request,$id)
      {
        $consultation = consultation::FindOrFail($request->cons_id);
        $consultation->examsAppareil()->detach($request->appareil_id);
        return $request->appareil_id;
      }
}

