<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use App\User;
class rol extends Model
{
    public $timestamps = true;
    protected $fillable = ['role'];
    public function users(){
    	return $this->hasMany('App\User');
    }
    public function Parameters(){
      return $this->hasMany('App\modeles\param_role','role_id');
    }
}
