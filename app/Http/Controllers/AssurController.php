<?php

namespace App\Http\Controllers;

use App\modeles\assur;
use Illuminate\Http\Request;
use App\modeles\grade;
class AssurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('assurs.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $assure = assur::FindOrFail($id);
      return view('assurs.show',compact('assure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $assure = assur::FindOrFail($id);
      $grades = grade::all(); 
      return view('assurs.edit',compact('assure','grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $assure = assur::find($id);
      $assure -> update([
                          "Nom"=>$request->nomf,
                          "Prenom"=>$request->prenomf,
                          "Date_Naissance"=>$request->datenaissancef,
                          "lieunaissance"=>$request->idlieunaissancef,
                          "Sexe"=>$request->sexef,
                          "adresse"=>$request->adressef,
                          "commune_res"=>$request->idcommunef,
                          "wilaya_res"=>$request->idwilayaf,
                          "grp_sang"=>$request->gsf,
                          "Matricule"=>$request->matf, 
                          "Service"=>$request->service,
                          "Etat"=>$request->etatf,
                          "Grade"=>$request->grade,
                          "NMGSN"=>$request->NMGSN,
                          "NSS"=>$request->nss,
      ] );
      //$assure->save(); 
       return redirect(Route('assur.show',$assure->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function destroy(assur $assur)
    {
        //
    }
    public function search(Request $request)
    {

        if($request->ajax())  
        {
            $output="";
            $assures =   assur::where('Matricule', 'like', '%' . request('matricule') . '%')
                              ->where('NSS', 'LIKE', '%' . request('nss') . "%")->get();
            if($assures)
            {  
                $i=0; 
                foreach ($assures as $key => $assure)
                {
                    $i++;   
                    $sexe =  ($assure->Sexe =="M") ? "Homme":"Femme";   
                    $grade = (isset($assure->grade) )? $assure->grade->nom :"";
                    $output.='<tr>'.
                              '<td>'.$i.'</td>'.
                              '<td hidden>'.$assure->id.'</td>'. 
                              '<td><span class="badge">'.$assure->matricule.'</span></td>'.
                               '<td>'.$assure->NSS.'</td>'.                          
                              '<td>'.$assure->Nom.'</td>'.
                              '<td>'.$assure->Prenom.'</td>'.
                              '<td>'.$assure->Date_Naissance.'</td>'.
                              '<td>'.$sexe.'</td>'.// ["nom"]
                             '<td><span class="badge badge-success">'.$grade.'</span></td>'.
                             '<td>'.$assure->Service.'</td>'.
                              '<td class="center">'.'<a href="/assur/'.$assure->id.'" class="'.'btn btn-warning btn-xs" data-toggle="tooltip" title="Consulter" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i>&nbsp;</a>'."&nbsp;&nbsp;".'<a href="/assur/'.$assure->id.'/edit" class="'.'btn btn-info btn-xs" data-toggle="tooltip" title="modifier"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></a>'.'</td></tr>';  
                }
                return Response($output)->withHeaders(['count' => $i]);//return Response::json($assures);
                
            }else
            {

                return"no";       
            }
        }
    }
}