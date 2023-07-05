<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Dispositif;
class DispositifController extends Controller
{
      public function index()
      {
             $produits = Dispositif::all();
              return $produits;
      }
}
