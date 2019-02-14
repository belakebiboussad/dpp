<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class colloque extends Model
{
     public $timestamps = false;
     protected $fillable  = ['id','date_colloque','etat_colloque','date_creation','type_colloque'];
     public function type()
     {
     	return $this->belongsTo('App\modeles\type_colloque')->withPivot('type_colloque');
     }
}
