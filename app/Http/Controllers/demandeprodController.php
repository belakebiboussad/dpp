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
        $demandes = demand_produits::where('Etat','E')->get();//all();
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
      $demande = demand_produits::FirstOrCreate([
          "Date" => $date,
          "Etat" => "E",
          "id_employe" => Auth::user()->employee_id,
      ]);
      dd($request->liste);
      $listes = json_decode($request->liste);
      for ($i=1; $i < count($listes); $i++) { 
        $gamme = gamme::where('nom',$listes[$i]->gamme)->get()->first();
        if($gamme->id == "1")
        {
          $produit = medcamte::where("nom",$listes[$i]->produit)->get()->first();
          $demande->medicaments()->attach($produit->id, ['qte' => $listes[$i]->qte]);
        }
        elseif($gamme->id == "2") {
          $produit = dispositif::where('nom',$listes[$i]->produit)->get()->first();
          $demande->dispositifs()->attach($produit->id, ['qte' => $listes[$i]->qte]);
        }
        elseif($gamme->id == "3") {
          $produit = reactif::where('nom',$listes[$i]->produit)->get()->first();
          $demande->reactifs()->attach($produit->id, ['qte' => $listes[$i]->qte]);
        }
      }
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
      // $demande = demand_produits::FindOrFail($id);return view('demandeproduits.edit', compact('demande')); 
      $gammes = gamme::all();
      $specialites = specialite_produit::all();
      $demande = demand_produits::FindOrFail($id);
      return view('demandeproduits.edit', compact('gammes','specialites','demande'));
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
      // $demande = demand_produits::FindOrFail($id);
      // $demande->update([
      //     "Etat" => $request->avis,
      //     "motif" => $request->motif
      // ]);
      // return redirect()->action('demandeprodController@details_demande', [ 'id' => $demande->id ]);
      $listes = json_decode($request->liste);
      dd($request->liste);
      for ($i=0; $i < count($listes); $i++) { 
        $gamme = gamme::where('nom',$listes[$i]->gamme)->get()->first();
        dd($gamme);
      }
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
    public function details_demande($id)
    {
        $demande = demand_produits::FindOrFail($id);
        return view('demandeproduits.details_demande', compact('demande'));
    }
}
