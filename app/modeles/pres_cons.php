<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class pres_cons extends Model
{
    protected $table = 'pres_cons';
    public $timestamps = false;
    protected $fillable = ['prescription_id', 'cons_id'];
}
