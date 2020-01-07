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
        $services = service::all();
        return view('services.index_service', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           $membres = user::join('employs', 'utilisateurs.employee_id','=','employs.id')->join('rols','utilisateurs.role_id', '=', 'rols.id')->select('employs.id','Nom_Employe','Prenom_Employe')->where('rols.id', '=','1' )->orWhere('rols.id', '=','2' )
                  ->orWhere('rols.id', '=','5' ) ->orWhere('rols.id', '=','6' )->get(); 
           return view('services.create_service',compact('membres'));
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
              "typs"=>$request->type,
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
        return view('services.show_service', compact('service'));
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
        return view('services.edit_service', compact('service'));
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
        //
    }

    public function getRooms(Request $request)
    {
            $salles = salle::where('service_id',$request->search)->get();
            // return $salles;// $service = service::FindOrFail($id); //  return response()->json($service);// //return response()->json($service->salles);
            $view = view("services.ajax_servicerooms",compact('salles'))->render();
            return response()->json(['html'=>$view]);
    }
}
