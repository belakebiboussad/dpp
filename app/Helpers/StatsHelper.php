<?php

namespace App\Helpers;

use Carbon\Carbon;
class StatsHelper
{
  public static function formatStat($stat)
  {
    if(is_null($stat))
      return ;
    else
    return '<span class="badge badge-'.(($stat->getEtatID() ==="") ? 'primary':'warning').'">'.$stat->etat.'</span>';
  }
  public static function isInprog($stat)
  {
     return ($stat->getEtatID() ==='')? '':' hidden';
  }
  public static function formatDate(Carbon $date)
  {
       return $date->format('Y-m-d');
  }
  public static function formatString($collection, $field1, $field2)
  {
    $str= "";
    foreach( $collection as $obj)
    {
      $str.= $obj->$field1 . ':' . $obj->$field2 . ";";
    }
    return $str;
  }
}