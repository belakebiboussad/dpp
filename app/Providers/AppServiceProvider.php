<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Carbon::setLocale('fr_FR');
      Carbon::setWeekendDays([
          Carbon::FRIDAY,
          Carbon::SATURDAY,
      ]);
       /**
       fonawesome
       **/
       $this->publishes([
      __DIR__ . '/../../vendor/components/font-awesome/css' => public_path('vendor/components/font-awesome/css'),
      __DIR__ . '/../../vendor/components/font-awesome/fonts' => public_path('vendor/components/font-awesome/fonts')
          ], 'public');
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
