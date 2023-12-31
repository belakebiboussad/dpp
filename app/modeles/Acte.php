<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Acte extends Model
{
   	public $timestamps = true;
  	protected $fillable  = ['nom','id_visite','description','type','code_ngap','periodes','nbrFJ','duree','retire','active'];
    protected $appends = ['execs'];
    public  $casts = ['periodes' => 'array'];
    public function scopeActive($q)
    {
      return $q->whereNull('retire');
    }
    public function getExecsAttribute()
    { 
      return ActeExec::whereDate('created_at',  Carbon::today())->where('acte_id',$this->id)->get()->pluck('ordre')->toArray();
    }
    public function visite()
		{
			return $this->belongsTo('App\modeles\visite','id_visite');
		}
		public function CodeNGAP()
		{
			return $this->belongsTo('App\modeles\NGAP','code_ngap');
		}
    public function ActeExecs()
    {
      return $this->hasMany('App\modeles\ActeExec','trait_id');
    }
}
