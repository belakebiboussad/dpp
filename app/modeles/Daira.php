<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Daira extends Model
{
    //
	public $timestamps = false;
  protected $table = 'dairas';
  protected $fillable = ['nom','Id_wilaya'];
  public function wilaya()
  {
  		return $this->belongsTo('App\modeles\Wilaya','Id_wilaya');
  }
  public function communes()
  {
  		return $this->hasMany('App\modeles\Commune','Id_daira');
  }
}
