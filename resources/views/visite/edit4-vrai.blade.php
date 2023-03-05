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
        <div id="actesPager"></div>
      </div>
    </div>
  </div>
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
        success: function (data) {} 
    })
  }
  function addActe(params)
  {
    url = '{{ route("acte.store") }}'; 
    params['_token'] =CSRF_TOKEN;
    params['id_visite'] ='{{ $visite->id}}';
    params['editurl'] =url;
    $.ajax({
      type:"POST",
      url:url,
      data: params,
      dataType:'json',
      success: function (data) {}
    })
  }
  function deleteActe(id) 
  {
    var url = '{{ route("acte.destroy", ":slug") }}'; 
    url = url.replace(':slug', id);
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
    $.ajax({
      type:"DELETE",
      url:url,
      dataType:'json',
      success: function (data) { }
    }) 
  }
  $(document).ready(function(){
   // var acteUrl = "{{-- route('acte.index', ["visId"=>$visite->id]) --}}";
   $("#actes-table").jqGrid({
        url: '/visteActes/{{ $visite->id }}',
        mtype: "GET",
        datatype: "json",
        colNames:['ID', 'Acte','Type','NGAP','Application','Fois/Jour'],
        colModel:[
          {name:'id',index:'id',editable: false, width:20, hidden:true, editable: true},
          {name:'nom',index:'nom',editable: true, width:150,editoptions: {size:67}},
          {name:'type',index:'type', editable: true, edittype:'select',editoptions: {value: typeSelect(), editrules: { required: true }}},
          {name:'code_ngap',index:'code_ngap', editable: true, edittype:"select",width:40,edittype:'select', editoptions: {value: NgapSelect() , editrules: { required: false }}},
          {name:'description',index:'description', editable: true, width:130,edittype:"textarea",editoptions:{rows:"3",cols:"67"}},
          {name:'nbrFJ',index:'nbrFJ', width:20,editable: true, sortable:false, edittype:"number"}        
        ],
        width: 1146,
        height: "auto",
        rowNum:10,
        loadonce: true,
        rowList:[10,20,30],
        multiselect: true,
        pager: '#actesPager',
        sortname: 'id',
        viewrecords: true,
        sortorder: "desc",
        editurl : '/acte/edit',
        caption:"Actes",
        emptyrecords: "0 records found",
        editable: true
    });
    $("#actes-table").jqGrid('navGrid','#actesPager',
    {
        edit:true, edittitle: "Edit Acte",
        add:true, addtitle: "Add Acte",
        del:true,
        refresh: false,
        view:true,
        viewicon : 'ace-icon fa fa-search-plus grey',
        addicon : 'ace-icon fa fa-plus-circle purple',
    },
    {
        closeOnEscape: true, 
        closeAfterEdit: true, 
        savekey: [true, 13], 
        errorTextFormat: commonError, 
        width: "600", 
        reloadAfterSubmit: true, 
        bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
        top: "60",left: "5", right: "5",
        onclickSubmit: function (response, actedata) {
          EditActe(actedata);
          $(this).jqGrid("setGridParam", { datatype: "json" });
        }
    },// options for the Add Dialog
      {
        width: "600", 
        closeOnEscape: true, 
        closeAfterAdd: true,
        recreateForm: true,
        reloadAfterSubmit: true,
        errorTextFormat: commonError,
        onclickSubmit: function (response, actedata) {
          addActe(actedata);
          $(this).jqGrid("setGridParam", { datatype: "json" });
        }
      },
      {
        closeOnEscape: true, 
        recreateForm: true,
        reloadAfterSubmit: true,
        errorTextFormat: commonError,
        onclickSubmit: function (response, actedata) {
          deleteActe(actedata);
          $(this).jqGrid("setGridParam", { datatype: "json" });
        }
      });  //$('.ui-jqgrid-titlebar-close','#actes_table').remove();
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
    $("#actes-table").jqGrid('navGrid','#traitPager',
    {
      edit:true, edittitle: "Edit traitement",
      add:true, addtitle: "Add traitement",
      del:true,
      refresh: false,
      view:true,
      viewicon : 'ace-icon fa fa-search-plus grey',
      addicon : 'ace-icon fa fa-plus-circle purple',
    },
    {
       closeOnEscape: true, 
        closeAfterEdit: true, 
        savekey: [true, 13], 
        errorTextFormat: commonError, 
        width: "600", 
        reloadAfterSubmit: true, 
        bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
        top: "60",left: "5", right: "5",
        onclickSubmit: function (response, actedata) {
          $(this).jqGrid("setGridParam", { datatype: "json" });
        }
    }
    )
});
 </script>
@endsection