<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class facteurRisqueGeneral extends Model
{
	public $timestamps = false;
  	protected $table = 'facteurs_generaux';
  	protected $fillable  = ['exercice','regime','drogue','sedentarite','statut_fam','habitat','professionnel','autrefact','patient_id'];
  	protected $casts = [
	        'exercice' => 'boolean',
	        'regime' => 'boolean',
	        'drogue' => 'boolean',
	        'sedentarite' => 'boolean'
   	 ];
   	 public function patient()
  	{
  		return $this->belongsTo('App\modeles\Patient','patient_id');
  	}
}