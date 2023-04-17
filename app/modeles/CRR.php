<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class CRR extends Model
{
	public $timestamps = false;
	protected $table = "crrs";
	protected $fillable = ['indication','techRea','result','conclusion','exam_id'];
	public function examenRadio()
	{
		return $this->belongsTo('App\modeles\Demande_Examenradio','exam_id');
	}
}
