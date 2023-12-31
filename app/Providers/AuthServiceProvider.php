<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
      $this->registerPolicies();
      $gate->define('update-bedAffectation',function($user){
        return $user->role_id == 5;//survMed
      });
      $gate->define('update-hosp',function($user){
        return in_array($user->role_id,[1,13,14]);//med,chefserv,medchef
      });     
    }
}
