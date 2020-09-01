<?php

namespace App\modeles\CIM;

use Illuminate\Database\Eloquent\Model;

class chapter extends Model
{
	protected $connection = 'mysql2';
	protected $primaryKey = 'chap';
  public $timestamps = false;
  protected $fillable = ['SID','rom'];
}