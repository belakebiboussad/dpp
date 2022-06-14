<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;

class CertificatDescriptif extends Model
{
  public $timestamps = false;
  protected $fillable  = ['examen','consultation_id',];
  protected $table="cetificats_discriptif";
  public function consultation()
  {
    return $this->belongsTo('App\modeles\consultation','consultation_id');
  }
}
