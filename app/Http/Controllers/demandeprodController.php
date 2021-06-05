<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\medcamte;
use App\modeles\dispositif;
use App\modeles\reactif;
use App\modeles\gamme;
use App\modeles\specialite_produit;
use App\modeles\demand_produits;
use App\modeles\demande_dispositif;
use App\modeles\demande_medicaments;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Date\Date;

class demandeprodController extends Controller
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
    public function get_produit($id_gamme, $id_spes)
    {
      if($id_gamme == 1)
      {
          $produits = medcamte::where("id_specialite",$id_spes)->get();
          return $produits;
      }
      elseif ($id_gamme == 2) {
          $produits = dispositif::all();
          return $produits;
      }
      elseif($id_gamme == 3)
      {
          $produits = reactif::all();
          return $produits;
      }
    }
    public function index()
    {
      if(Auth::user()->role_id == 10)
        $demandes = demand_produits::where('Etat','E')->orderBy('Date', 'desc')->get();
      else
        $demandes = demand_produits::orderBy('Date', 'desc')->get();
      return view('demandeproduits.index', compact('demandes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $gammes = gamme::all();
      $specialites = specialite_produit::all();
      return view('demandeproduits.create', compact('gammes','specialites'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $date = date('Y-m-d');
      $demande = demand_produits::Create([
          "Date" => $date,
          "Etat" => "E",
          "id_employe" => Auth::user()->employee_id,
      ]);
    
      $listes = json_decode($request->liste);
      //dd($listes);
      for ($i=1; $i < count($listes); $i++) { 
        $gamme = gamme::where('nom',$listes[$i]->gamme)->get()->first();
        //dd($gamme);
        if($gamme->id == "1")
        {
          $demande->medicaments()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
        }
        elseif($gamme->id == "2") {
          $demande->dispositifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
        }
        elseif($gamme->id == "3") {
          $demande->reactifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
        }
      }
      //dd($demande);
      return redirect()->route('demandeproduit.show',$demande->id); 
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $demande = demand_produits::FindOrFail($id);
      //dd($demande->medicaments);
      return view('demandeproduits.show', compact('demande'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $gammes = gamme::all();// $demande = demand_produits::FindOrFail($id);return view('demandeproduits.edit', compact('demande')); 
      $specialites = specialite_produit::all();
      $demande = demand_produits::FindOrFail($id);
      return view('demandeproduits.edit', compact('gammes','specialites','demande'));
    }
    public function run($id)
    {
      $demande = demand_produits::FindOrFail($id);
      return view('demandeproduits.run', compact('demande'));
    }
    public function valider(Request $request,$id)
    {
      $demande = demand_produits::FindOrFail($id);
      $listes = json_decode($request->liste);
      for ($i=0; $i < count($listes); $i++) { 
        $gamme = gamme::where('nom',trim($listes[$i]->gamme))->get()->first();
        $attributes = ['qteDonne' => $listes[$i]->qteDem];
        if($gamme->id == "1")
        {
          $demande->medicaments()->updateExistingPivot($listes[$i]->produit, $attributes);
        }elseif($gamme->id == "2") {
          $demande->dispositifs()->updateExistingPivot($listes[$i]->produit, $attributes);
        }elseif($gamme->id == "3") {
          $demande->reactifs()->updateExistingPivot($listes[$i]->produit, $attributes);
        }
      }   
      $demande->update([
        "Etat" => $request->avis,
        "motif" => $request->motif
      ]);
      return redirect()->action('demandeprodController@index');
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
      $demande = demand_produits::FindOrFail($id);
      $demande->medicaments()->detach();
      $demande->dispositifs()->detach();
      $demande->reactifs()->detach();
      $listes = json_decode($request->liste);
      for ($i=0; $i < count($listes); $i++) { 
              $gamme = gamme::where('nom',trim($listes[$i]->gamme))->get()->first();
              if($gamme->id == "1")
              {   
                  $demande->medicaments()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
              }elseif($gamme->id == "2") {
                   $demande->dispositifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
                }elseif($gamme->id == "3") {
                  $demande->reactifs()->attach($listes[$i]->produit, ['qte' => $listes[$i]->qte]);
                }
        }
       return redirect()->action('demandeprodController@show', [ 'id' => $demande->id ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $demande = demand_produits::FindOrFail($id);
      $demande->medicaments()->detach();
      $demande->dispositifs()->detach();
      $demande->reactifs()->detach();
      $demande = demand_produits::destroy($id);
      return redirect()->action('demandeprodController@index');
    }
}
