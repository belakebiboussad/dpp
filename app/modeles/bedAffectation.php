<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class bedAffectation extends Model
{
  public $timestamps = false;
	protected $table = 'bedAffectation';
  protected $fillable  = ['demande_id','lit_id','start','end'];
}
