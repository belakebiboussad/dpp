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
											return  '<button value = "'+data.id+'" class="btn btn-success btn-xs " id="getConsults" data-toggle="tooltip" title="Selectionner le patieent"><i class="fa fa-hand-o-up fa-xs"></i></button>';
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
	var Patient_id = $(this).val();

	alert(Patient_id);
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
	<div class="ccol-sm-6 col-xs-6">
		<table  id="example" class="table  table-bordered table-hover table-striped table-condensed table-responsive">
				<thead>
					<tr>
						<th class="text-center" width="45%"><strong>Motif Consultation</strong></th>
						<th class="text-center" width="15%">Date Consultation</th>
						<th class="text-center" width="15%"><strong>Patient</strong></th>
						<th class="text-center" width="15%">Médecine Traitant</th>
						<th width="10%"></th>
					</tr>
				</thead>
			</table>
	</div>
	<div class="ccol-sm-6">	</div>
</div>
@endsection