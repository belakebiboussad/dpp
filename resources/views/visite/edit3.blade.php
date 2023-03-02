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
  function updateActionIcons(table) {
    /***/
    var replacement = 
    {
      'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
      'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
      'ui-icon-disk' : 'ace-icon fa fa-check green',
      'ui-icon-cancel' : 'ace-icon fa fa-times red'
      };
      $(table).find('.ui-pg-div span.ui-icon').each(function(){
        var icon = $(this);
        var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
        if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
          })      
  }
  //replace icons with FontAwesome icons like above
  function updatePagerIcons(table) {
          var replacement = 
          {
            'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
            'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
            'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
            'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
          };
          $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
            
            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
          })
  }
  function beforeDeleteCallback(e) {
    var form = $(e[0]);
    if(form.data('styled')) return false;
    
    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
    style_delete_form(form);
    
    form.data('styled', true);
  }
  function style_edit_form(form) {
      //update buttons classes
    var buttons = form.next().find('.EditButton .fm-button');
    buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
    buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
    buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')
    
    buttons = form.next().find('.navButton a');
    buttons.find('.ui-icon').hide();
    buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
    buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');   
  }
   function style_delete_form(form) {
      var buttons = form.next().find('.EditButton .fm-button');
      buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
      buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
      buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
  }
  function beforeEditCallback(e) {
    var form = $(e[0]);
    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
    style_edit_form(form);
  }
  function beforeDeleteCallback(e) {
    var form = $(e[0]);
    if(form.data('styled')) return false;
    form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
    style_delete_form(form);
    form.data('styled', true);
  }
  function enableTooltips(table) {
    $('.navtable .ui-pg-button').tooltip({container:'body'});
    $(table).find('.ui-pg-div').tooltip({container:'body'});
  }
  function typeSelect()
  {
    return "paramedicale:paramédicale;medicale:médicale";
  }
  function NgapSelect()
  {
    return '{!! $ngaps !!}';
  }
  function aftersavefunc()
  {
    alert("daved");
  }
  $(function(){
    var MemNo = "";
    var lastSelectedRow = "";
    var grid_selector = "#grid-table";
    $("#actes-table").jqGrid({
        url: '/visteActes/{{ $visite->id }}',
        mtype: "GET",
        datatype: "json",
        colModel: [
          { label: 'ID', name: 'id', "key":true, type: 'int', width: 30, editable: true, "hidden":true},
          { label: 'Nom', name: 'nom', editable: true,editoptions:{size:"20",maxlength:"30"}, width: 130},
          { label: 'Description', name: 'description', editable: true, width: 130 },
          { label: 'Type', name: 'type', width: 60 , editable: true, edittype:'select',
             editoptions: { value: typeSelect(), editrules: { required: true },
             dataEvents: [{
                 type: 'change', fn: function(e) {
                     var thisval = $(e.target).val();
                     $("#targetsel").html(targetSelect(thisval))
                 } }]
             }
          },
          { label: 'NGAP', name: 'code_ngap',editable: true, edittype:'select',
            editoptions: { value: NgapSelect() , editrules: { required: false }},
           width: 40 },
          { label: 'Fois/j', name: 'nbrFJ', editable: true, width: 20 },
          { label:'<em class="fa fa-cog"></em>',name:' ', width:80, fixed:true, sortable:false, resize:false,
              formatter:'actions', 
              formatoptions:{ 
                keys:true,
                delbutton: true,
                delOptions:{
                  recreateForm: true,
                  beforeShowForm:beforeDeleteCallback
                },
                editformbutton:true,
                editOptions:{
                  recreateForm: true,
                  beforeShowForm:beforeEditCallback
                }
              }
          }   
        ],
        viewrecords: true,
        width: 1146,
        height: "auto",
        rowNum: 20,
        gridview: true,
        altRows: true,
        multiselect: true,
        pager: "#jqGridPager",
        caption: "Actes",
        viewsortcols: true,
        editURL : '/acte/'+ 96 +'/edit',
        //editURL :'',
        loadComplete : function() {
          var table = this;
          setTimeout(function(){
            updateActionIcons(table);
            updatePagerIcons(table);
            enableTooltips(table);
          });
        },
        onSelectRow: function(acteId){
        //$("#table_actes").jqGrid('editRow',acteId,true, oneditfunc, null, null, null, aftersavefunc);
        },
        gridComplete: function(){
     
        },
      });
    jQuery("#actes-table").jqGrid('navGrid','#jqGridPager',{
        add:true,
        del:true,
        search:false,
        edit:true,
        addtext:"Add",
    },{
        height: 400,
        width: 500,
        reloadAfterSubmit: true,
        // beforeSubmit:function(row,postdata, formid){
        //     //MemNo = row.id;

        //  },
        onclickSubmit: function(params) {
          params.url = '{{ route("acte.update",96)}}';
        },
        afterSubmit:function(){
           
         },
    }).navButtonAdd("#jqGridPager",{
        // caption:"",
        // buttonicon:"",
        // onClickButton:function(){
         
        // }   

    });
    //$("#table_actes").jqGrid('footerData', 'set', { "ShipName":"Total:"}, true);
  });
</script>
@endsection