<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class Constante extends Model
{
        protected $table = 'constantesListe';
        public $timestamps = false;
        protected $fillable = ['nom','description','min','max','lwrang','hnrang','unite'];
}
