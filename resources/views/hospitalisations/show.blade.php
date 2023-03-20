@extends('app')
@section('main-content')
<div class="page-header">@include('patient._patientInfo',['patient'=>$hosp->patient])</div>
<div class="row"><h4>Hospitalisation : suivi(e) du patient</h4>
<div class="pull-right">
   <a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info"><i class="ace-icon fa fa-list bigger-120 blue"></i>Hospitalisations</a>
</div>
</div>
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
    <div id="visites" class="tab-pane">@include('visite.index')</div>
    @endif
    @if(in_array(Auth::user()->role_id,[1,3,5,13,14]))
      @if (!empty(json_decode($specialite->hospConst, true))) 
      <div id="constantes" class="tab-pane">@include("constantes.index",['patient'=>$hosp->patient])</div>
      @endif
    @endif
  </div>
</div>
@endsection