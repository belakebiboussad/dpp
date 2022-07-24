<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class BedReservation extends Model
{
    public $timestamps = true;
    protected $table = 'bedreservation';
  protected $fillable  = ['id_rdvHosp','id_lit'];
  public function lit()
  {
  	return $this->belongsTo('App\modeles\Lit','id_lit');
  }
  public function rdvHosp()
  {
  	return $this->belongsTo('App\modeles\rdv_hospitalisation','id_rdvHosp');
  }
}
