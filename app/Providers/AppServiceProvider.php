<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
           Validator::extend('NSSValide', function($attribute, $value, $parameters, $validator) {
           if(!empty($value) && (strlen($value) % 2) != 0){
                     $matches = null;
                     $value = preg_replace('/\s+/', '', $value);
                     if (!preg_match("/^([0-9]{2}[0-9]{4}[0-9]{4})([0-9]{2})$/i", $value, $matches))
                     {
                           return false;
                     }
                      $code = preg_replace(array('/2A/i', '/2B/i'), array(19, 18), $matches[1]);
                      $cle  = $matches[2];
                      $length = strlen($code);
                      $som= 0 ;
                      for ($i=0 ; $i < $length ; $i++)
                      {
                           if($i % 2 == 0)
                                $som += $code[$i] * 2;
                           else
                                $som += $code[$i]*1;
                      }
                      if (99 - $som != $cle) {
                          return false;       
                     }  
                      return true;
           }
           return false;
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
