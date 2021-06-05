<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\rol;
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
        return view('role.index_role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create_role');
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
        return view('role.index_role',compact('roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $role = rol::FindOrFail($id);
           return view('role.show_role', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = rol::FindOrFail($id);
        return view('role.edit_role', compact('role'));
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
       $role = rol::FindOrFail($id);  
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
    public function destroy($id)
    {
        //
    }
}
