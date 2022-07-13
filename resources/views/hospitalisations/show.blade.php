@extends('app')
@section('main-content')
<div class="row">@include('patient._patientInfo',['patient'=>$hosp->patient])</div>
<div class="pull-right">
   <a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Hospitalisations</a>
</div>
<div class="row"><div class="col-sm-12"><h4><strong> Hospitalisation : suivi(e) du patient</strong></h4></div></div><div class="space-12"></div>
<div class="tabbable"  class="user-profile">
  <ul class="nav nav-tabs" role="tablist">
    <li class="active"><a data-toggle="tab" href="#hospi">Hospitalisation</a></li>
    @if(in_array(Auth::user()->role_id,[1,13,14]) && ($hosp->visites->count()>0))
    <li><a data-toggle="tab" href="#visites">Visites & Contrôles</a></li>
    @endif
    @if(in_array(Auth::user()->role_id,[1,3,5,13,14]))
      @if (!empty(json_decode($specialite->hospConst, true))) 
      <li><a data-toggle="tab" href="#constantes">Surveillance clinique</a></li>
      @endif
    @endif
  </ul>
  <div class="tab-content no-border padding-24">
    <div id="hospi" class="tab-pane in active">@include('hospitalisations.inc_hosp')</div>
    @if(in_array(Auth::user()->role_id,[1,13,14]) && ($hosp->visites->count()>0))
    <div id="visites" class="tab-pane">@include('visite.liste')</div>
    @endif
    @if(in_array(Auth::user()->role_id,[1,3,5,13,14]))
      @if (!empty(json_decode($specialite->hospConst, true))) 
      <div id="constantes" class="tab-pane">@include("constantes.index",['patient'=>$hosp->patient])</div>
      @endif
    @endif
  </div>
</div>
@endsection