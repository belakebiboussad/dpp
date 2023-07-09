<script>
function addExamImg(params)
{
  url = '{{ route("exmRad.store") }}'; 
  params['_token'] =CSRF_TOKEN;
  params['visit_id'] ='{{ $visite->id}}';
  params['demande_id'] ='{!! $visite->demandExmImg->id !!}';
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
$(function(){
  var url = '{{ route("demandeexr.edit", ":slug") }}'; 
  url = url.replace(':slug', '{!!$visite->demandExmImg->id!!}');
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
})
</script>