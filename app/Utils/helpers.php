<?php 
if(!function_exists('format_stat')){
  function format_stat($obj)
  { 
    if(is_null($obj))
      return ;
    else
      return '<span class="badge badge-'.((empty($obj->getEtatID($obj->etat))) ? 'primary':'warning').'">'.$obj->etat.'</span>';
  }

}
if(!function_exists('isInprog')){
  function isInprog($obj)
  {
    return(empty($obj->getEtatID($obj->etat))) ? '':' hidden';
  }
}