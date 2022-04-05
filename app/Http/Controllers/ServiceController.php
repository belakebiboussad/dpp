<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\service;
use App\user;
use  App\modeles\salle;
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
    public function create()
    {
      $services = service::all();
      $users = User::whereHas(
        'role', function($q){//$q->where('id', 1)->orWhere('id', 5)->orWhere('id', 6);
          $q->whereIn('id',[1,5,6,10,11,12,13,14]);
        })->get();
      return view('services.add',compact('users','services','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      service::create($request->all());
      return redirect()->action('ServiceController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $service = service::FindOrFail($id);
      return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function edit($id)
      {
        $service = service::FindOrFail($id);
          $users = User::whereHas(
        'role', function($q){
                $q->where('id', 1)->orWhere('id', 5)->orWhere('id', 6);
          })->get();
        return view('services.edit', compact('service','users'));
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
        $service->update($request->all());
        return redirect()->action('ServiceController@show', ['id'=>$id]);
      }
      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
        $service = service::destroy($id);
        return redirect()->route('service.index');    
      }
      public function getsalles($id)
      { 
        $salles = salle::where('service_id',$id)->where('etat',null)->get();
        return $salles;
      }
}