<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class ordonnance_medicaments extends Model
{
    public $timestamps = false;
    protected $table = "ordonnance_medicaments";
    protected $fillable = ['id_ordenannce','id_medicament','posologie'];
}
