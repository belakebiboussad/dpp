<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class prescription_constantes extends Model
{
    protected $table = 'prescription_constantes';
    public $timestamps = false;
    protected $fillable = ['visite_id', 'observation'];
    public function constantes()
    {
        return $this->belongsToMany('App\modeles\consts', 'pres_cons', 'prescription_id', 'cons_id');
    }
}
