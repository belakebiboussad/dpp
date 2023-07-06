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
    <div class="col-xs-12">@include('visite.partials._show')</div>  
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="panel-body">
        <table id="actes-table" ></table> <div id="actesPager"></div>
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
  <div class="row">
    <div class="col-xs-12">
      <div class="panel-body">
        <table id="demandeBio-table"></table><div id="BiologPager"></div>
      </div>
    </div>  
  </div>
   <div class="row">
    <div class="col-xs-12">
      <div class="panel-body"><table id="demandeImg-table"></table><div id="ImgPager"></div>
      </div>
    </div>  
  </div>
   <div class="row">
    <div class="col-xs-12">
      <div class="panel-body"><table id="consts-table"></table><div id="ConstsPager"></div>
      </div>
    </div>  
  </div>
  <div class="hr hr-dotted"></div>
  <div class="row">
    <div class="center">
      <a href="{{ URL::previous() }}" class="btn btn-info btn-sm"<i class="ace-icon fa fa-save bigger-110"></i> Enregistrer</a>  
      </div>
    </div>
</div>
@stop
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
    $.ajax({
      type:"DELETE",
      url:url,
      data: { _token: CSRF_TOKEN },
      dataType:'json',
      success: function (data) { }
    }) 
  }
  function getMedicaments(rowid, value, name)
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
   $.ajax({
      type:"DELETE",
      url:url,
      data: { _token: CSRF_TOKEN },
      dataType:'json',
      success: function (data) { }
    }) 
  }
  function examDelete(id) 
  {
    var formData = {
      _token: CSRF_TOKEN,
      demande_id : '{!! $visite->demandeexmbio['id'] !!}',
    };
    var url = '{{ route("exmbio.destroy", ":slug") }}'; 
    url = url.replace(':slug', id);
    $.ajax({
      type:"DELETE",
      url:url,
      data: formData,
      dataType:'json',
      success: function (data) { }
    }) 
  }
  function addExamB(params)
  {
    url = '{{ route("exmbio.store") }}'; 
    params['_token'] =CSRF_TOKEN;
    params['visit_id'] ='{{ $visite->id}}';
    params['id_demande'] ='{{ $visite->demandeexmbio['id']}}';
    params['editurl'] =url;
    $.ajax({
      type:"POST",
      url:url,
      data: params,
      dataType:'json',
      success: function (data) {
        if($("#demandeBio-table").getRowData().length ==0)
         location.reload();    
      }
    })
  }
  function addExamImg(params)
  {
    url = '{{ route("exmRad.store") }}'; 
    params['_token'] =CSRF_TOKEN;
    params['visit_id'] ='{{ $visite->id}}';
    params['demande_id'] ='{!! $visite->demandExmImg['id']!!}';
    params['editurl'] =url;
    $.ajax({
      type:"POST",
      url:url,
      data: params,
      dataType:'json',
      success: function (data) {
        if($("#demandeImg-table").getRowData().length ==0)
         location.reload();    
      }
    })
  }
  function examImgDelete(id)
  {
    var formData = { _token: CSRF_TOKEN };
    url='{{ route("exmRad.destroy",":slug") }}';
    url = url.replace(':slug',id);
    $.ajax({
      type:"DELETE",
      url:url,
      data: {  _token: CSRF_TOKEN } ,
      dataType:'json',
      success: function (data) {}
    }) 
  }
  function addConst(params)
  {
    url = '{{ route("const.store") }}'; 
    params['_token'] =CSRF_TOKEN;
    params['visit_id'] ='{{ $visite->id}}';
    params['editurl'] =url;
    $.ajax({
      type:"POST",
      url:url,
      data: params,
      dataType:'json',
      success: function (data) {
        if($("#consts-table").getRowData().length ==0)
         location.reload();    
      }
    })
  }
  function ConstDelete(id)
  {
    var formData = {
      _token: CSRF_TOKEN,
      visit_id : '{!! $visite->id !!}',
    };
    var url = '{{ route("const.destroy", ":slug") }}'; 
    url = url.replace(':slug', id);
    $.ajax({
      type:"DELETE",
      url:url,
      data: formData,
      dataType:'json',
      success: function (data) { }
    }) 
  }
  $(function(){
  $("#actes-table").jqGrid({
    url : '{{ route("acte.index", ["visId"=>$visite->id])}}',
    mtype: "GET",
    datatype: "json",
    colNames:['ID', 'Acte','Type','NGAP','Application','P/Jour'],
    colModel:[
    { name:'id', index:'id', hidden:true, editable: true},
    {name:'nom',index:'nom',editable: true,editoptions:{size:67},editrules:{required:true}},
    {name:'type',index:'type',editable:true,edittype:'select',editoptions: {value: "paramedicale:paramédicale;medicale:médicale"}},
    {name:'code_ngap',index:'code_ngap',editable: true,edittype:"select",editoptions: {value: '{!! $ngaps !!}'},width:20},
    {name:'description',index:'description', editable: true, edittype:"textarea",editoptions:{rows:"3",cols:"67"},editrules:{required:true}},       
    {name:'nbrFJ',index:'nbrFJ',editable:true, edittype:"text",
      editoptions:{ size: 15, maxlengh: 10,
        dataInit: function(element) {
          $(element).keyup(function(){
            var val1 = element.value;
            var num = new Number(val1);
            if(isNaN(num))
              {alert("S'il vous plait, entrez un nombre valide");}
          })
        }
      },editrules:{required:true}
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
    emptyrecords: "0 enregistrements trouvés",
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
      onclickSubmit: function (response, id) {
        deleteActe(id);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      }
    });
  $("#traits-table").jqGrid({
      url : '{{ route("traitement.index", ["visId"=>$visite->id])}}',
      mtype: "GET",
      datatype: "json",
      colNames:['ID','spec_id' ,'Spécialite','Médicament','Posologie','P/Jour','Médecin'],
      colModel:[
            { name:'id',index:'id', hidden:true, editable: true},
            { name:'spec_id',index:'spec_id',hidden:true, editable: false,
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
                  dataUrl: getMedicaments,
                  datatype: "json",
                  aysnc: false,
                  buildSelect: function (data) {
                    var response = jQuery.parseJSON(data);
                    var s = '<select>';
                    $.each(response, function () {
                     s += '<option value="' + this.id + '">' + this.nom + '</option>';
                    });
                    return s + '</select>' ;
                  }
              },editrules:{required:true},
              formatter: function (cellvalue, options, rowObject) 
              {
                return rowObject.medicament.nom;
              }
            },
            { name:'posologie',index:'posologie',width:100,editable:true,editoptions: {size:50},editrules:{required:true}},
            { name:'nbrPJ', index:'nbrPJ', editable: true, width:17,
              editoptions:{ size: 15, maxlengh: 10,
                dataInit: function(element) {
                  $(element).keyup(function(){
                    var val1 = element.value;
                    var num = new Number(val1);
                    if(isNaN(num))
                      {alert("S'il vous plait, entrez un nombre valide");}
                  })
                }},editrules:{required:true} 
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
      emptyrecords: "0 enregistrements trouvés",
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
      onclickSubmit: function (response, traitdata) {
        addTrait(traitdata);
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
      onclickSubmit: function (response, id) {
        deleteTrait(id);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      }
    });
    $("#traits-table").jqGrid('navGrid','#traitPager',
    {
      edit:true, edittitle: "Edit Acte",
      add:true, addtitle: "Add Acte",
      del:true, refresh: false, view:true,
      viewicon : 'ace-icon fa fa-search-plus grey',
      addicon : 'ace-icon fa fa-plus-circle purple',
    });
    var url = '{{ route("demandeexb.edit", ":slug") }}'; 
    url = url.replace(':slug', '{!!$visite->demandeexmbio['id']!!}');
    $("#demandeBio-table").jqGrid(
    {
      url :url ,
      mtype: "GET",
      datatype: "json",
      colNames:['ID','Nom','Specialite'],
      colModel:[
      { name:'id',index:'id',editable: true, hidden:true},
      { name:'nom', index:'nom', editable: true, edittype:'select',editrules:{required:true},
        editoptions: {value:'{!!$formatString($specialite->BioExams,'id','nom')!!}',defaultValue:1}
      },
      {
        name: 'spec', index: 'spec', editable: false,edittype:'select', 
        formatter: function (cellvalue, options, rowObject) 
        {
          return rowObject.specialite.nom;
        }, editrules : { edithidden : true }
      }],
      width: 1146,
      height: "auto",
      rowNum:10,
      loadonce: true,
      rowList:[10,20,30],
      multiselect: true,
      pager: '#BiologPager',
      sortname: 'nom',
      viewrecords: true,
      sortorder: "desc",
      editurl : '/demandeb/edit',
      caption:"Demande examens biologiques",
      emptyrecords: "0 enregistrements trouvés",
    });
    $("#demandeBio-table").jqGrid('navGrid','#BiologPager',
    {
      edit:false,
      add:true, addtitle: "Ajouter un examen",
      addicon : 'ace-icon fa fa-plus-circle purple',
      view:false,search:false,
    },{},{
      width: "600", 
      closeOnEscape: true, 
      closeAfterAdd: true,
      recreateForm: true,
      reloadAfterSubmit: true,
      errorTextFormat: commonError,
      bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
      onclickSubmit: function (response, biodata) {
        addExamB(biodata);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      },
    },
    {
      loseOnEscape: true, 
      recreateForm: true,
      reloadAfterSubmit: true,
      errorTextFormat: commonError,
      onclickSubmit: function (response, id) {
        examDelete(id);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      }
    });
    var url = '{{ route("demandeexr.edit", ":slug") }}'; 
    url = url.replace(':slug', '{!!$visite->demandExmImg['id']!!}');
    $("#demandeImg-table").jqGrid(
    {
      url :url ,
      mtype: "GET",
      datatype: "json",
      colNames:['ID','Nom','Type'],
      colModel:[
        { name:'id',index:'id',editable: true, hidden:true},
        { name:'nom', index:'nom', editable: true, edittype:'select',editrules:{required:true},
          editoptions: {value:'{!! $examensradio!!}', defaultValue:1},editrules: { required: true },
          formatter: function (cellvalue, options, rowObject) 
          {
            return rowObject.examen.nom;
          }
        },
        {name:'Type', index:'Type', editable: true, edittype:'select',editrules: { required: true },
          editoptions: {value:'{!!$formatString($specialite->ImgExams,'id','nom')!!}',defaultValue:1},
          formatter: function (cellvalue, options, rowObject) 
          {
            return rowObject.type.nom;
          }}
      ],
      width: 1146,
      height: "auto",
      rowNum:10,
      loadonce: true,
      rowList:[10,20,30],
      multiselect: true,
      pager: '#ImgPager',
      sortname: 'nom',
      viewrecords: true,
      sortorder: "desc",
      editurl : '/demandeexr/edit',
      caption:"Demande examens d'imagerie",
      emptyrecords: "0 enregistrements trouvés",
    });
    $("#demandeImg-table").jqGrid('navGrid','#ImgPager',
    {
      edit:false,
      add:true, addtitle: "Ajouter un examen",
      addicon : 'ace-icon fa fa-plus-circle purple',
      view:false,search:false,
    },{},{
      width: "600", 
      closeOnEscape: true, 
      closeAfterAdd: true,
      recreateForm: true,
      reloadAfterSubmit: true,
      errorTextFormat: commonError,
      bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
      onclickSubmit: function (response, imgdata) {
        addExamImg(imgdata);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      },
    },
    {
      loseOnEscape: true, 
      recreateForm: true,
      reloadAfterSubmit: true,
      errorTextFormat: commonError,
      onclickSubmit: function (response, id) {
        examImgDelete(id);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      }
    });
    var url = '{{ route("const.edit", ":slug") }}'; 
    url = url.replace(':slug', '{!!$visite->id!!}');
   $("#consts-table").jqGrid(
    {
      url :url ,
      mtype: "GET",
      datatype: "json",
      colNames:['ID','Nom','Observation'],
      colModel:[
        { name:'id', index:'id',editable: true, hidden:true},
        { name:'nom', index:'nom', editable:true, edittype:'select',
          editoptions: { value: '{!!$formatString($specialite->Consts,'id','nom')!!}', defaultValue:1}
        },
        { name:'obs', index:'obs', editable: true, editoptions: {size:67},
          formatter: function (cellvalue, options, rowObject) 
          {
            return rowObject.pivot.obs;
          }
        }
      ],
      width: 1146,
      height: "auto",
      rowNum:10,
      loadonce: true,
      rowList:[10,20,30],
      multiselect: true,
      pager: '#ConstsPager',
      sortname: 'nom',
      viewrecords: true,
      sortorder: "desc",
      editurl : '/const/edit',
      caption:"Constantes Médicaux",
      emptyrecords: "0 enregistrements trouvés",
    });
    $("#consts-table").jqGrid('navGrid','#ConstsPager',
    {
      edit:false,
      add:true, addtitle: "Ajouter une Constante",
      addicon : 'ace-icon fa fa-plus-circle purple',
      view:false,search:false,
    },{},{
      width: "600", 
      closeOnEscape: true, 
      closeAfterAdd: true,
      recreateForm: true,
      reloadAfterSubmit: true,
      errorTextFormat: commonError,
      bottominfo: "Les champs marqués d'un (*) sont obligatoires !", 
      onclickSubmit: function (response, imgdata) {
        addConst(imgdata);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      },
    },
    {
      loseOnEscape: true, 
      recreateForm: true,
      reloadAfterSubmit: true,
      errorTextFormat: commonError,
      onclickSubmit: function (response, id) {
        ConstDelete(id);
        $(this).jqGrid("setGridParam", { datatype: "json" });
      }
    });
});
 </script>
@stop