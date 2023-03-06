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
        url : '{{ route("traitement.index", ["visId"=>$visite->id])}}',
        mtype: "GET",
        datatype: "json",
        colNames:['ID','Medicament','posologie','medecin'],
        colModel:[
          { name:'id',index:'id',editable: false, width:20, hidden:false, editable: true },
          { name: 'medicament', index: 'medicament',
            formatter: function (cellvalue, options, rowObject) 
                      {
                         return rowObject.medicament.nom;
                      }
          },
          { name:'posologie', index:'posologie',editable: true, width:50, hidden:false, editable: true },
          { name: 'medecin', index: 'medecin',
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