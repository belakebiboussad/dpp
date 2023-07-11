<?php
namespace App\Http\Controllers;
use App\modeles\assur;
use Illuminate\Http\Request;
use App\modeles\Wilaya;
use App\Traits\AssureSearch;
use Carbon\Carbon;
use DateTime;
use Auth;
use \COM;
class AssurController extends Controller
{
    use AssureSearch;    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
      $assure = assur::create([
        "Nom"=>$request->nomf,"Prenom"=>$request->prenomf,
        "dob"=>$request->iddobf,"pob"=>$request->pobf,
        "Sexe"=>$request->sexef,"adresse"=>$request->adressef,
        "commune_res"=>$request->idcommunef,
        "gs"=>$request->gsf.$request->rhf,"NSS"=>$request->nss
      ]);
    }
    /**
     * //je stock l'assure obtenue de GRH  
     */
    public function save($obj, $date,$sf)
    {
      $assure = new assur;
      $assure->Nom = $obj->Nom; $assure->Prenom = $obj->Prenom;
      $assure->dob = $date;$assure->Sexe = $obj->Genre;
      $assure->sf =$sf; $assure->adresse = utf8_encode($obj->Adresse);
      $assure->gs = $obj->GroupeSanguin;$assure->NSS = $obj->NSS;
      $assure->Service =utf8_encode($obj->Service);
      $assure->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\modeles\assur  $assur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $assure = assur::find($id);
      $assure -> update([
        "Nom"=>$request->nomf,"Prenom"=>$request->prenomf,
        "dob"=>$request->dobf,"pob"=>$request->pobf,
        "Sexe"=>$request->sexef,"adresse"=>$request->adressef,
        "commune_res"=>$request->idcommunef,
        "gs"=>$request->gsf.$request->rhf,
        "NSS"=>$request->nss
      ]); //return redirect(Route('assur.show',$assure->id));
    }
    public function  updateAssure($situationFamille,  $adresse, $service , $NSS)
    {
      $assure = assur::find($NSS);
      $assure->update([
          "sf"=>$situationFamille,
          "adresse"=>$adresse,
          "Service"=>$service
      ]);
    }
  }