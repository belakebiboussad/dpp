<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\patient;
use App\modeles\antecedant;
use Date;
use App\Http\Controllers\Session;
use Response;
class AntecedantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeatcd()
    {
        $message ='exemple';
        return response()->json(['response' => $message]); 
    }
    public function index($id)
    {   
        $patient = patient::FindOrFail($id);
        $atcds = antecedant::where("Patient_ID_Patient",$patient->id)->get()->all();

        return view('antecedents.index_atcd',compact('patient','atcds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_patient)
    {
        $patient = patient::FindOrFail($id_patient);
         return view('antecedents.create_antec',compact('patient'));
         // return view('consultations.Antecedant',compact('patient'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request,$id)
    // {
    
    //        if($request->Antecedant  == "Personnels" and $request->typeAntecedant  == "Pathologiques")
    //        {
           
    //            antecedant::create([
    //                 "Antecedant"=>$request->Antecedant,
    //                 "typeAntecedant"=>$request->typeAntecedant ,
    //                 "sstypeatcdc"=>$request->sstypeatcdc,
    //                 "date"=>(new Date($request->dateatcd))->format('Y-m-d'),
    //                 "descrioption"=>$request->descriptionc,
    //                 "Patient_ID_Patient"=>$id,
    //                 "tabac"=>false,
    //                 "ethylisme"=>false,
    //                 "habitudeAlim" =>""

    //             ]);
    //        }
    //        elseif($request->Antecedant == "Personnels" && $request->typeAntecedant != "Pathologiques")
    //         {
    //             if(empty($request->tabac))
    //                    $tabac = false;
    //             else
    //                    $tabac =true;
    //               if(empty($request->ethylisme))
    //                      $ethylisme = false;
    //               else
    //                      $ethylisme =true;
    //             antecedant::create([
    //                 "Antecedant"=>$request->Antecedant,
    //                 "typeAntecedant"=>$request->typeAntecedant,
    //                 "sstypeatcdc"=>null,
    //                 "date"=>(new Date($request->dateatcd))->format('Y-m-d'),
    //                 "descrioption"=>$request->description,
    //                 "Patient_ID_Patient"=>$id,
    //                 "tabac"=>$tabac,
    //                 "ethylisme"=>$ethylisme,
    //                 "habitudeAlim" =>$request->habitudeAlim
    //             ]);
    //         }
    //         elseif ($request->Antecedant != "Personnels") {

    //             antecedant::create([
    //                 "Antecedant"=>$request->Antecedant,
    //                 "typeAntecedant"=>null,
    //                 "stypeatcd"=>null,
    //                 "date"=>(new Date($request->dateatcd))->format('Y-m-d'),
    //                 "descrioption"=>$request->description,
    //                 "Patient_ID_Patient"=>$id,
    //                 "habitudeAlim" =>"",
    //             ]);
    //     }
      
    //     flash('Antécédent ajouter avec succès vous pouvez ajouter des autres')->success();

    //     if(empty($request->cons_id))
          
    //       return redirect()->action('AntecedantsController@choixpatatcd');
    //     else
    //        return redirect()->action('ConsultationsController@show',['id'=>$request->cons_id]);
    // }
    public function store(Request $request)
    {
      $atcd =antecedant::create($request->all());
      return Response::json($atcd);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atcd = antecedant::FindOrFail($id);
        $id_patient = $atcd->Patient_ID_Patient;
        $patient = patient::FindOrFail($id_patient);
        return view('antecedents.show_atcd',compact('atcd','patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atcd = antecedant::FindOrFail($id);
        $patient = patient::FindOrFail($atcd->Patient_ID_Patient);
        return view('antecedents.edit_atcd',compact('atcd','patient'));
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
        $atcd = antecedant::FindOrFail($id);
        if($request->type_atcd === "Personnels")
            {
                $atcd->update([
                    "Antecedant"=>$request->type_atcd,
                    "typeAntecedant"=>$request->sous_type_atcd,
                    "date"=>$request->dateatcd,
                    "descrioption"=>$request->description
                ]);  
            }
        else
            {
                $atcd->update([
                    "Antecedant"=>$request->type_atcd,
                    "typeAntecedant"=>null,
                    "date"=>$request->dateatcd,
                    "descrioption"=>$request->description
                ]);  
            }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $atcd = antecedant::FindOrFail($id);
        $patient = patient::FindOrFail($atcd->Patient_ID_Patient);
        antecedant::destroy($id);
        return redirect()->action('AntecedantsController@index',['id'=>$patient->id]);
    }
    public function createATCDAjax(Request $request){
          $typeAntecedant = $_POST['typeAntecedant'];
           if($typeAntecedant == "Pathologiques")
           {
                antecedant::create([ "typeAntecedant"=>$_POST['typeAntecedant'],
                            "Antecedant"=>$_POST['antecedant'],
                            "typeAntecedant"=>$_POST['typeAntecedant'],
                            "stypeatcd"=>$_POST['soustype'],
                            "date"=>(new Date($_POST['dateATCD']))->format('Y-m-d'),
                            "descrioption"=>$_POST['description'],
                            "Patient_ID_Patient"=>$_POST['patientid'],
                    ]);
           }
           else{
                      if($typeAntecedant == "Physiologiques")
                      {
                        antecedant::create([
                              "Antecedant"=>$_POST['antecedant'],
                              "typeAntecedant"=>$_POST['typeAntecedant'],
                              "habitudeAlim" =>$_POST['habitudeAlim'],
                              "date"=>(new Date($_POST['dateATCD']))->format('Y-m-d'),
                              "descrioption"=>$_POST['description'],
                              "Patient_ID_Patient"=>$_POST['patientid'],
                              "tabac"=>$_POST['tabac'],
                             "ethylisme"=>$_POST['ethylisme'],
                        ]);
                      }else
                      {
                            antecedant::create(["Antecedant"=>$_POST['antecedant'],
                                "date"=>(new Date($_POST['dateATCD']))->format('Y-m-d'),
                               "descrioption"=>$_POST['description'],
                                "Patient_ID_Patient"=>$_POST['patientid'],
                          ]);
                      }     
           }
    }
}
