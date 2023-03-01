@extends('app')
@section('main-content')
<div class="container-fluid">
  <div class="page-header"> @include('patient._patientInfo',['patient'=>$visite->hospitalisation->patient])
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default col-xs-12">
        <div class="panel-heading"></div>
        <div class="panel-body">
          <table id="grid-table"></table>
          <div id="grid-pager"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('page-script')
<script type="text/javascript">
  function beforeDeleteCallback(e) {
          var form = $(e[0]);
          if(form.data('styled')) return false;
          
          form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
          style_delete_form(form);
          
          form.data('styled', true);
  }
   function pickDate( cellvalue, options, cell ) {
          setTimeout(function(){
            $(cell) .find('input[type=text]')
              .datepicker({format:'yyyy-mm-dd' , autoclose:true}); 
          }, 0);
        }
   function aceSwitch( cellvalue, options, cell ) {
          setTimeout(function(){
            $(cell) .find('input[type=checkbox]')
              .addClass('ace ace-switch ace-switch-5')
              .after('<span class="lbl"></span>');
          }, 0);
        }
    function styleCheckbox(table) {
        
        }
  function updateActionIcons(table) {
          
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
        
  $(function(){
    var grid_selector = "#grid-table";
    var pager_selector = "#grid-pager";
    var grid_data = 
      [ 
        {id:"1",name:"Desktop Computer",note:"note",stock:"Yes",ship:"FedEx", sdate:"2007-12-03"},
        {id:"2",name:"Laptop",note:"Long text ",stock:"Yes",ship:"InTime",sdate:"2007-12-03"},
        {id:"3",name:"LCD Monitor",note:"note3",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
        {id:"4",name:"Speakers",note:"note",stock:"No",ship:"ARAMEX",sdate:"2007-12-03"},
        {id:"5",name:"Laser Printer",note:"note2",stock:"Yes",ship:"FedEx",sdate:"2007-12-03"},
        {id:"6",name:"Play Station",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
        {id:"7",name:"Mobile Telephone",note:"note",stock:"Yes",ship:"ARAMEX",sdate:"2007-12-03"},
        {id:"8",name:"Server",note:"note2",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
        {id:"9",name:"Matrix Printer",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
        {id:"10",name:"Desktop Computer",note:"note",stock:"Yes",ship:"FedEx", sdate:"2007-12-03"},
        {id:"11",name:"Laptop",note:"Long text ",stock:"Yes",ship:"InTime",sdate:"2007-12-03"},
        {id:"12",name:"LCD Monitor",note:"note3",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
        {id:"13",name:"Speakers",note:"note",stock:"No",ship:"ARAMEX",sdate:"2007-12-03"},
        {id:"14",name:"Laser Printer",note:"note2",stock:"Yes",ship:"FedEx",sdate:"2007-12-03"},
        {id:"15",name:"Play Station",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
        {id:"16",name:"Mobile Telephone",note:"note",stock:"Yes",ship:"ARAMEX",sdate:"2007-12-03"},
        {id:"17",name:"Server",note:"note2",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
        {id:"18",name:"Matrix Printer",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
        {id:"19",name:"Matrix Printer",note:"note3",stock:"No", ship:"FedEx",sdate:"2007-12-03"},
        {id:"20",name:"Desktop Computer",note:"note",stock:"Yes",ship:"FedEx", sdate:"2007-12-03"},
        {id:"21",name:"Laptop",note:"Long text ",stock:"Yes",ship:"InTime",sdate:"2007-12-03"},
        {id:"22",name:"LCD Monitor",note:"note3",stock:"Yes",ship:"TNT",sdate:"2007-12-03"},
        {id:"23",name:"Speakers",note:"note",stock:"No",ship:"ARAMEX",sdate:"2007-12-03"}
      ];
           
      var parent_column = $(grid_selector).closest('[class*="col-"]');
        //resize to fit page size
      $(window).on('resize.jqGrid', function () {
        $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
      });
      //resize on sidebar collapse/expand
      $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
        if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
          setTimeout(function() {
          $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
          }, 20);
        }
      }); 
      jQuery(grid_selector).jqGrid({
       
          data: grid_data,
          datatype: "local",
          height: 250,
          colNames:[' ', 'ID','Last Sales','Name', 'Stock', 'Ship via','Notes'],
          colModel:[
            {name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,
              formatter:'actions', 
              formatoptions:{ 
                keys:true,
                delOptions:{recreateForm: true, beforeShowForm:beforeDeleteCallback},
              }
            },
            {name:'id',index:'id', width:60, sorttype:"int", editable: true},
            {name:'sdate',index:'sdate',width:90, editable:true, sorttype:"date",unformat: pickDate},
            {name:'name',index:'name', width:150,editable: true,editoptions:{size:"20",maxlength:"30"}},
            {name:'stock',index:'stock', width:70, editable: true,edittype:"checkbox",editoptions: {value:"Yes:No"},unformat: aceSwitch},
            {name:'ship',index:'ship', width:90, editable: true,edittype:"select",editoptions:{value:"FE:FedEx;IN:InTime;TN:TNT;AR:ARAMEX"}},
            {name:'note',index:'note', width:150, sortable:false,editable: true,edittype:"textarea", editoptions:{rows:"2",cols:"10"}} 
          ],
           viewrecords : true,
          rowNum:10,
          rowList:[10,20,30],
          pager : pager_selector,
          altRows: true,
          multiselect: true,
          multiboxonly: true,
          caption: "Actes",
          loadComplete : function() {
            var table = this;
            setTimeout(function(){
              styleCheckbox(table);
              updateActionIcons(table);
              updatePagerIcons(table);
              enableTooltips(table);
            }, 0);
          },
          editurl: "{{ route('acte.edit',95)}}",//nothing is saved
          caption: "jqGrid with inline editing"
        }); 
          $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size  
    // $("#actes-table").jqGrid({
    //     url: '/visteActes/{{ $visite->id }}',
    //     mtype: "GET",
    //     datatype: "json",
    //     colModel: [
    //       {  label: 'ID', name: 'id', "key":true, width: 30, "hidden":true},
    //       { label: 'Nom', name: 'nom', width: 90 },
    //       { label: 'Description', name: 'description', width: 130 },
    //       { label: 'Type', name: 'type', width: 60 },
    //       { label: 'NGAP', name: 'code_ngap', width: 40 },
    //       { label: 'fois/j', name: 'nbrFJ', width: 40 }  
    //     ],
    //     viewrecords: true,
    //     width: 1146,
    //     height: 250,
    //     rowNum: 20,
    //     gridview: true,
    //     pager: "#jqGridPager",
    //     caption: "Actes"
    //   });
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