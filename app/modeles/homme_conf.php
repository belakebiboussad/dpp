<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class homme_conf extends Model
{
     
     protected $fillable  = ['id','id_patient','nom','prénom','date_naiss','lien_par','type_piece','num_piece','date_deliv','adresse','mob','etat_hc','created_by','updated_by','updated_at'];

}
