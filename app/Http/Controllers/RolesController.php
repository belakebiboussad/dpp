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
    public function create()
    {
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
               "rolename" => 'required|min:3',
          ]);
           rol::FirstOrCreate([
              "role"=>$request->rolename,
           ]);
         $roles = rol::all();
         Session::flash('message','Rôle crée avec succès'); 
        return view('role.index',compact('roles'));
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
      return view('role.edit', compact('role'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rol $role)
    {
      $request->validate([
          "rolename" => 'required|min:3',
       ]);
       $role->update([
         "role"=>$request->rolename,
       ]);
      return redirect(Route('role.index'));   
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
        Session::flash('message','Rôle supprimé avec succès');
        return view('role.index',compact('roles'));  // return redirect(Route('role.index'))->withSuccess('Rôle supprimé avec succès!');
      }
}
