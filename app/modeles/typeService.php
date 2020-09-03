<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class typeService extends Model
{
	public $timestamps = false;
  protected $table="types_service";
	protected $fillable = ['nom'];
	
}

