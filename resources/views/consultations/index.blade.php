@extends('app')
@section('page-script')
 <script >
  function getConsultations(field,value)
  {
   	$.ajax({
         	url : '{{ URL::to('getConsultations') }}',
          data: {    
                "field":field,
                "value":value,
          },
          dataType: "json",// recommended response type
        	success: function(data) {
                  
                  $(".numberResult").html(data.length);
                  $("#liste_conultations").DataTable ({
                        "processing": true,
                        "paging":   true,
                        "destroy": true,
                        "ordering": true,
                        "searching":false,
                        "info" : false,
                        "responsive": true,
                        "language":{"url": '/localisation/fr_FR.json'},
                        "data" : data,// "scrollX": true,
                        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                            $(nRow).attr('id',"consult"+aData.id);
                        },
                        "columns": [
                                { data: null,
                                  render: function ( data, type, row ) {
                                    return moment(row.date).format('YYYY-MM-DD');
                                  },title:'Date'
                                },
                                { data: null,
                                  render: function ( data, type, row ) {
                                    var url = '{{ route("patient.show", ":slug") }}'; 
                                    url = url.replace(':slug',row.patient.id);
                                    return '<a href="'+ url +'" title="voir patient">'+ row.patient.full_name + '</a>';
                                  }, title:'Patient',"orderable": false
                                },
                                { data: null , title:'Motif', "orderable":false,  
                                    "render": function(data,type,full,meta){
                                       return '<small>'+data.motif+'</small>';
                                    }
                                },
                                { data: null , title:'Specialite', "orderable":false,
                                  "render": function(data,type,full,meta){
                                        if(data.medecin.specialite != null)
                                              return data.medecin.specialite.nom;
                                        else
                                                return data.medecin.service.specialite.nom;       
                                    } 
                                },
                                { data: "medecin.full_name", title:'Medecin', "orderable":false },
                                { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false}
                       ],
            "columnDefs": [
              {"targets": 0 ,  className: "dt-head-center"},
              {"targets": 1 ,  className: "dt-head-center" },
              {"targets": 2 ,  className: "dt-head-center" },
              {"targets": 3 ,  className: "dt-head-center" },
              {"targets": 4 ,  className: "dt-head-center" },
              {"targets": 5 ,  className: "dt-head-center dt-body-center" },
            ]
        });
      }
		});
  }
  function getAction(data, type, dataToSet) 
  {
	  var actions = '<a href = "/consultations/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title="Détails consultation"><i class="fa fa-hand-o-up fa-xs"></i></a>&nbsp;';
	      actions +='<a href = "/consultations/create/'+data.patient.id+'" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Ajouter consultation"><i class="fa fa-plus-circle"></i></a>&nbsp;';
        actions +='<a data-toggle="modal" href="#" class ="btn btn-info btn-xs" onclick ="ImprimerEtat(3,\'consultation\','+data.id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
	  return actions;
	}
 	$(function(){
   	field= "date"; 
    getConsultations(field,'<?= date("Y-m-j") ?>');
    $(document).on('click','.findconsult',function(event){
      getConsultations(field,$('#'+field).val().trim());
    	if(field != "date")
    		$('#'+field).val('');	
    });
  });
 </script>
@stop
@section('main-content')
<div class="row">
	<div class="col-md-12 col-sm-12"> <h4>Rechercher une consultation</h4>
  	<div class="panel panel-default"><div class="panel-heading">Rechercher par :</div>
    	<div class="panel-body">
      <div class="row filter-row">
      		<div class="col-sm-4">
        	<div class="form-group"><label>Nom du patient </label><input type="text" id="Nom" class="form-control filter autofield"></div>
         	</div>
            <div class="col-sm-4">
            <div class="form-group"><label>Identifiant permanent (IPP)</label><input type="text" id="IPP" class="form-control filter"></div>
          </div>
      		<div class="col-sm-4">
      			<div class="form-group"><label>Date de la consultation</label>
    			    <div class="input-group">
			     		  <input type="text" id ="date" class="date-picker form-control ltnow filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
					      <span class="input-group-addon fa fa-calendar"></span>
					    </div>
		        </div>
      		</div>	
      	</div>
    	</div>
    	<div class="panel-footer">
    		<button type="submit" class="btn btn-primary btn-sm findconsult"><i class="fa fa-search"></i> Rechercher</button>
    	</div>
  	</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 widget-container-col">
	<div class="widget-box transparent">
		<div class="widget-header"><h5 class="widget-title bigger lighter">
      <i class="ace-icon fa fa-table"></i>Consultations</h5>&nbsp;<span class="badge badge-info numberResult"></span>
    </div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="display table-responsive" id="liste_conultations"></table>
			</div>
	  	</div>	
	 </div>
</div>
</div>
<div class="row">@include('hospitalisations.ModalForms.EtatSortie')</div>
@stop