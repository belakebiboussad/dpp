<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class facteurRisqueGeneral extends Model
{
	public $timestamps = false;
  	protected $table = 'bedAffectation';
  	protected $fillable  = ['tabac','exercice','enolysme','regime','drogue','sedentarite','statut_fam','Habita','professionnel','Autre','patient_id'];
  	protected $casts = [
	        'tabac' => 'boolean',
	        'exercice' => 'boolean',
	         'regime' => 'boolean',
	        'enolysme' => 'boolean',
	        'drogue' => 'boolean',
	        'sedentarite' => 'boolean'
   	 ];
   	 public function patient()
  	{
  		return $this->belongsTo('App\modeles\patient','patient_id');
  	}
}