@extends('app')
@section('title','Dossier patient')
@section('main-content')
<div class="row">
  <div class="col-sm-12">
    <div class="infobox infobox-blue">
      <div class="infobox-icon"><i class="ace-icon fa fa-user-md"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\User::where("role_id",1)->get()->count() }}</span>
        <div class="infobox-content">Médecins</div>
      </div>
    </div>
    <div class="infobox infobox-pink">
      <div class="infobox-icon"><i class="ace-icon fa fa-medkit"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\User::where("role_id",3)->get()->count() }}</span>
        <div class="infobox-content">Infirmiers</div>
      </div>
    </div>
    <div class="infobox infobox-purple">
      <div class="infobox-icon"><i class="ace-icon fa fa-calendar"></i></div>        
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\User::where("role_id",2)->get()->count() }}</span>
        <div class="infobox-content">Agents de réception</div>
      </div>
    </div>
    <div class="infobox infobox-red">
      <div class="infobox-icon"><i class="ace-icon fa fa-users"></i>
      </div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\User::where("role_id",5)->get()->count() }}</span>
        <div class="infobox-content">Surveillants médicaux</div>
      </div>
    </div>
  </div>
</div><div class="space-12"></div>
<div class="row">
  <div class="col-sm-12 infobox-container">
    <div class="infobox infobox-blue">
      <div class="infobox-icon"><i class="ace-icon fa fa-square-o"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\service::where("type",'<>',2)->get()->count() }}</span>
        <div class="infobox-content">Services médicaux</div>
      </div>
    </div>
    <div class="infobox infobox-pink">
      <div class="infobox-icon"><i class="ace-icon fa fa-gift"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\service::where("type",2)->get()->count() }}</span>
        <div class="infobox-content">Services paramédicaux</div>
      </div>
    </div>
    <div class="infobox infobox-purple">
      <div class="infobox-icon"><i class="ace-icon fa fa-laptop"></i></div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\salle::all()->count() }}</span>
        <div class="infobox-content">Salles</div>
      </div>
    </div>
     <div class="infobox infobox-red">
      <div class="infobox-icon">
      <i class="menu-icon fa fa-bed" aria-hidden="true"></i>
      </div>
      <div class="infobox-data">
        <span class="infobox-data-number">{{ App\modeles\lit::all()->count() }}</span>
        <div class="infobox-content">Lits</div>
      </div>
    </div>
</div>

@stop