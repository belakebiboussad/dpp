<?php
namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
   public $timestamps = false;
    protected $table = 'communes';
   protected $fillable = ['Id_wilaya','nom_wilaya','immatriculation_wilaya'];
}
