<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class colloque extends Model
{
    public $timestamps = false;
    protected $fillable  = ['id','date_colloque','etat_colloque','date_creation','type_colloque'];
    public function Type()
    {
     	return $this->belongsTo('App\modeles\type_colloque','type_colloque');
    }
    public function membres()
    {
    	return $this->belongsToMany ('App\modeles\employ','membres' ,'id_colloque','id_employ');
    }
    public function demandes()
    {
    	return $this->belongsToMany('App\modeles\DemandeHospitalisation','dem_colloques' ,'id_colloque','	id_demande');
    }

}
