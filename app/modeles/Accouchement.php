<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Accouchement extends Model
{
       public const TYPES = [
             0 => 'Normale',
             1 => 'A terme',
             2 => 'Prématuré',
             3 => 'Post-mature',
             4  => 'Dystocique',
             5 => 'Césarienne',
             6 => 'Forceps',
             7 => 'Multiple',
             8  => 'Autre',
       ];
      public $timestamps = true;
      protected $fillable = ['etablisement','terme','presentation','eggopenduration','workduration','expulsduration','incident','type' ,'motif','pid'];
      public static function getTypeID($type) {
        return array_search($type, self::TYPES); 
      }
      public function getTypeAttribute()
      {
        return self::TYPES[ $this->attributes['type'] ];
      }
}
