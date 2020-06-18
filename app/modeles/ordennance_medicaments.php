<?php

namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class ordennance_medicaments extends Model
{
    public $timestamps = false;
    protected $table = "ordennance_medicaments";
    protected $fillable = ['id_ordenannce','id_medicament','posologie'];
}
