<?php
namespace App\modeles;
use Illuminate\Database\Eloquent\Model;
class ordonnance extends Model
{
    public $timestamps = false;
    protected $fillable = ['date','duree','id_consultation'];
    public function medicamentes()
    {
      return $this->belongsToMany('App\modeles\medicament', 'ordennance_medicaments', 'id_ordenannce', 'id_medicament')->withPivot('posologie');       
    }

    public function consultation()
    {
          return $this->belongsTo('App\modeles\consultation','id_consultation');
    }
}
