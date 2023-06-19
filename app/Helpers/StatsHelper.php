<?php

namespace App\Helpers;

use Carbon\Carbon;
class StatsHelper
{
  public static function formatStat($obj)
  {
    if(is_null($obj))
      return ;
    else
    return '<span class="badge badge-'.(($obj->getEtatID() ==="") ? 'primary':'warning').'">'.$obj->etat.'</span>';
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