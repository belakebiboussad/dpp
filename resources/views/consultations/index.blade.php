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
                   "data" : data,  // "scrollX": true,
                   "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                         $(nRow).attr('id',"consult"+aData.id);
                    },
                    "columns": [
                        { data:null,title:'#', "orderable": false,searchable: false,
                               render: function ( data, type, row ) {
                                    if ( type === 'display' ) {
                                          return '<input type="checkbox" class="editor-active check" name="" value="'+data.id+'" onClick="" /><span class="lbl"></span>';
                                    }
                                    return data;
                               },
                               className: "dt-body-center",
                        },
                        { data: "date" , title:'Date' },
                        { data: "patient.Nom",
                          render: function ( data, type, row ) {
                            return row.patient.full_name;
                          },
                          title:'Patient',"orderable": true
                        },
                        { data: null , title:'Motif', "orderable":false,  
                            "render": function(data,type,full,meta){
                               return '<small>'+data.motif+'</small>';
                            }
                        },
                        {   data: "medecin.nom" ,
                             render: function ( data, type, row ) {
                                      return row.medecin.full_name;
                             },
                             title:'Medecin', "orderable":false, 
                        },
                        { data:getAction , title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false}

                    ],
                    "columnDefs": [
                      {"targets": 0 ,  className: "dt-head-center" },
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
  function getAction(data, type, dataToSet) {
	  var actions = '<a href = "/consultations/'+data.id+'" style="cursor:pointer" class="btn btn-secondary btn-xs" data-toggle="tooltip" title=""><i class="fa fa-hand-o-up fa-xs"></i></a>';
	  actions +='<a data-toggle="modal" href="#" class ="btn btn-info btn-xs" onclick ="ImprimerEtat(\'consultation\','+data.id+')" data-toggle="tooltip" title="Imprimer un Etat de Sortie" data-placement="bottom"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
	  return actions;
	}
 	$('document').ready(function(){
    getConsultations("date",'<?= date("Y-m-j") ?>');
   	field= "date"; 
    $(document).on('click','.findconsult',function(event){	//var value = $('#'+field).val().trim();
      getConsultations(field,$('#'+field).val().trim());
    	if(field != "date")
    		$('#'+field).val('');	
    });
  });
 </script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-sm-12 col-md-12"> <h4><strong>Rechercher une consultation</strong></h4>
  	<div class="panel panel-default"><div class="panel-heading">Rechercher par :</div>
    	<div class="panel-body">
      <div class="row">
      		<div class="col-sm-4">
        	<div class="form-group"><label><strong>  Nom du patient :</strong></label><input type="text" id="Nom" class="form-control filter autofield"></div>
         	</div>
            <div class="col-sm-4">
            <div class="form-group"><label class="control-label"><strong>Identifiant permanent (IPP):</strong></label><input type="text" id="IPP" class="form-control filter"></div>
          </div>
      		<div class="col-sm-4">
      			<div class="form-group"><label class="control-label" for="" ><strong>Date de la consultation:</strong></label>
    			    <div class="input-group">
			     		  <input type="text" id ="date" class="date-picker form-control ltnow filter"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
					       <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
					    </div>
		        </div>
      		</div>	
      	</div>
    	</div>
    	<div class="panel-footer">
    		<button type="submit" class="btn btn-sm btn-primary findconsult"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
    	</div>
  	</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box transparent" id="widget-box-2">
		<div class="widget-header"><h5 class="widget-title bigger lighter">
      <i class="ace-icon fa fa-table"></i>Consultations</h5>&nbsp;<label><span class="badge badge-info numberResult"></span></label>
    </div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="display table-responsive" id="liste_conultations"></table>
			</div>
	  	</div>	
	 </div>
</div>
</div>
<div class="row">@include('hospitalisations.ModalFoms.EtatSortie')</div>
@endsection