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
<script type="text/javascript">
function updatDrug(params) {
  url = '{{ route("drug.update", ":slug") }}'; 
  url = url.replace(':slug', params.id);
  params['demande_id'] ='{{ $demande->id}}';
  params['_token'] =CSRF_TOKEN;
  params['editurl'] =url;
  $.ajax({
      type:"PUT",
      url:url,
      data: params,
      dataType:'json',
      success: function (data) {
        $.each(data, function(key, value){
          alert(key + ":" + value);
        })
        //alert(data);
      } 
  })
}
$(function(){
  $("#meds-table").jqGrid({
    url : '{{ route("drug.edit", ["id"=>$demande->id])}}',
    mtype: "GET",
    datatype: "json",
    colNames:['ID','Medicament','Qte','Unité'],
    colModel:[
      { name:'id', index:'id', hidden:true,editable: true},
      {name:'nom',index:'nom',editable: true,editoptions:{size:67},editrules:{required:true}},
      { name:'qte', index:'qte', editable: true,edittype:'number',
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
    viewrecords: true,
    editurl : '/drug/edit',
    caption:"Médicaments",
    emptyrecords: "0 enregistrements trouvés",
    editable: true
  });
  $("#meds-table").jqGrid('navGrid','#medsPager',
    {

      edit:true, edittitle: "Edit Médicament",
      add:true, addtitle: "Add Médicament",
      del:true,
      refresh: false,
      view:true,
      viewicon : 'ace-icon fa fa-search-plus grey',
      addicon : 'ace-icon fa fa-plus-circle purple',
    },{
        closeOnEscape: true, 
        closeAfterEdit: true,
        errorTextFormat: commonError, 
        width: "600", 
        reloadAfterSubmit: true, 
        bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
        top: "60",left: "5", right: "5",
        onclickSubmit: function (response, actedata) {
          updatDrug(actedata);
          $(this).jqGrid("setGridParam", { datatype: "json" });
        }
    });
  });
</script>
@stop