<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\rol;
use Session;
class RolesController extends Controller
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
        $roles = rol::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if($request->ajax())  
      {
        $view = view("role.ajax_add")->render();
        return($view);
      }else
       return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
           "nom" => 'required|min:3',
      ]);
      $role =  rol::FirstOrCreate([
          "nom"=>$request->nom,
          "type"=>$request->type,
      ]); //$roles = rol::all(); // Session::flash('message','Rôle crée avec succès'); 
      if($request->ajax())
        return $role;
      else
        return view('role.show',compact('role'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(rol $role)//
    {
       return view('role.show', compact('role'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(rol $role)
    { 
      $view = view("role.ajax_add",compact('role'))->render();      
      return $view;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,rol $role)// 
    {
      // $request->validate([
      //     "nom" => 'required|min:3',
      //     "type" => 'required',
      // ]);
      return $request;
      $role->update([
         "role"=>$request->nom,
         "type"=>$request->type,
      ]);
      return $role;
      //return redirect(Route('role.index'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy(rol $role)
      {
        $role->delete();
        $roles = rol::all();
        return view('role.index',compact('roles'));  // return redirect(Route('role.index'))->withSuccess('Rôle supprimé avec succès!');
      }
}
