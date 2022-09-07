<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'date', 'date_end', 'type','desc','state'
    ];

    /**
     * Get the Employee
     */
    public function employee()
    {
        return $this->belongsTo('App\modeles\employ');
    }
}
