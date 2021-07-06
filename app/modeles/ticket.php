<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    public $timestamps = false;
    protected $fillable = ['date', 'specialite', 'type_consultation', 'document', 'num_order', 'id_patient'];
    public function Specialite()
    {
    	return $this->belongsTo('App\modeles\Specialite','specialite');
    } 
    public function Patient()
    {
        return $this->belongsTo('App\modeles\patient','id_patient');
    } 
}
