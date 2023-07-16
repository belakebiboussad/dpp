<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Drug;
use App\modeles\demand_produits;
class DrugController extends Controller
{
  public function index(Request $request)
  {
    $produits = Drug::where("id_specialite", $request->spec_id)->get();
    return $produits;
  }
  public function edit($id )
  { 
    $demande = demand_produits::find($id);
    return $demande->medicaments->load('specialite');
  }
  public function update(Request $request, $id )
  { 
    $demande = demand_produits::find($request->demande_id);
    // $demande->medicaments->meds-table_id
    // return $demande->medicaments->load('specialite');
    return $request->all();
    $demande->medicaments()->updateExistingPivot($request->id,[
        'qte'=>$request->qte,
        'unite'=>$request->unite
      ]);
    $demande->medicaments()->where(id,$request->id)->get();
    
  }
}
