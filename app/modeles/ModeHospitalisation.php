<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class ModeHospitalisation extends Model
{
    //
	public $timestamps = false;
	protected $table = 'modes_hospitalisations';
	protected $fillable  = ['nom','selected'];
}
