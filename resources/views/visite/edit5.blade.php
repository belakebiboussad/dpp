@extends('app')
@section('main-content')
<div class="container-fluid">
  <div class="page-header">@include('patient._patientInfo',['patient'=>$visite->hospitalisation->patient])</div>
  <div class="row">
  <div class="col-sm-12"><h4>Modifier la visite</h4>
  <div class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-sm btn-warning"><i class="ace-icon fa fa-backward"></i> precedant</a></div>
  </div>
</div>
  <div class="row">
    <div class="col-xs-12">
      <div class="panel-body">
        <table id="actes-table"></table><div id="actesPager"></div>
      </div>
    </div>
  </div>
   <div class="row">
    <div class="col-xs-12">
      <div class="panel-body">
        <table id="traits-table"></table><div id="traitPager"></div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-script')
@include('visite.scripts.scripts')
<script type="text/javascript"> 
  function commonError(data) {
    return "Error Occured during Operation. Please try again";
  }
  function updatActe(params) {
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
  function geMedicamentValue(rowid, value, name)
  {
    var IdCell = $('#traits-table').getRowData(rowid);
    var spec_id =  (isEmpty(IdCell.spec_id)) ? 1 : IdCell.spec_id;
    return '/getproduits/1/'+ spec_id;
  }
  function UpdateTrait(params)
  {
    url = '{{ route("traitement.update", ":slug") }}'; 
    url = url.replace(':slug', params.id);
    params['_token'] =CSRF_TOKEN;
    params['editurl'] =url;
    params['visite_id'] = '{{ $visite->id }}';
    $.ajax({
        type:"PUT",
        url:url,
        data: params,
        dataType:'json',
        success: function (data) {} 
    })
  }
  function addTrait(params)
  {
    url = '{{ route("traitement.store") }}'; 
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
  function deleteTrait(id) 
  {
    var url = '{{ route("traitement.destroy", ":slug") }}'; 
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
  $("#actes-table").jqGrid({
    url: '/visteActes/{{ $visite->id }}',
    mtype: "GET",
    datatype: "json",
    colNames:['ID', 'Acte','Type','NGAP','Application','P/Jour'],
    colModel:[
    { name:'id', index:'id', editable: false, width:20, hidden:true, editable: true},
    {name:'nom',index:'nom',editable: true, width:130,editoptions: {size:67}},
    {name:'type',index:'type', editable: true, width:60, edittype:'select',editoptions: {value: "paramedicale:paramédicale;medicale:médicale", editrules: { required: true }}},
    {name:'code_ngap',index:'code_ngap', editable: true, edittype:"select", width:20,edittype:'select', editoptions: {value: '{!! $ngaps !!}' , editrules: { required: false }}},
    {name:'description',index:'description', editable: true, width:130,edittype:"textarea",editoptions:{rows:"3",cols:"67"}},       
    {name:'nbrFJ',index:'nbrFJ',editable:true, edittype:"text", width:17,
      editoptions:{ size: 15, maxlengh: 10,
        dataInit: function(element) {
          $(element).keyup(function(){
            var val1 = element.value;
            var num = new Number(val1);
            if(isNaN(num))
              {alert("S'il vous plait, entrez un nombre valide");}
          })
        }
      }
    }],
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
      closeAfterEdit: true,//savekey: [true, 13],  
      errorTextFormat: commonError, 
      width: "600", 
      reloadAfterSubmit: true, 
      bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
      top: "60",left: "5", right: "5",
      onclickSubmit: function (response, actedata) {
        updatActe(actedata);
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
      url : '{{ route("traitement.index", ["visId"=>$visite->id])}}',
      mtype: "GET",
      datatype: "json",
      colNames:['ID','spec_id' ,'Spécialite','Médicament','Posologie','P/Jour','Médecin'],
      colModel:[
            { name:'id',index:'id',editable: false, hidden:true, editable: true},
            { name:'spec_id',index:'spec_id',editable: false, hidden:true, editable: false,
              formatter: function (cellvalue, options, rowObject) 
              {
                return rowObject.medicament.specialite.id;
              }
            },
            {  name: 'specialiteProd', index: 'specialiteProd',hidden:true,editable: true,edittype:'select', editoptions: { value: '{!! $specs !!}' },
                formatter: function (cellvalue, options, rowObject) 
                {
                  return rowObject.medicament.specialite.nom;
                }, editrules : { edithidden : true }
            },
            { name:'med_id', index:'med_id',editable: true, edittype:'select', editoptions: {
                  dataUrl: geMedicamentValue,
                  datatype: "json",
                  aysnc: false,
                  defaultValue:1,
                  buildSelect: function (data) {
                    var response = jQuery.parseJSON(data);
                    var s = '<select>';
                    $.each(response, function () {
                     s += '<option value="' + this.id + '">' + this.nom + '</option>';
                    });
                    return s + '</select>' ;
                  }
              },
              formatter: function (cellvalue, options, rowObject) 
              {
                return rowObject.medicament.nom;
              }
            },
            { name:'posologie', index:'posologie',editable: true, width:100, editable: true, editoptions: {size:50} },
            { name:'nbrPJ', index:'nbrPJ',editable: true, width:17, editable: true,
              editoptions:{ size: 15, maxlengh: 10,
                dataInit: function(element) {
                  $(element).keyup(function(){
                    var val1 = element.value;
                    var num = new Number(val1);
                    if(isNaN(num))
                      {alert("S'il vous plait, entrez un nombre valide");}
                  })
                }
              }
            },
            { name: 'medecin', index: 'medecin',width:60,
            formatter: function (cellvalue, options, rowObject) 
            {
              return rowObject.visite.medecin.full_name;
            }
      }],
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
    $("#traits-table").jqGrid('navGrid','#traitPager',
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
         UpdateTrait(actedata);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      }
    },
    {
      width: "600", 
      closeOnEscape: true, 
      closeAfterAdd: true,
      recreateForm: true,
      reloadAfterSubmit: true,
      errorTextFormat: commonError,
      bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
      onclickSubmit: function (response, actedata) {
        addTrait(actedata);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      },
      beforeShowForm: function() {
        $("#specialiteProd").val('1');
      }
    },
    {
      closeOnEscape: true, 
      recreateForm: true,
      reloadAfterSubmit: true,
      errorTextFormat: commonError,
      onclickSubmit: function (response, actedata) {
        deleteTrait(actedata);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      }
    });
    $("#traits-table").jqGrid('navGrid','#traitPager',
    {
        edit:true, edittitle: "Edit Acte",
        add:true, addtitle: "Add Acte",
        del:true,
        refresh: false,
        view:true,
        viewicon : 'ace-icon fa fa-search-plus grey',
        addicon : 'ace-icon fa fa-plus-circle purple',
    });
});
 </script>
@endsection