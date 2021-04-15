@extends('app')
@section('page-script')
<script>
var field ="Dat_Naissance";
$(document).on('click','.findptient',function(event){
	event.preventDefault();
	$.ajax({
		      type : 'get',
		      url : '{{URL::to('searchPatient')}}',
		      data:{'field':field,'value':($('#'+field).val())},
		      success:function(data,status, xhr){
		      	$('#'+field).val('');field= "Dat_Naissance"; 
     			 	$("#liste_patients").DataTable ({
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
														return  '<a class="btn btn-success btn-xs" href="/consultations/create/'+data.id+'"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-110"></i>&nbsp;Consultation</a>';
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
				 					{ data: 'motif', title:'Motif',"orderable": false},
				 					{ data: "docteur.nom",
	            			render: function ( data, type, row ) {
	               			 return row.docteur.nom + ' ' + row.docteur.prenom;
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
<div class="page-header"><h4>Selectionner le patient</h4></div>
	<div class="row">
	<div class="col-sm-12">	
		<div class="col-sm-6 col-xs-12">@include('consultations.findPatient')</div>
		<div class="col-sm-6 col-xs-12">
			<table id="liste_patients" class="display table-responsive" width="100%"></table>
		</div>
	</div>
</div>
<div class="row">
@endsection
