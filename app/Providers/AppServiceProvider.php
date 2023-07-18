<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      \Blade::if('doctor',function(){
        return Auth::user()->isIn([1,13,14]);
      });
      \Blade::if('chef',function(){
        return Auth::user()->isIn([13,14]);
      });
      Carbon::setWeekendDays([
          Carbon::FRIDAY,
          Carbon::SATURDAY,
      ]);
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       setlocale(LC_ALL, "fr_FR.UTF-8");
      \Carbon\Carbon::setLocale(config('app.locale'));
    }
}
