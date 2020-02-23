<?php

namespace App\Http\Controllers;

use App\modeles\assur;
use Illuminate\Http\Request;

class AssurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $assur = assur::FindOrFail($id);
        return view('assurs.show_assur',compact('assur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function edit(assur $assur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, assur $assur)
    {
        //
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
                    $sexe =  ($assure->Sexe =="M")?"Homme":"Femme";   
                    $output.='<tr>'.
                              '<td>'.$i.'</td>'.
                              '<td hidden>'.$assure->id.'</td>'.
                              '<td><span class="badge">'.$assure->Matricule.'</span></td>'.
                              '<td>'.$assure->NSS.'</td>'. 
                              '<td>'.$assure->Nom.'</td>'.
                              '<td>'.$assure->Prenom.'</td>'.
                              '<td>'.$assure->Date_Naissance.'</td>'.
                              '<td>'.$sexe.'</td>'.
                              '<td><span class="badge badge-success">'.$assure->etat.'</span></td>'.
                              '<td>'.$assure->service->nom.'</td>'.
                              '<td class="center">'.'<a href="/assur/'.$assure->id.'" class="'.'btn btn-warning btn-xs" data-toggle="tooltip" title="Consulter le dossier" data-placement="bottom"><i class="fa fa-hand-o-up fa-xs"></i>&nbsp;</a>'."&nbsp;&nbsp;".'<a href="/patient/'.$assure->id.'/edit" class="'.'btn btn-info btn-xs" data-toggle="tooltip" title="modifier"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></a>'.'</td>'.
                               '</tr>';
                             
                }
                return Response($output)->withHeaders(['count' => $i]);
               //return Response::json($assures); 
            }else
            {

                return"no";       
            }
        }
    }
}
