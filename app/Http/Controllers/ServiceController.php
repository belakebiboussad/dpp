<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\service;
 use App\User;
use  App\modeles\salle;
use  App\modeles\employ;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $services = service::with('responsable')->get();
      return view('services.index', compact('services'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $services = service::all();
      $users = User::whereHas( 'role', function($q){
                      $q->whereIn('id',[1,5,6,10,11,12,13,14]);
                  })->get();
      if($request->ajax())
      {
        $view = view("services.ajax_add",compact('users','services'))->render();
        return($view);
      }else
        return view('services.add',compact('users','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $service = service::create($request->all()); 
      if($request->ajax())
      {
         return $service->load('responsable');
      }else
        return redirect()->action('ServiceController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
      $service = service::FindOrFail($id);
      if($request->ajax())
      {
        $view = view("services.ajax_show",compact('service'))->render();
        return($view);
      }else
         return view('services.show', compact('service'));
      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function edit(Request $request,$id)
      {
        $service = service::FindOrFail($id);
        if($service->type != "2")
        {
          $employs = employ::with('User')->whereHas('User', function($q){
                           $q->where('role_id', 1)->orWhere('role_id', 14);    
                        })->where('service_id',$service->id)->get();
        }
        else
        {

         $employs = employ::where('service_id',$service->id)->get();
        } 
        if($request->ajax())
        {
          $view = view("services.ajax_edit",compact('service','employs'))->render();      
          return $view;
        }// $employs = employ::whereHas('User', function($q){//$q->where('role_id', 1)->orWhere('role_id', 14); //})->where('service_id',$service->id)->get();
        return view('services.edit', compact('service','employs'));
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
        $service = service::FindOrFail($id);
        if(isset($service->responsable_id))
        {
          if($request->responsable_id != $service->responsable_id)
          {
            $service->responsable->User->update(['role_id'=>1]);
            $service->responsable->User->save();
          } 
        } 
        $service->update($request->all()); //return redirect()->action('ServiceController@show', ['id'=>$id]);
        if(isset($request->responsable_id))
        if($request->responsable_id != $service->responsable_id)
        {
          $employ = employ::FindOrFail($request->responsable_id);
          $employ->User->update(['role_id'=>14]);
          $employ->User->save();
        }  
        return redirect()->action('ServiceController@index');
      }
      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy(Request $request,$id)
      {
        $service = service::destroy($id);
        if($request->ajax())
          return $id;
        else
          return redirect()->route('service.index');    
      }
      public function getsalles($id)
      { 
        $salles = salle::where('service_id',$id)->where('etat',null)->get();
        return $salles;
      }
}