<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexr extends Model
{
    public $timestamps = false;
    protected $table = "demandeexr";
    protected $fillable = ['Date', 'InfosCliniques', ' Explecations', 'id_consultation'];
}
