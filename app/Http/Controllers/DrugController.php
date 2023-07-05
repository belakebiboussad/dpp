<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Drug;
class DrugController extends Controller
{
  public function index()
  {
      $produits = Drug::where("id_specialite", request()->id_spes)->get();
      return $produits;
  }
}
