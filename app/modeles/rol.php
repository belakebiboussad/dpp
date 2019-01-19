<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
use App\User;
class rol extends Model
{
    public $timestamps = false;
    protected $fillable = ['role'];
    public function users(){
    	return $this->hasMany('App\User');
    }
}
