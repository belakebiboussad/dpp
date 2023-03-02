@extends('app')
@section('main-content')
<div class="container-fluid">
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
  function AddActe(params) {
      alert(params.id);
  }
  function EditActe(params) {
    url = '{{ route("acte.update", ":slug") }}'; 
    url = url.replace(':slug', params.id);
    params['_token'] =CSRF_TOKEN;
    params['editurl'] =url;
    $.ajax({
        type:"PUT",
        url:url,
        data: params,
        dataType:'json',
        success: function (data) {
        }
    })
  }
  function DeleteActe(params) {
   console.log(params);
  }
  $(document).ready(function(){
    $("#actes-table").jqGrid({
        url: '/visteActes/{{ $visite->id }}',
        mtype: "GET",
        datatype: "json",
        colNames:['ID', 'Acte','Type','NGAP','Application','Fois/Jour'],
        colModel:[
          {name:'id',index:'id',editable: false, width:20, hidden:true, editable: true},
          {name:'nom',index:'nom',editable: true, width:150},
          {name:'type',index:'type', width:50, editable: true, edittype:'select',editoptions: { value: typeSelect(), editrules: { required: true }}},
          {name:'code_ngap',index:'code_ngap', editable: true, edittype:"select",width:40,edittype:'select', editoptions: { value: NgapSelect() , editrules: { required: false }}},
          {name:'description',index:'description', editable: true, width:130,edittype:"textarea",editoptions:{rows:"3",cols:"50"}},
          {name:'nbrFJ',index:'nbrFJ', width:20,editable: true, sortable:false}        
        ],
        width: 1146,
        height: "auto",
        rowNum:10,
        loadonce: true,
        rowList:[10,20,30],
        multiselect: true,
        pager: '#jqGridPager',
        sortname: 'id',
        viewrecords: true,
        sortorder: "desc",
        editurl : '/acte/'+ 96 +'/edit',
        caption:"Actes",
        editable: true
    });
    $("#actes-table").jqGrid('navGrid','#jqGridPager',
      {
        edit:true, edittitle: "Edit Acte",
        add:true, addtitle: "Add Acte",
        addicon : 'ace-icon fa fa-plus-circle purple',
        del:true,
        search:false,
        refresh: false,
        view:true,
        viewicon : 'ace-icon fa fa-search-plus grey',
      },
      {
        errorTextFormat: commonError, 
        width: "600", 
        reloadAfterSubmit: true, 
        bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
        top: "60", 
        left: "5", 
        right: "5",
        onclickSubmit: function (response, actedata) {
          AddActe(actedata);
          $(this).jqGrid("setGridParam", { datatype: "json" });
        }
      },
      {
        editCaption: "Edit Acte", 
        closeOnEscape: true, 
        closeAfterEdit: true, 
        savekey: [true, 13], 
        errorTextFormat: commonError, 
        width: "600", 
        reloadAfterSubmit: true, 
        bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
        top: "60", 
        left: "5", 
        right: "5",
        onclickSubmit: function (response, actedata) {
          EditActe(actedata);
          $(this).jqGrid("setGridParam", { datatype: "json" });
        }
      },//delete Options. save key parameter will keybind the Enter key to submit.
      {
          deleteCaption: "delete Acte", 
          deletetext: "Delete Acte", 
          closeOnEscape: true, 
          closeAfterEdit: true, 
          savekey: [true, 13], 
          errorTextFormat: commonError, 
          width: "500", 
          reloadAfterSubmit: true, 
          bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
          top: "60", 
          left: "5", 
          right: "5",
          onclickSubmit: function (response, actedata) {
              DeleteActe(actedata);
          }  
      });
    $('.ui-jqgrid-titlebar-close','#actes_table').remove();
});
 </script>
@endsection