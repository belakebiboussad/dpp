<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Constante extends Model
{
  public function getStepAttribute($value)
  {
    return str_replace(',', '.', $value);
  }
  protected $table = 'constantesListe';
  public $timestamps = false;
  protected $fillable = ['nom','description','normale','step','min','max','lwrang','hnrang','color','unite'];
}
