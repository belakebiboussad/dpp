<?php

namespace App\Helpers;

use Carbon\Carbon;
class StatsHelper
{
  public static function formatStat($etat)
  {
    return '<span class="badge badge-'.(($etat ==="En cours") ? 'primary':'warning').'">'.$etat.'</span>';
  }
  public static function isInprog($stat)
  {
     return ($stat->getEtatID() ==='')? '':' hidden';
  }
  public static function formatDate(Carbon $date)
  {
       return $date->format('Y-m-d');
  }
  public static function formatDateF(Carbon $date)
  {
       return $date->format('d/m/Y');
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