<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\modeles\service;
use App\modeles\typeService;
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
      $services = service::all();
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
       $types = typeService::all();
      $users = User::whereHas(
        'role', function($q){
            $q->where('id', 1)->orWhere('id', 5)->orWhere('id', 6);
        }
      )->get();
      return view('services.create',compact('users','services','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      service::create([
          "nom"=>$request->nom,
          "Type"=>$request->type,
          "responsable_id"=>$request->responsable,

      ]);
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
      $services = service::all();
      $types = typeService::all();
      $users = User::whereHas(
        'role', function($q){
            $q->where('id', 1)->orWhere('id', 5)->orWhere('id', 6);
        }
      )->get();
      return view('services.create',compact('service','users','services','types'));
        //return view('services.edit_service', compact('service'));
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
        $service->update([
            "nom"=>$request->nom,
        ]);
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
    public function getRooms(Request $request)
    {
      $salles = salle::where('service_id',$request->search)->get();// return $salles;// $service = service::FindOrFail($id); //  return response()->json($service);// //return response()->json($service->salles);
      $view = view("services.ajax_servicerooms",compact('salles'))->render();
      return response()->json(['html'=>$view]);
    }
}
