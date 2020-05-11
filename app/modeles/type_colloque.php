<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class type_colloque extends Model
{
    //
    public $timestamps = false;
    protected $fillable  = ['id','type'];
     public function colloques()
    {
        return $this->hasMany('App\modeles\colloque');
    }
}

