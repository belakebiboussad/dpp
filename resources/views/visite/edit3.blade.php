@extends('app')
@section('main-content')
<div class="container-fluid">
<div class="container-fluid">
  <div class="page-header"> @include('patient._patientInfo',['patient'=>$visite->hospitalisation->patient])
  </div>
 <!--  <div class="row">
    <div class="col-xs-12">
      <div class="panel-body">
        <table id="actes-table"></table>
        <div id="actesPager"></div>
      </div>
    </div>
  </div> -->
   <div class="row">
    <div class="col-xs-12">
      <div class="panel-body">
        <table id="traits-table"></table>
        <div id="traitPager"></div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-script')
<script type="text/javascript">
  function typeSelect()
  {
    return "paramedicale:paramédicale;medicale:médicale";
  }
  function NgapSelect()
  {
    return '{!! $ngaps !!}';
  }
  function commonError(data) {
    return "Error Occured during Operation. Please try again";
  }
  $(document).ready(function(){
  $("#traits-table").jqGrid({
        url: '/visiteTraits/{{ $visite->id }}',
        mtype: "GET",
        datatype: "json",
        colNames:['ID', 'Médicament','Posologie','Médecin'],
        colModel:[
          {name:'id',index:'id',editable: false, width:20, hidden:true, editable: true},
          {name:'med_id',index:'med_id',editable: true, width:130, editoptions: {size:67}},
          {name:'posologie',index:'posologie', editable: true, width:150 },
          {name:'nbrPJ',index:'nbrPJ', editable: true, width:150 },
        ],
        width: 1146,
        height: "auto",
        rowNum:10,
        loadonce: true,
        rowList:[10,20,30],
        multiselect: true,
        pager: '#traitPager',
        sortname: 'id',
        viewrecords: true,
        sortorder: "desc",
        editurl : '/trait/edit',
        caption:"Traitements",
        emptyrecords: "0 records found",
        editable: true
    });
});
 </script>
@endsection