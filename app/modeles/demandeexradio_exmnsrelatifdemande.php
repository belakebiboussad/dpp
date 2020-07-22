<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeexradio_exmnsrelatifdemande extends Model
{
  public $timestamps = false;
  protected $table = "demandeexradio_exmnsrelatifdemande";
  protected $fillable = ['id_demandeexradio','id_examensrelatifdemande'];
}
