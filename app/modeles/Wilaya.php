<?php
namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
  public $timestamps = false;
  protected $table = 'wilayas';
  protected $fillable = ['nom'];//,'immatriculation_wilaya'
}
