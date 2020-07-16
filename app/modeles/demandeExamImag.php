<?php
namespace App\modeles;

use Illuminate\Database\Eloquent\Model;

class demandeExamImag extends Model
{
    //
    public $timestamps = false;
    protected $fillable =['infclinpert','expdemdiag','allergie','diabete','insufRenale','grossesse','implant','autrepatho','examsImagerie','id_consultation'];
    protected $table= "demandeExamImags";
    public function consultation()
    {
    	return $this->belongsTo('App\modeles\consultation','id_consultation');
    } 
}
