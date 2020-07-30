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
	       								{ data: 'IPP', title:'IPP'},
	       			  					{ data: 'Dat_Naissance', title:'Né(e) le' },
									{ data: 'Sexe', title:'Sexe'},
								  { data: 'Date_creation', title:'Créer le'},
								  { data:null,title:'<em class="fa fa-cog"></em>', searchable: false }
	  		   			],
			   			  "columnDefs": [
			   						{"targets": 2 ,  className: "dt-head-center" },
			   						{"targets": 3 ,  className: "dt-head-center" },
			   						{"targets": 4 ,  className: "dt-head-center" },
			   						{"targets": 5 ,  className: "dt-head-center" },
			   						{"targets": 6 ,	"orderable": false, className: "dt-head-center" },
							 		 {"targets": 7 ,	"orderable": false, className: "dt-head-center" },
							 		  {"targets": 8 ,	"orderable":false,className: "dt-head-right dt-body-center",
							  			"render": function(data,type,full,meta){
									       if ( type === 'display' ) {
											return  '<a href="/consultations/create/'+data.id+'" class="btn btn-primary btn-xs"  data-toggle="tooltip" title="Ajouter une Consultation"><i class="fa fa-plus-circle fa-xs"></i></a>';
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
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h4>Selectionner le patient</h4>
</div>
<div class="row">
	@include('consultations.findPatient')
	</div>
<div class="row">
@endsection
