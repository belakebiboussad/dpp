<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;

class colloque extends Model
{
    public $timestamps = true;
    protected $fillable  = ['id','date','etat','type'];
    public function membres()
    {
        return $this->belongsToMany ('App\modeles\employ','membres','id_colloque','id_employ');
    }
     public function employs()
    {
        return $this->belongsToMany ('App\modeles\employ','membres','id_colloque','id_employ');
    }
    public function demandes()
    {
    	return $this->belongsToMany('App\modeles\DemandeHospitalisation','dem_colloques' ,'id_colloque','id_demande');
     }

}
