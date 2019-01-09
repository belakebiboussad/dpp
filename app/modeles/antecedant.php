<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class antecedant extends Model
{
    public $timestamps = false;
    protected $fillable =['Antecedant','typeAntecedant','stypeatcd','date','descrioption','Patient_ID_Patient','habitudeAlim','tabac','ethylisme'];
    protected $table = "antecedants"	;
}
