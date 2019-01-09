<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class specialite_produit extends Model
{
    public $timestamps = false;
    protected $table = "specialite_produit";
    protected $fillable = ['id_gamme','specialite'];
}
