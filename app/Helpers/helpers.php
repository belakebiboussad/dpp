<?php 
if(!function_exists('format_stat')){
  function format_stat($stat)
  {
    if(is_null($stat))
      return '<strong>En Cours</strong>';
    else
    {
       return $stat;
    }

  }
}