<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\modeles\Reactif;
class ReactifController extends Controller
{
     public function index()
      {
             $produits = Reactif::all();
              return $produits;
      }
}
