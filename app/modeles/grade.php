<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class grade extends Model
{
    //
    public $timestamps = false;
    protected $fillable  = ['id','nom'];
     public function assurs()
    {
           return $this->hasMany('App\modeles\assur');
    }
}
