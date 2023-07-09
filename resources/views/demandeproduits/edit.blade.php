@extends('app')
@section('main-content')
<div class="page-header">
	<h1>Modification de la demande du &quot;{{ $demande->date->format('Y-m-d')}}&quot;</h1>
	<div class="pull-right">
		<a href="{{route('demandeproduit.index')}}" class="btn btn-white btn-info">
		<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>Demandes</a>
	</div>
</div>
<div class="row">
  <div class="col-xs-6">
    <div class="panel-body">
        <table id="meds-table" ></table> <div id="medsPager"></div>
      </div>
  </div>
   <div class="col-xs-6">
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
    colNames:['drug_id','Medicament','Spécialite','Qte','Unité'],
    colModel:[
      { name:'drug_id', index:'drug_id', hidden:true, editable: true},
      { name:'nom', index:'nom', hidden:false, editable: false, editoptions:{size:67}
      },
      {  name: 'specialiteProd', index: 'specialiteProd',editable: false,
        formatter: function (cellvalue, options, rowObject) 
        {
          return rowObject.specialite.nom;
        }, editrules : { edithidden : true }
      },
      { name:'qte', index:'qte', hidden:false, editable: true,
        formatter: function (cellvalue, options, rowObject) 
        {
          return rowObject.pivot.qte;
        }
      },
      { name:'unite', index:'unite', hidden:false, editable: true,
        formatter: function (cellvalue, options, rowObject) 
        {
          return rowObject.pivot.unite;
        }
      },
     
    ],
    width: 600,
    height: "auto",
    rowNum:10,
    pager: '#medsPager',
    sortname: 'id',
    caption:"Médicaments",
    editable: true
  });
  $("#meds-table").jqGrid('navGrid','#medsPager',
  {
  });
});
</script>
@stop