<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class codesim extends Model
{
	protected $connection = 'mysql2';
  public $timestamps = false;
  protected $fillable = ['code','description'];
}
