<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Transfert extends Model
{
   	public $timestamps = false;
 	protected $fillable = ['structure','motif','hosp_id'];
 	public function hospitalisation()
	{
	   	return $this->belongsTo('App\modeles\hospitalisation','hosp_id');
	}
}