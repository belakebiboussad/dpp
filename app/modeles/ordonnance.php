<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class ordonnance extends Model
{
    public $timestamps = false;
    protected $fillable = ['duree','id_consultation'];
    public function medicamentes()
    {
      return $this->belongsToMany('App\modeles\medicament', 'ordonnance_medicaments', 'id_ordenannce', 'id_medicament')->withPivot('posologie');       
    }
    public function Consultation()
    {
       return $this->belongsTo('App\modeles\consultation','id_consultation');
    }
}
