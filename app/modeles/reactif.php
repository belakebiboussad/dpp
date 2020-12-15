<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class reactif extends Model
{
  	public $timestamps = false; //protected $fillable = ['id_gamme','id_specialite','code_produit','dci'];
    protected $fillable = ['nom','code'];
}
