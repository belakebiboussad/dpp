<?php
namespace App\Traits;
use  App\modeles\assur;
trait AssureSearch
{
    public function assureSearch($NSSAssure)
    {
      $assure =  assur::where('NSS',trim($NSSAssure))->select('assurs.NSS')->get()->first();
      if(isset($assure))
          return $assure->NSS;
      else 
          return null;   
    }
} 