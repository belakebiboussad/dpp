@extends('app')
@section('style')
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12"><?php $patient = $hosp->patient; ?>@include('patient._patientInfo')</div></div>
  <div class="space-12"></div>
  <div class="row">
    <div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right">
      <span class="f-16"><strong>Traitements</strong></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <table id="simple-table" class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th class="center"><h5><strong>Etat</strong></h5></th>
             <th class="center"><em class="fa fa-cog"></em></th>
            
          </tr>
        </thead>
        <tbody>
          <tr></tr>
        </tbody>
    </div>    
  </div>
</div>
@endsection