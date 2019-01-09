<?php
namespace App\Http\Controllers;

use App\modeles\employ;
use Illuminate\Http\Request;
use App\User;
class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function update(Request $request, employ $employ)
    {
        //
         $employe = employ::FindOrFail($employ->id);

       //  dd($request->datenaissance);
         $request->validate([
            "nom"=> "required | max:120",
            "prenom"=> "required|alpha_num",
            "datenaissance"=> "required | date",
            "lieunaissance"=> "required",
            "sexe"=> "required",
            "adresse"=> "required",
            "mobile"=> "required | regex:/[0][567][0-9]{8}/",
            "fixe"=> "numeric | regex:/[0][0-9]{8}/",
            "mat"=> "required",
            "service"=> "required",          
            "nss"=> "required | regex:/[0-9]{14}/",
            'specialite'=>"required",
        ]);
           $employe->update([
            "Nom_Employe"=>$request->nom,
            "Prenom_Employe"=>$request->prenom,
            "Sexe_Employe"=>$request->sexe,
            "Date_Naiss_Employe"=>$request->datenaissance,
            "Lieu_Naissance_Employe"=>$request->lieunaissance,
            "Adresse_Employe"=>$request->adresse,
            "Tele_fixe"=>$request->fixe,
            "tele_mobile"=>$request->mobile,
            "Specialite_Emploiye"=>$request->specialite,
            "Service_Employe"=>$request->service,
            "Matricule_dgsn"=>$request->mat,
            "NSS"=>$request->nss,
        ]);
           // get user id
           $user = User::where("employee_id",$employe->id)
                           ->get(['id'])->first();
           return redirect(Route('users.show',$user->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\modeles\employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function destroy(employ $employ)
    {
        //
    }
}
