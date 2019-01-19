<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\modeles\rol;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table ="utilisateurs";
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'password','employee_id','role_id','active'];
     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public function role()
    {
            return $this->belongsTo('App\modeles\rol','role_id');
    }
    public function getUserRole()
    {
        return rol::where('id',$this->role_id)->first()->role;
    }
}
