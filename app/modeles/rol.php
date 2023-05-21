<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use App\User;
class rol extends Model
{
  public $timestamps = true;
  protected $fillable = ['nom','type'];
    public const TYPE = [
      ''=> 'Paramédicale',
      0 => 'Médical',
      1 => 'Administratif',
  ];
  public function getTypeAttribute()
  {
    return self::TYPE[ $this->attributes['type'] ];
  }
  public function users(){
  	return $this->hasMany('App\User','role_id');
  }
  public function Parameters(){
    return $this->hasMany('App\modeles\param_role','role_id');
  }
}
