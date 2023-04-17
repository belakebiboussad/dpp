<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class specialite_produit extends Model
{
    public $timestamps = false;
    protected $table = "specialite_produit";
    protected $fillable = ['id_gamme','nom'];
    public function drugs()
    {
      return $this->hasMany('App\modeles\medcamte','id_specialite');
    }
}
