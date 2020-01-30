<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Acte extends Model
{
    //
	public $timestamps = false;
  protected $fillable  = ['nom','id_visite','description','duree','periodes'];
 //  public  $casts = [
 //   'periodes' => 'array'
	// ];
}
