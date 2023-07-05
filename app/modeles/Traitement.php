<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Traitement extends Model
{
   	public $timestamps = false;
    protected $fillable  = ['id','med_id','posologie','periodes','nbrPJ','duree','visite_id'];
    protected $casts = ['periodes' => 'array'];
    protected $appends = ['execs'];
    public function getExecsAttribute()
    {
      return TraitExec::whereDate('created_at',  Carbon::today())->where('trait_id',$this->id)->get()->pluck('ordre')->toArray();
    }
    public function medicament()
    {
      return $this->belongsTo('App\modeles\Drug','med_id');
    }
    public function visite()
  	{
  		return $this->belongsTo('App\modeles\visite','visite_id');
  	}
    public function TraitExecs()
    {
      return $this->hasMany('App\modeles\TraitExec','trait_id');
    }
  

}
