<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Constantes extends Model
{
    protected $table = 'constantes';
    public $timestamps = false;
    protected $fillable = ['poids', 'taille', 'PAS', 'PAD', 'pouls', 'temp', 'glycemie', 'LDL','HDL','apgar','shoutnbr','PC','examCl_id', 'hospitalisation_id', 'date'];
    public function getDateAttribute($value)
     { 
        return $this->asDateTime($value)->format('y-m-d H:i'); 
     }
}
