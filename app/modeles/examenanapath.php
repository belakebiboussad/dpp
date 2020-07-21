<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class examenanapath extends Model
{
  public $timestamps = false; // protected $fillable = ['type', 'lien', 'description', 'Date', 'id_consultation'];
  protected $fillable = ['nom','id_consultation'];
  protected $table = "examenanapaths";
  public function consultation()
  {
    return $this->belongsTo('App\modeles\consultation','id_consultation');
  }
}
