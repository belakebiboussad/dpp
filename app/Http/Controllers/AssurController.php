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
                  // $assures = assur::where('Nom','LIKE','%'.trim($request->matricule)."%")->orwhere('NSS','LIKE','%'.trim($request->nss)."%")->get();
                   $assures = assur::where('Nom', 'like', '%' . request('matricule') . '%')
                                              ->orwhere('Prenom', 'like', '%' . request('nss') . '%')->paginate(5);
                    if($assures)
                       {
                        return Response::json($assures); 
                       }
                {
        }
    }
}
