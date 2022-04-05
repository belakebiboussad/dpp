@extends('app')
@section('title','Dossier patient')
@section('main-content')
<div class="space-12"></div>
<div class="row">
  <div class="col-sm-12 infobox-container">
    <div class="infobox infobox-blue">
      <div class="infobox-icon"><i class="ace-icon fa fa-user-md"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\User::where("role_id",1)->get()->count() }}</span>
        <div class="infobox-content"><b>Médecins</b></div>
      </div>
    </div>
    <div class="infobox infobox-pink">
      <div class="infobox-icon"><i class="ace-icon fa fa-medkit"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\User::where("role_id",3)->get()->count() }}</span>
        <div class="infobox-content"><b>Infirmiers</b></div>
      </div>
    </div>
    <div class="infobox infobox-purple">
      <div class="infobox-icon"><i class="ace-icon fa fa-calendar"></i></div>        
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\User::where("role_id",2)->get()->count() }}</span>
        <div class="infobox-content"><b>Agents de réception</b></div>
      </div>
    </div>
    <div class="infobox infobox-red">
      <div class="infobox-icon"><i class="ace-icon fa fa-users"></i>
      </div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\User::where("role_id",5)->get()->count() }}</span>
        <div class="infobox-content"><b>Surveillants médicaux</b></div>
      </div>
    </div><div class="space-12"></div>
  </div><div class="space-12-sm"></div>
</div>
<div class="space-12"></div>
<div class="row">
  <div class="col-sm-12 infobox-container">
    <div class="infobox infobox-blue">
      <div class="infobox-icon"><i class="ace-icon fa fa-square-o"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\service::where("type",'<>',2)->get()->count() }}</span>
        <div class="infobox-content"><b>Services médicaux</b></div>
      </div>
    </div>
    <div class="infobox infobox-pink">
      <div class="infobox-icon"><i class="ace-icon fa fa-gift"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\service::where("type",2)->get()->count() }}</span>
        <div class="infobox-content"><b>Services paramédicaux</b></div>
      </div>
    </div>
    <div class="infobox infobox-purple">
      <div class="infobox-icon"><i class="ace-icon fa fa-laptop"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\salle::all()->count() }}</span>
        <div class="infobox-content"><b>Salles</b></div>
      </div>
    </div>
     <div class="infobox infobox-red">
      <div class="infobox-icon"><i class="ace-icon fa fa-tachometer"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\lit::all()->count() }}</span>
        <div class="infobox-content"><b>Lits</b></div>
      </div>
    </div>
</div>

@endsection