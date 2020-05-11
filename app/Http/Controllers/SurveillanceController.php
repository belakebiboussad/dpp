<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\surveillance;
use App\modeles\consigne;
use Illuminate\Support\Facades\Auth;


class SurveillanceController extends Controller
{
    //
	 public function Store(Request $request,$id)
    {

    	         $s=new surveillance;
               $s->id_consigne=$request->idcons;
               $s->date=$request->datesur;
               $s->heure=$request->heuresur;
               $s->app=$request->ap;
               $s->description=$request->desc;
               $s->observation=$request->obs;
               $s->id_employe=Auth::User()->employee_id;
               $s->save();

      //  return view('surveillance.create_surveillance');
            /*  $cpt = surveillance::select(['date'])->
                       where([['id_consigne','=',$request->idcons],['date','<',date('Y-m-d')]]) 
                     ->groupBy('date')
                     ->get();
                     $i=0;

                     foreach($cpt as $c) { $i=$i+1;}


              $consigne=consigne::FindOrFail($request->idcons);
              if($consigne->duree==$i)
              {
              
                 $consigne->update([
                     "app"=>'Oui'
                 ]);


              }
                  */              
     
    return back()->with('message','Surveillance ajoutée avec succès!');
      //return redirect('/patient/listecons/'$request->idvis)->with('info','Visite ajoutée avec succès!'); 
      // return redirect('/patient/listecons')->with(['id'=>$request->idvis,'succes' => 'Alread Apply for this post']);
      // return redirect()->route('/patient/listecons')->withErrors(compact('state'));        
    }
}
