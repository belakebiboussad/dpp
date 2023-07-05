<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Consommable;
class ConsommableController extends Controller
{
       public function index()
      {
             $produits = Consommable::all();
              return $produits;
      }
}
