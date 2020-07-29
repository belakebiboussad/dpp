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
							                        	return '<input type="checkbox" class="editor-active check" name="fusioner[]" value="'+data.id+'" onClick="return KeepCount()" /><span class="lbl"></span> ';
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
	 $.get('/getConsultations/'+patient_id, function (data) {
	 	  $("#patient").html(data[0].patient.Nom +" " + data[0].patient.Prenom);
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
			 					{ data:null,title:'#', "orderable": false,searchable: false,
						    		render: function ( data, type, row ) {
			                if ( type === 'display' ) {
			                 		return '<input type="checkbox" class="editor-active check"  value="'+data.id+'" onClick=""/><span class="lbl"></span>';
			                }
			                return data;
			              }
								},
								{ data: 'Date_Consultation', title:'Date' },
			 					{ data: 'Motif_Consultation', title:'Motif',"orderable": false},
			 					{ data: "docteur.Nom_Employe",
            			render: function ( data, type, row ) {
               			 return row.docteur.Nom_Employe + ' ' + row.docteur.Prenom_Employe;
            			},
            			title:'Médecine Traitant',"orderable": false
        				},
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
						 		{"targets": 0,  className: "dt-head-center" },
						 		{"targets": 1,  className: "dt-head-center" },
						 		{"targets": 1,  className: "dt-head-center" },
						 		{"targets": 3,  className: "dt-head-center" },
						 		{"targets": 4 , className: "dt-head-center dt-body-center" } 
			 	],
	   });
		
   });
	})
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading left" style="height: 40px;">
				<strong>Rechercher un Patient</strong>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-4 col-xs-4">
			    			  <div class="form-group">
			      				<label class="control-label" for="patientName" ><strong>Nom:</strong></label>
							<div class="input-group">
								<input type="text" class="form-control input-sx" id="patientName" name="patientName" placeholder="nom du patient..." autofocus/>
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
					    </div>
						</div>
					</div>
					<div class="col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="control-label" for="patientFirstName" ><strong>Prenom:</strong></label> 
							<div class="input-group">
						  	<input type="text" class="form-control input-sx" id="patientFirstName" name="patientFirstName"  placeholder="prenom du patient..."> 
						  	<span class="glyphicon glyphicon-search form-control-feedback"></span>
			   			</div>		
						</div>
					</div>
					<div class="col-sm-4 col-xs-4">
						<div class="form-group">
							<label class="control-label" for="IPP" ><strong>IPP:</strong></label>
							<div class="input-group">
								<input type="text" class="form-control input-sx tt-input" id="IPP" name="IPP"  placeholder="IPP du patient..." data-toggle="tooltip" data-placement="left" title="Code IPP du patient">
					   	  <span class="glyphicon glyphicon-search form-control-feedback"></span>
							</div>		
						</div>		
					</div>
				</div>
			</div>
			<div class="panel-footer" style="height: 50px;">
		   	<button type="submit" class="btn btn-xs btn-primary findptient " style="vertical-align: middle"><i class="fa fa-search"></i>&nbsp;Rechercher</button>		
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xs-6">
		<table id="liste_patients" class="display table-responsive" width="100%"></table>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-xs-6">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-flat widget-header-small">
				<h5 class="widget-title">	<i class="ace-icon fa fa-user"> Lise des Consultations du <strong><span id="patient"></strong></span></i></h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table  id="consultList" class="table  table-bordered table-hover table-striped table-condensed table-responsive"  width="100%"></table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6"  id="consultDetail">	</div>
</div>
@endsection