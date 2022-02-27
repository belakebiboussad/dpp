@extends('app')
@section('title','Demande Examens Imagerie')
@section('style')
<link rel="stylesheet" href="css/styles.css">
<style>
    iframe {
        display: block;
        margin: 0 auto;
        border: 0;
        position:relative;
        z-index:999;
    }
    .mt-12 { padding-top:-12px;}
    #pdfContent {
      background: #fff;
      width: 70%;
      height: 100px;
      margin: 20px auto;
      border: 1px solid black;
      padding: 20px;
  }
</style>
@endsection
@section('main-content')
<div class="row" width="100%">@include('patient._patientInfo')</div>
<div class="row">
    <div class="col-md-5 col-sm-5"><h4> <strong>Demande d'examen radiologique</strong></h4></div>
    <div class="col-md-7 col-sm-7">
      <a href="/drToPDF/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-primary pull-right">
        <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer</a>&nbsp;&nbsp;
        @if(Auth::user()->role_id  == 12){{-- listeexrs --}}
         <a href="/home" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
        @else
         <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
        @endif
    </div>
</div><hr>
<input type="hidden" id ="id_demandeexr" value="{{ $demande->id }}">
<div class="row">
  <div class="col-xs-12 col-sm-10">
    <div class="form-group">
      <label class="col-sm-4 control-label"><strong>Date :</strong></label>
      <div class="col-sm-8 col-xs-8">
        <label class="blue"> {{ (\Carbon\Carbon::parse($date))->format('d/m/Y') }}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label"><strong>Médecin demandeur :</strong></label>
      <div class="col-sm-8 col-xs-8"><label class="blue">{{ $medecin->full_name }}</label></div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label"><strong>Informations cliniques pertinentes :</strong></label>
      <div class="col-sm-8 col-xs-8">
        <label class="blue">{{ $demande->InfosCliniques }}</label>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label"><strong>Explication de la demande de diagnostic :</strong></label>
      <div class="col-sm-8 col-xs-8">
        <label class="blue">{{ $demande->Explecations }}/label>
      </div>
    </div>
  </div><!-- col-xs-12 col-sm-10 -->
</div><!-- row -->
@endsection
