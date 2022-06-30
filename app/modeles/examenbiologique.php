<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class examenbiologique extends Model
{
  public $timestamps = false;
  protected $table = "examenbiologiques";
  protected $fillable = ['nom', 'specialite_id'];
  public function Specialite()
  {
  	 return $this->belongsTo('App\modeles\specialite_exb','specialite_id');
  }
  public function Demande()
  {
    return $this->belongsToMany('App\modeles\demandeexb','demandeexb_examenbio', 'id_demandeexb','id_examenbio');
  }
}
