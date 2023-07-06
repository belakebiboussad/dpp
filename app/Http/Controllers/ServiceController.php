<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\modeles\service;
use App\modeles\Specialite;
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
    public function service_credential_rules(array $data)
    {
      $validator = Validator::make($data, [
        'nom' =>"required|unique:services|max:255",//'responsable_id' =>"required",
      ]);
      return $validator;
    }  
    public function index(Request $request)
    {
      if($request->ajax())  
      {
        $service = service::FindOrFail($request->id);
        return $service->salles()->whereNull('etat')->get();
      }else
      {
        $services = service::with('responsable')->get();
        return view('services.index', compact('services'));
      } 
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
                      $q->whereIn('id',[1,5,10,11,12,13,14]);
                  })->get();
      
      return view("services.ajax_add",compact('users','services'))->render();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = $this->service_credential_rules($request->all());
      if($validator->fails())
         return response()->json(['errors'=>$validator->errors()->all()]);
      $service = service::create($request->all()); 
      if($request->ajax())
        return response()->json(['success' => "Services crée avec suuccés",'service'=> $service->load('responsable')]);
      else
        return redirect()->action('ServiceController@index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,service $service)
    {
      return view("services.ajax_show",compact('service'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function edit(Request $request,service $service)
      {
        $specs = Specialite::where('type',$service->type)->get();
        if($service->type != 2)
           $users = User::whereHas('employ', function($q) use($service) {
                            $q->where('service_id',$service->id);
                        })->whereIn('role_id',[1,5,10,11,12,13,14])->get();
        else
           $users = User::whereHas('employ', function($q) use($service) {
                            $q->where('service_id',$service->id);
                        })->get();
        return view("services.ajax_edit",compact('service','users','specs'))->render();
      }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function update(Request $request, service $service)
      { 
        if(isset($service->responsable_id) && (isset($request->responsable_id)))
        {
          if($request->responsable_id != $service->responsable_id)
          {
            $service->responsable->User->update(['role_id'=>1]);
            $service->responsable->User->save();
            $employ = employ::FindOrFail($request->responsable_id);
            $employ->User->update(['role_id'=>14]);
            $employ->User->save();
          } 
        } 
        $input = $request->all();
        $input['hebergement'] = isset($request->hebergement)? $request->hebergement : null;
        $input['urgence'] = isset($request->urgence)? $request->urgence : null;
        $service->update($input);
        return response()->json(['success' => "Services modifié avec suuccés",'service'=> $service->load('responsable')]);
      }
      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy(Request $request,service $service)
      {
        $service->delete();
        return $service->id;
      }
      public function getsalles($id)
      { 
        $salles = salle::where('service_id',$id)->whereNull('etat')->get();
        return $salles;
      }
}