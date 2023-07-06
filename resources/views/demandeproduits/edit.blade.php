@extends('app')
@section('main-content')
<div class="page-header">
	<h1>Modification de la demande du &quot;{{ $demande->date->format('Y-m-d')}}&quot;</h1>
	<div class="pull-right">
		<a href="{{route('demandeproduit.index')}}" class="btn btn-white btn-info">
		<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>Demandes</a>
	</div>
</div><div class="space-12"></div>
<div class="row">
<div class="col-xs-12">
    <div class="panel-body">
        <table id="meds-table" ></table> <div id="medsPager"></div>
      </div>
</div>
</div>
@stop
@section('page-script')
@include('demandeproduits.partials.scripts')
<script>
$(function(){
  $("#meds-table").jqGrid({
    url : '{{ route("drug.edit", ["id"=>$demande->id])}}',
    mtype: "GET",
    datatype: "json",
    colNames:['demande_id','drug_id'],
    colModel:[
      { name:'demande', index:'demande_id', hidden:false, editable: false},
      { name:'Medicament', index:'drug_id', hidden:false, editable: false},
    ]
  })

});
</script>
@stop