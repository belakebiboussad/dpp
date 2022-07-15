@extends('app_dele')
@section('title','détails du  colloque')
@section('page-script')
<script type="text/javascript">
</script>
@endsection
@section('main-content')
<div class="space-12"></div>
<div class="page-header"> <h1><strong>Détails le colloque du &quot; {{ $colloque->date }} &quot;</strong></h1></div><!-- /.page-header -->
<div class="space-12"></div>
<div class="row"> 
  <div class="col-sm-12">
    <form id="creat_col" class="form-horizontal" role="form" method="POST" action="{{route('colloque.index')}}">
      {{ csrf_field() }} 
      <div class="row">      
        <div class="col-xs-5">
          <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
              <h5 class="widget-title"><i class="ace-icon fa fa-table"></i><strong>Liste des membres</strong>:</h5><label><span class="badge badge-info numberResult"></span></label>
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
          @if($colloque->getEtatID($colloque->etat))
          <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
              <h5 class="widget-title"><i class="ace-icon fa fa-table"></i><strong>Liste des demandes</strong>:</h5><label><span class="badge badge-info numberResult"></span></label>
            </div>
            <div class="widget-body">
              <div class="widget-main no-padding">
              <table  class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                  <th class="center">Patient</th>
                  <th class="center">date</th>
                  <th class="center">Motif</th>
                  <th class="center">observation</th>
                </tr>
                </thead>
                <tbody>
                  @foreach( $colloque->demandes as $dem)
                  <tr>
                    <td>{{ $dem->consultation->patient->full_name }}</td>
                    <td>{{ $dem->consultation->date }}</td>
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
      </div><div class="space-12"></div><div class="space-12"></div>
      <div class="row">
        <div class="col-xs-7">
          <label class= "control-label no-padding-left col-xs-4 col-sm-4" for="date_colloque">Date:</label>
          <input class="col-xs-4 col-sm-4 date-picker" id="date_colloque" name="date_colloque" type="text" value="{{ $colloque->date }}" data-date-format="yyyy-mm-dd" readonly disabled/>
        </div><div class="col-xs-5"></div>
      </div><div class="space-12"></div> <div class="space-12"></div>
      <div class="row">
          <div class="col-xs-6 center">
            <div class="col-md-offset-6 col-md-7"><br/>
              <button class="btn btn-success btn-xs" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer </button>&nbsp; &nbsp; &nbsp; &nbsp;
             <!--  <button class="btn btn-xs" type="reset" id="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button> -->
            </div>
          </div>
        </div>
    </form>
  </div>  <!-- cpl-s-12    -->
</div>  
@endsection