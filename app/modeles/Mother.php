<?php

namespace App\modeles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
  public $timestamps = true;
  protected $fillable  = ['pid','date','poids','taille','gs','rh'];
  protected $appends = ['age'];
  public function getAgeAttribute(){ 
    if(isset($this->date))
      return (Carbon::createFromDate(date('Y', strtotime($this->date)), date('m', strtotime($this->date)), date('d', strtotime($this->date)))->age);
    else
    return "99";
  }
  public function visite()
  {
    return $this->belongsTo('App\modeles\patient','id');
  }
}
