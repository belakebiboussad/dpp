<?php 
if(!function_exists('format_stat')){
  function format_stat($obj)
  { 
    if(is_null($obj))
      return ;
    else
      return '<span class="badge badge-'.(($obj->getEtatID() ==='') ? 'primary':'warning').'">'.$obj->etat.'</span>';
  }
}
if(!function_exists('isInprog')){
  function isInprog($obj)
  { 
    return ($obj->getEtatID() ==='')? '':' hidden';
  }
}
if(!function_exists('format_date')){
  function format_date($date)
  {
    return $date->format('Y-m-d');
  }
}
if(!function_exists('format_string')){
  function format_string($collection, $col1, $col2)
  {
    $str= "";
    foreach( $collection as $obj)
    {
      $str.= $obj->$col1 . ':' . $obj->$col2 . ";";
    }
    return $str;
  }
}