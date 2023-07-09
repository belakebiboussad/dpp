<script>
  function addExamB(params)
  {
    url = '{{ route("exmbio.store") }}'; 
    params['_token'] =CSRF_TOKEN;
    params['visit_id'] ='{{ $visite->id}}';
    params['id_demande'] ='{{$visite->demandeexmbio['id']}}';
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
  function examDelete(id) 
  {
    var formData = {
      _token: CSRF_TOKEN,
      demande_id : '{!! $visite->demandeexmbio->id !!}',
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

$(function(){
  var url = '{{ route("demandeexb.edit", ":slug") }}'; 
  url = url.replace(':slug', '{!! $visite->demandeexmbio->id !!}');
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
  })
</script>