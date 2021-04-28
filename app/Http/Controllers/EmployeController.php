<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Response;
use App\User;
use App\modeles\employ;
use App\modeles\specialite;
class EmployeController extends Controller
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
        //
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
     * @param  \App\modeles\employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = employ::FindOrFail($id);
        //$employe = employ::with('service')->FindOrFail($id);
        return view('employe.show_employe',compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function edit(employ $employ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employid)
    {
      $employe = employ::FindOrFail($employid); 
      $request->validate([
            "nom"=> "required | max:120",
            "prenom"=> "required|max:120",
            "datenaissance"=> "required",// | date
            "lieunaissance"=> "required",
            "sexe"=> "required",
            "adresse"=> "required",
            "mobile"=> "required | regex:/[0][567][0-9]{8}/",  // "fixe"=> "numeric | regex:/[0][0-9]{8}/",       //"mat"=> "required",
            //"service"=> "required",          // "nss"=> "required | regex:/[0-9]{12}/",       //"specialite"=>"required",
      ]);
      $employe->update([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "sexe"=>$request->sexe,
            "Date_Naiss"=>$request->datenaissance,
            "Lieu_Naissance"=>$request->lieunaissance,
            "Adresse"=>$request->adresse,
            "Tele_fixe"=>$request->fixe,
            "tele_mobile"=>$request->mobile,
            "specialite"=>$request->specialite,
            "service"=>$request->service,
            "Matricule_dgsn"=>$request->mat,
            "NSS"=>$request->nss,
     ]);
      return redirect(Route('users.show',$employe->User->id));//return redirect(Route('users.show',$userID));
    }
      /**
       * Remove the specified resource from storage.
       *
       * @param  \App\modeles\employ  $employ
       * @return \Illuminate\Http\Response
       */
     // public function destroy(employ $employ)     {      }
      public function searchBySpececialite(Request $request) 
      
             $doctors =  (specialite::FindOrFail($request->specialiteId))->employes;
            return Response::json($doctors);
      }
}
