<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Arr;

class homme_conf extends Model
{
 
    protected $fillable  = ['id','id_patient','nom','prenom','date_naiss','lien_par','type_piece','num_piece','date_deliv','adresse','mob','etat_hc','created_by','updated_by','updated_at'];
  	public function patient()
  	{
  		return $this->belongsTo('App\modeles\patient','id_patient');
  	}	
  	 // protected $dates = [
    //     'date_naiss',
    //     'created_by'
    // ];

}
