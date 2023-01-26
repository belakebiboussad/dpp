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