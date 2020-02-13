<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Type_specialite extends Model
{
    //
    public $timestamps = false;
    protected $table ="typespecialites";
    protected $fillable  = ['id','nom'];
     public function specialite()
    {
        return $this->hasMany('App\modeles\specialite');
    }
}