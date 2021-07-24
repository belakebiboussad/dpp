<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class CRR extends Model
{
	public $timestamps = false;
	protected $table = "crrs";
	protected $fillable = ['indication','techRea','result','conclusion','demande_id','exam_id'];
	public function demandeRadio()
	{
		return $this->belongsTo('App\modeles\demandeexr','demande_id');
	}
	public function examenRadio()
	{
		return $this->belongsTo('App\modeles\examenradiologique','exam_id');
	}
}
