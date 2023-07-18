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
    //1:compte active,null:compte desactivé
    public $table ="utilisateurs";
    public $timestamps = false;
    protected $fillable = ['username', 'email', 'password','employe_id','role_id','active'];
     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected $appends = ['is_admin'];
    public function role()
    {
      return $this->belongsTo('App\modeles\rol','role_id');
    }
    public function employ()
    {
        return $this->belongsTo('App\modeles\employ','employe_id');   
    }
    protected $casts = [
        'active' => 'boolean',
    ];
    public function is($role)
    {
      return ($role == $this->role_id);
    }
    public function isIn($roles)
    {
      return in_array($this->role_id,$roles);
    }
    public function getIsAdminAttribute(){
      return $this->role_id == 4;  
    }
}
