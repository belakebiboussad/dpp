<?php

namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class ordonnance extends Model
{
    public $timestamps = false;
    protected $fillable = ['date','duree','id_consultation'];
<<<<<<< HEAD

    public function medicamentes()
    {

=======
    public function medicamentes()
    {
>>>>>>> dev
      return $this->belongsToMany('App\modeles\medicament', 'ordennance_medicaments', 'id_ordenannce', 'id_medicament')->withPivot('posologie');       
    }

    public function consultation()
    {
<<<<<<< HEAD
        return $this->belongsTo('App\modeles\consultation','id_consultation');
=======
          return $this->belongsTo('App\modeles\consultation','id_consultation');
>>>>>>> dev
    }
}
