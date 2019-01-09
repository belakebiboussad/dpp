<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class examenimagrie extends Model
{
    public $timestamps = false;
    // protected $fillable =['nom','description','type','date' ,'lien','id_consultation'];
    protected $fillable =['nom','type'];
    protected $table = "examensimagerie";
}
