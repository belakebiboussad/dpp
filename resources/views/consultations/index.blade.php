@extends('app')
@section('page-script')
<script>
$(document).on('click','.findptient',function(event){
	event.preventDefault();
	nom=$('#patientName').val();
	prenom=$('#patientFirstName').val();
	code_barre=$('#IPP').val();
	$.ajax({
		      type : 'get',
		      url : '{{URL::to('searchPatient')}}',
		      data:{'search':nom,'prenom':prenom,'code_barre':code_barre},
		      success:function(data,status, xhr){
     			 	reset_in();
     				var patientList = $("#liste_patients");
     				patientList.DataTable ({
     					"processing": true,
	  					"paging":   true,
	  					"destroy": true,
	  				 	"bLengthChange": false,
	  					"pageLength": 4,
	  					"ordering": true,
	    				"searching":false,
	    				"info" : false,
	    				"language":{"url": '/localisation/fr_FR.json'},
	   	 		    "data" : data,
		        	"columns": [
								{ data:null,title:'#', "orderable": false,searchable: false,
					    			render: function ( data, type, row ) {
						      		if ( type === 'display' ) {
                       	return '<input type="checkbox" class="editor-active check" name="" value="'+data.id+'" onClick="" /><span class="lbl"></span> ';
              	 			}
                   	  return data;
			              },
			              className: "dt-body-center",
									},
									{ data:'id',title:'ID', "visible": false},
									{ data: 'Nom', title:'Nom' },
	       					{ data: 'Prenom', title:'Prenom' },
	       					{ data: 'IPP', title:'IPP', "orderable": false},
	       			  	{ data: 'Dat_Naissance', title:'Né(e) le' },
									{ data: 'Sexe', title:'Genre'},
								  { data: 'Date_creation', title:'Créer le'},
								  { data:null,title:'<em class="fa fa-cog"></em>', searchable: false }
	  		   			],
			   			  "columnDefs": [
			   						{"targets": 2 ,  className: "dt-head-center" },
			   						{"targets": 3 ,  className: "dt-head-center" },
			   						{"targets": 4 ,  className: "dt-head-center" },
			   						{"targets": 5 ,  className: "dt-head-center" },
			   						{"targets": 6 ,	"orderable": false, className: "dt-head-center dt-body-center" },
							 		  {"targets": 7 ,	"orderable": false, className: "dt-head-center" },
							 		  {"targets": 8 ,	"orderable":false,className: "dt-head-right dt-body-center",
							  			"render": function(data,type,full,meta){
									       if ( type === 'display' ) {
											return  '<button value = "'+data.id+'" class="btn btn-success btn-xs " id="getConsults" data-toggle="tooltip" title="Selectionner le patient"><i class="fa fa-hand-o-up fa-xs"></i></button>';
							      }
							      return data;	
							    },
							    className: "dt-body-center",
						    } 
					   	],
    				});
     			},
     			error:function(){
     				console.log("error");
     			},
    		});	
})
$(document).on('click','#getConsults',function(event){
	event.preventDefault();
	var patient_id = $(this).val();
	 $.get('/getConsultations/'+patient_id, function (data, status, xhr) {
	 		$("#patient").html(xhr.getResponseHeader("patient"));
	 		$('#consultList tbody').empty();
	 		if(data.length != 0)
	 	  {
	 	  	$("#consultList").DataTable ({
					"processing": true,
				  "paging":   true,
				  "destroy": true,
					"ordering": true,
					"searching":false,
					"info" : false,
					"language":{"url": '/localisation/fr_FR.json'},
				 	"data" : data,
				  "columns": [
				 					{ data:null,
				 						render: function ( data, type, row ) {
				              if ( type === 'display' ) {
				             		return '<input type="checkbox" class="editor-active check"  value="'+data.id+'" onClick=""/><span class="lbl"></span>';
				              }
				              return data;
				            },
				            title:'#', "orderable":false,searchable: false
									},
									{ data: 'Date_Consultation', title:'Date' },
				 					{ data: 'Motif_Consultation', title:'Motif',"orderable": false},
				 					{ data: "docteur.Nom_Employe",
	            			render: function ( data, type, row ) {
	               			 return row.docteur.Nom_Employe + ' ' + row.docteur.Prenom_Employe;
	            			},
	            			title:'Médecine Traitant',"orderable": false
	        				},
	        				{ data: 'docteur.service.nom', title:'Service',"orderable": false},
	        				{ data:null,
	        					"render": function(data,type,full,meta){
										  if ( type === 'display' ) {
												return  '<a onclick ="showConsult('+data.id+');" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume du patient"><i class="fa fa-eye fa-xs"></i></a>'	;
								      }
								      return data;	
								    },
								    title:'<em class="fa fa-cog"></em>', "orderable":false,searchable: false }
				 	],
				 	"columnDefs": [
							 		{"targets": 0,  className: "dt-head-center"},
							 		{"targets": 1,  className: "dt-head-center"},
							 		{"targets": 1,  className: "dt-head-center" },
							 		{"targets": 3,  className: "dt-head-center" },
							 		{"targets": 4,  className: "dt-head-center" },
							 		{"targets": 5 , className: "dt-head-center dt-body-center" } 
				 	],
		   });
			}
   	});
	})
</script>
@endsection
@section('main-content')
<div class="row">
	@include('consultations.findPatient')
	</div>
<div class="row">
	<div class="col-sm-12">	
		<div class="col-sm-6 col-xs-6">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat widget-header-small">
					<h5 class="widget-title">	<i class="ace-icon fa fa-user"></i> Lise des Consultations du <cite><strong><span id="patient"></strong></span></cite></h5>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table id="consultList" class="table table-bordered table-hover table-striped table-condensed table-responsive"  width="100%"></table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6"  id="consultDetail"></div>
	</div>
	</div><!-- / -->
</div>
@endsection