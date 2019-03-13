<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class specialite_exb extends Model
{
    public $timestamps = false;
    protected $table = "specialite_exb";
    protected $fillable = ['specialite'];

    public function examensbio()
    {
        return $this->hasMany('App\modeles\examenbiologique','id_specialite_exb');
    }
}
