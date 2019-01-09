<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\modeles\examenbiologique;
use Jenssegers\Date\Date;
use App\modeles\patient;
use App\modeles\antecedant;
use App\modeles\consultation;
use App\modeles\Lieuconsultation;
use App\modeles\codesim;
use Illuminate\Support\Facades\Auth;

class ExamenbioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        dd('je suis la');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$consultID){
             //save examen biologique autre 
            if($request->AutreBiol != null)
             {
                $tags = explode(",", $request->AutreBiol);
                foreach($tags as $k=>$v){    
                     examenbiologique::create([
                                "id_consultation"=>$consultID,
                                "classe"=>"Autre",
                                "nom"=>$v
                            ]);
                    }
            }
             if($request->exambio != null)
            {
                 foreach($request->exambio as $k=>$v){  
                      foreach($v as $value)
                    {
                             examenbiologique::create([
                                "id_consultation"=>$consultID,
                                "classe"=>$k,
                                "nom"=>$value,
                            ]);
                        }
                 }
              }
    }
    public function storeOLD1(Request $request){
           $input = $request->all();
           unset($input['_token']);
           unset($input['cons_id']); 
           unset($input['tags']);         
           if($request->tags != null)
           {
                $tags = explode(",", $request->tags);
                foreach($tags as $k=>$v){     
                     examenbiologique::create([
                                "id_consultation"=>$request->cons_id,
                                "classe"=>"Autre",
                                "nom"=>$v
                            ]);
                    }
           }
            
            foreach($input as $key=>$val){ 
                        foreach($val as $k=>$v){     
                           examenbiologique::create([
                                "id_consultation"=>$request->cons_id,
                                "classe"=>$key ,
                                "nom"=>$v,
                            ]);
                         }
          }
        
          $exambiols = examenbiologique::where('id_consultation', '=',$request->cons_id)->get();
           $consultation = consultation::FindOrFail($request->cons_id); 
           $patient = patient::FindOrFail($consultation->Patient_ID_Patient); 
           $lieu = Lieuconsultation::FindOrFail($consultation->id_lieu)->Nom;
           $antecedants = antecedant::where('Patient_ID_Patient',$patient->id)->get();
           $examsbiostr =array();
           $exambioAutre  = array();
           
           foreach($exambiols as $key =>$exambio)
           {
                if( $exambio->classe != 'Autre')
                       array_push($examsbiostr,$exambio['nom']);
                else
                    array_push($exambioAutre,$exambio['nom']);
           } 
           return view('Consultations.create_consultation',compact('patient','lieus','codesim','antecedants','lieu','consultation','examsbiostr','exambioAutre'));

    }
    public function storeold(Request $request)
    {
        $date = Date::Now();
        $fileName = $request->file('examan')->getClientOriginalName();
        Storage::disk('local')->put($fileName,file_get_contents($request->file('examan')->getRealPath()));
        examenbiologique::create([
            "type"=>$request->type,
            "description"=>$request->description,
            "lien"=>$fileName,
            "Date"=>$date,
            "id_consultation"=>$request->cons_id,
        ]);
        return redirect()->action('ConsultationsController@show',['id'=>$request->cons_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
