@extends('app')
@section('main-content')
<div class="container-fluid">
  <div class="page-header"> @include('patient._patientInfo',['patient'=>$visite->hospitalisation->patient])
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="panel-body">
        <table id="actes-table"></table>
        <div id="jqGridPager"></div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-script')
<script type="text/javascript">
  $(function(){
    var grid_selector = "#grid-table";
    $("#actes-table").jqGrid({
        url: '/visteActes/{{ $visite->id }}',
        mtype: "GET",
        datatype: "json",
        colModel: [
          {  label: 'ID', name: 'id', "key":true, width: 30, "hidden":true},
          { label: 'Nom', name: 'nom', width: 90 },
          { label: 'Description', name: 'description', width: 130 },
          { label: 'Type', name: 'type', width: 60 },
          { label: 'NGAP', name: 'code_ngap', width: 40 },
          { label: 'fois/j', name: 'nbrFJ', width: 40 }  
        ],
        viewrecords: true,
        width: 1146,
        height: 250,
        rowNum: 20,
        gridview: true,
        altRows: true,
        multiselect: true,
        pager: "#jqGridPager",
        caption: "Actes"
      });
    // .jqGrid('navGrid','#pager1',{edit:true,add:true,del:true});
      // $('#grid-table').navGrid('#jqGridPager', { edit: true, add: true, del: true, search: false, refresh: false, view: false, position: "left", cloneToTop: false }, // options for the Edit Dialog
      //   {
      //       editCaption: "The Edit Dialog",
      //       recreateForm: true,
      //       checkOnUpdate : true,
      //       checkOnSubmit : true,
      //       closeAfterEdit: true,
      //       errorTextFormat: function (data) {
      //           return 'Error: ' + data.responseText
      //       }
      //   },
      //   // options for the Add Dialog
      //   {
      //       closeAfterAdd: true,
      //       recreateForm: true,
      //       errorTextFormat: function (data) {
      //           return 'Error: ' + data.responseText
      //       }
      //   },
      //   // options for the Delete Dailog
      //   {
      //       errorTextFormat: function (data) {
      //           return 'Error: ' + data.responseText
      //       }
      //   }
      //   );

  });
</script>
@endsection