<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexradio_infosupppertinentes extends Model
{
   	public $timestamps = false;
    protected $table = "demandeexradio_infosupppertinentes";
    protected $fillable = ['id_demandeexr','id_infosupp'];
}
