<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public const TYPE = [
      '' => 'Congés',
      1 => 'Récupération',
      2 => 'Congrès et séminaires',
      3 => 'Autre'
    ];
    public const STATES = [
      ''=> 'en Cours',
      0 => 'Annule',
      1 => 'Valide'
    ];
    protected $fillable = [
        'employe_id', 'date', 'heure','date_end','heure_end', 'type','desc','state'
    ];
    protected $dates =['date','date_end'];
    public function getStateAttribute()
    {
     return self::STATES[ $this->attributes['state'] ];
    }
    public function getTypeAttribute()
    {
      return self::TYPE[ $this->attributes['type'] ];
    }
    public static function getStateID($state) {
      return array_search($state, self::STATES); 
    }
    /**
     * Get the Employee
     */
    public function employee()
    {
        return $this->belongsTo('App\modeles\employ');
    }
}
