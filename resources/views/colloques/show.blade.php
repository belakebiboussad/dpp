@extends('app')
@section('title','détails du  colloque')
@section('main-content')
<div class="page-header"><h2>Détails le colloque du &quot; {{ $colloque->date }} &quot;</h2>
<div class="pull-right">
    <a href="{{ route('colloque.index') }}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-search  blue"></i>Liste des colloues</a>
</div>
</div>
<div class="row"> 
  <div class="col-sm-12">
    <form id="creat_col" role="form" method="POST" action="{{route('colloque.index')}}">
      <div class="row">      
        <div class="col-xs-5">
          <div class="widget-box">
            <div class="widget-header widget-header-flat">
            <h5 class="widget-title"><i class="ace-icon fa fa-table"></i>Membres du colloque </h5><span class="badge badge-info numberResult"></span>
            </div>
            <div class="widget-body">
              <div class="widget-main no-padding">
              <table  class="table table-striped table-bordered table-hover">
                <tbody>
                  @foreach( $colloque->membres as $med)
                  <tr><td>{{ $med->full_name }}</td></tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
            </div>     
        </div>
        <div class="col-sm-7">
          @if($colloque->getEtatID())
          <div class="widget-box">
            <div class="widget-header widget-header-flat">
              <h5 class="widget-title"><i class="ace-icon fa fa-table"></i>Demandes traités </h5><span class="badge badge-info numberResult"></span>
            </div>
            <div class="widget-body">
              <div class="widget-main no-padding">
              <table  class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th class="center">Patient</th><th class="center">date</th>
                  <th class="center">Motif</th><th class="center">observation</th>
                </tr>
                </thead>
                <tbody>
                  @foreach( $colloque->demandes as $dem)
                  <tr>
                    <td>{{ $dem->consultation->patient->full_name }}</td>
                    <td>{{ $dem->consultation->date->format('Y-m-d') }}</td>
                    <td>{{ $dem->consultation->motif }}</td>
                    <td><small>{{ $dem->DemeandeColloque->observation }}</small></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
      <div class="center form-actions">
        <button class="btn btn-success btn-xs" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer </button>
        </div>
    </form>
  </div>
</div>  
@stop