<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
    public function rol_credential_rules(array $data)
    {
      $validator = Validator::make($data, [
        'nom' =>"required|unique:rols|max:255",
      ]);
       return $validator;
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
      $validator = $this->rol_credential_rules($request->all());
      if($validator->fails())
        return response()->json(['errors'=>$validator->errors()->all()]);
      $role =  rol::FirstOrCreate([
          "nom"=>$request->nom,
          "type"=>$request->type,
      ]);
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
    public function show(rol $role)
    {
      $view = view("role.ajax_show",compact('role'))->render();
      return($view);  
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(rol $role)
    { 
      $view = view("role.ajax_edit",compact('role'))->render();      
      return $view;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,rol $role)
    {
      $validator = $this->rol_credential_rules($request->all());
      if($validator->fails())
        return response()->json(['errors'=>$validator->errors()->all()]);//Log::info('Response:', $request->all());
      $role->update([ "nom"=>$request->nom, "type"=>$request->type]);
        return $role;//return redirect(Route('role.index'));   
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy(rol $role)
      {
        $errors = [];
        if($role->users->count() > 0)
        {
          array_push($errors, 'le role contient des utilisateurs');
          return response()->json(['errors'=>$errors]); 
        }
        $role->delete();
        return $role->id;
      }
}
