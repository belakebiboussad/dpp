@extends('app_dele')
@section('main-content')
<div class="container-fluid">
<div class="row">
  <div class="col-sm-12 col-md-12"> <h4>Rechercher un colloque</h4>
    <div class="panel panel-default"><div class="panel-heading">Rechercher par :</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-4"><label>Date :</label>
              <div class="input-group">
                <input type="text" id ="date" class="date-picker form-control filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
                <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
              </div> 
          </div> 
          <div class="col-sm-4 col-sm-offset-1"> <label>Etat :</label>
             <select id='etat' class="form-control filter">
              <option value="" selected active>En cours</option>
              <option value="1">Cloturée</option>
            </select>
          </div>
        </div>
      </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-sm btn-primary colFind"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
      </div>
    </div>
  </div>
</div>
<div class="row"> 
  <div class="col-xs-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>
      	Liste des Colloques du Service {{ $service->nom}}
			</h5>&nbsp;<span class="badge badge-info numberResult"></span>
			<div class="widget-toolbar widget-toolbar-light no-border">
			  <div class="fa fa-plus-circle"></div><a href="{{route('colloque.create')}}"><b>Colloque</b></a>
			</div>	
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding"><table class="display table-responsive" id="liste_colloques"></table>
			</div>
		</div><!-- widget-body -->
	</div><!-- widget-box -->
</div><!-- widget-container-col -->
</div>
</div>
@endsection
@section('page-script')
<script type="text/javascript">
  function getMembers(data, type, dataToSet) {
    $empls ="<ul>";
    $.each(data.employs,function(key, employ){
     $empls += "<li>" + employ.full_name+"</li>"
    });
    $empls +="</ul>";
    return $empls; 
  }
  function getAction(data, type, dataToSet) {
    var actions ='<a href = "/colloque/'+data.id+'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Détails"><i class="fa fa-hand-o-up fa-xs"></i></a>';
    if(data.etat != "Cloturé"){
      actions +='&nbsp;<a href="/colloque/'+data.id+'/edit" class="btn btn-info btn-xs" title="editer Colloque"><i class="fa fa-edit fa-xs"></i></a>';
      actions += '&nbsp;<a href="/runcolloque/' + data.id + '" class="btn btn-xs btn-green" title="Déroulement"><i class="ace-icon fa fa-cog  bigger-110"></i></a>';
      actions += '&nbsp;<button class="btn btn-xs btn-danger deleteColloque" data-id="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button>';
    }
    return actions;     
  }
  function loadDataTable(data){
    $('#liste_colloques').dataTable({
          "paging":   true,
          "destroy": true,
          "ordering": true,
          "searching":false,
          'bLengthChange': false,
          "info" : false,
          "language":{"url": '/localisation/fr_FR.json'},
          "data" : data,
          "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                       $(nRow).attr('id',"col"+aData.id);
          },
          "columns": [
            { data: null ,
              render: function ( data, type, row ) {
                var createdDate = new Date(row.date);
                var diff = createdDate.getDate() - createdDate.getDay() + (createdDate.getDay() === 6 ? 0 : 7);
                var sund = new Date(createdDate.setDate(diff));
                var date = sund.getFullYear() + '-' + (sund.getMonth()+1) + '-' + ('0'+ sund.getDate()).slice(-2);
                return(date);
              }, title:'Semaine du' 
            },
            { data: getMembers , title:'Membres'},
            { data: "date" , title:'créer le'},
            { data: 'service.nom', title:'Service'},
            { data: null, title:'Etat',
              render: function ( data, type, row ) {
                  return '<span class="badge badge-info">' + row.etat +'</span>';
              }
          },
            { data:getAction , title:'<em class="fa fa-cog"></em>'}
          ],
          "columnDefs": [
              {"targets": 0 ,  className: "dt-head-center"},
              {"targets": 1 ,  className: "dt-head-center", "orderable":false},
              {"targets": 2 ,  className: "dt-head-center" },
              {"targets": 3 ,  className: "dt-head-center", "orderable":false },
              {"targets": 4 ,  className: "dt-head-center", "orderable":false},
              {"targets": 5 ,  className: "dt-head-center dt-body-center", "orderable":false, searchable: false},
          ]
    });
  }
  function getColloques(field,value)
  {
    $.ajax({
            url:  '{{ route("colloque.index") }}',
            data: {"field":field, "value":value}, //dataType: "json",
            success: function (data) {
              $(".numberResult").html(data.length);
              loadDataTable(data);
            }
    })
  }
  var field ="etat";
  $(function(){
    field= "etat"; 
    getColloques(field, null);
    $('body').on('click','.colFind',function(event){
      getColloques(field,$('#'+field).val().trim());
    });
    $('body').on('click', '.deleteColloque', function (event) {
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
      $.ajax(
      {
        url: "colloque/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (data){
          $("#col" + data.id).remove();
        }
      });
    });
  });
</script>
@endsection
