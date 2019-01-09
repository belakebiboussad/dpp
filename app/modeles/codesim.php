<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class codesim extends Model
{
    public $timestamps = false;
    protected $fillable = ['code','description'];
     public function consultations()
    {
        return $this->hasMany('App\Models\consultation');
    }
}
