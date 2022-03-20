@extends('app')
@section('style')
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12"><?php $patient = $hosp->patient; ?>@include('patient._patientInfo')</div></div>
  <div class="space-12"></div>
  <div class="row">
    <div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right">
      <span class="f-16"><strong>Actes</strong></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <table id="simple-table" class="table  table-bordered table-hover">
        <thead>
          <tr>
            <th class="center"><strong>nom</strong></th>
            <th class="center"><strong>description</strong></th>
            <th class="center"><em class="fa fa-cog"></em></th>
          </tr>
        </thead>
        <tbody>
          @foreach($hosp->visites as $visite)
            @foreach($visite->actes as $acte )
              @if(!$acte->retire)
              <td>{{ $acte->nom }}</td> 
              <td>{{ $acte->description }}</td> 
              <td class="center">
                <button data-toggle="modal" class="btn btn-xs btn-primary" data-target="#acteExecute">&faire</button>
              </td> 
              @endif
            @endforeach
          @endforeach
          <tr></tr>
        </tbody>
    </div>    
  </div>
</div>
@endsection