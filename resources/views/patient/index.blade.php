@extends('app')
@section('title','Rechercher un patient')
@section('style')
<style>
</style>
@endsection
@section('page-script')
<script>
	function getPatientdetail(id)
	{
		$.ajax({
			url : '/patientdetail/'+id,
		      type : 'GET',
		      success:function(data,status, xhr){
			      	$('#patientDetail').html(data.html);
        		},
          		error:function(data){
	         		alert("error");
	        	}	
		});
	}
	function reset_in() 
	{
		$('#patientName').val('');$('#patientFirstName').val('');$('#IPP').val('');$('#Dat_Naissance').val('');
	}
	var values = new Array();
	function doMerge()
	{
    $.ajax({
      type : 'get',
      url : '{{URL::to('patientsToMerge')}}',
      data:{'search':values},
      success:function(data,status, xhr){
      		$('#tablePatientToMerge').html(data.html);
      }
  });
	}
	function KeepCount() {
		if($("input:checked").length >= 2){
			$('.check:not(:checked)').attr('disabled','disabled');
			$('#FusionButton').removeClass('invisible');
			$.each( $("input:checked"), function( key, value ) {
				values.push($(this).val());
	  		$(this).parent().parent().css('background-color','#dd9900');
			});
		}else
		{
			$( "input:not(:checked)").removeAttr("disabled");
			$('#FusionButton').addClass('invisible');
			$.each( $("input:unchecked"), function( key, value ) {
				$(this).parent().parent().css('background-color','#ffffff');
			});
		}
	}
	function setField(field,value)
	{
		if($('#'+field).is("input"))
			$('#'+field).val(value);
		else
		{
			var select = $('#'+field);
			$("select option").filter(function() {
			     return $(this).val() == value; 
			}).prop('selected', true);
		}	
	}
	$(document).ready(function(){
		var Namebloodhound = new Bloodhound({
		      datumTokenizer: Bloodhound.tokenizers.whitespace,
		      queryTokenizer: Bloodhound.tokenizers.whitespace,
		      remote: {
						url: '/patients/find?q=%QUERY%',
						wildcard: '%QUERY%'
					},
		});
		var Firstnamebloodhound = new Bloodhound({
	    	  datumTokenizer: Bloodhound.tokenizers.whitespace,
	        queryTokenizer: Bloodhound.tokenizers.whitespace,
	        remote: {
						url: '/patients/findprenom?prenom=%QUERY%',
						wildcard: '%QUERY%'
				},
		}); 

		$('#patientName').typeahead({
					hint: true,
					highlight: true,
					minLength: 2
				}, {
					name: 'patientnom',
					source: Namebloodhound,
					display: function(data) {
						$('#btnCreate').removeClass('hidden');
	         	$('#FusionButton').removeClass('hidden');   
						return data.Nom;  
					},
					templates: {
						empty: [
							'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucun Patient</div></div>'
						],
						header: [
							'<div class="list-group search-results-dropdown">'
						],
						suggestion: function(data) {
						return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.Nom + '</div></div>'
						}
						
					}
		});
		$('#patientFirstName').typeahead({
			hint: true,
			highlight: true,
			minLength: 2
		},{
			name: 'patientprenom',
			source: Firstnamebloodhound,
			display: function(data) {
				$('#btnCreate').removeClass('hidden')
	                                $('#FusionButton').removeClass('hidden') 
				return data.Prenom  //Input value to be set when you select a suggestion. 
			},
			templates: {
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucun Patient</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					suggestion: function(data) {
						return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.Prenom + '</div></div>'
					}		
				}
		});
		$(document).on('click','.findptient',function(event){
			event.preventDefault();
			$('#btnCreate').removeClass('hidden');
			$('#FusionButton').removeClass('hidden');
			$('#patientDetail').html('');
			$(".numberResult").html('');
			nom=$('#patientName').val();
			prenom=$('#patientFirstName').val();
			code_barre=$('#IPP').val();
			date_Naiss=$('#Dat_Naissance').val();
			$.ajax({
		       type : 'get',
		       url : '{{URL::to('searchPatient')}}',
		       data:{'search':nom,'prenom':prenom,'code_barre':code_barre,'Dat_Naissance':date_Naiss},
		       success:function(data,status, xhr){// $('#liste_patients tbody').html(data);
     			 	$(".numberResult").html(Object.keys(data).length);
     				reset_in();
     				var patientList = $("#liste_patients");
     				patientList.DataTable ({
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
							                        		return '<input type="checkbox" class="editor-active check" name="fusioner[]" value="'+data.id+'" onClick="return KeepCount()" /><span class="lbl"></span> ';
							                  		}
							                   		 return data;
							                	},
							                	className: "dt-body-center",
									},
									{ data:'id',title:'ID', "visible": false},
									// { data: null,title:'Nom',
									//    "render":function(data,type,full,meta){
									// 	if(type ==='display'){
									// 		return '<a onclick ="getPatientdetail('+data.id+')" style="cursor:pointer" data-toggle="tooltip" title="Résume du patient">'+data.Nom+'</a>';
									//       }
									//       return data;	
								 //         } 
									// },
									{ data: 'Nom', title:'Nom' },
	       					{ data: 'Prenom', title:'Prenom' },
	       					{ data: 'IPP', title:'IPP'},
	       			  	{ data: 'Dat_Naissance', title:'Né(e) le' },
								  { data: 'Sexe', title:'Sexe'}, // { data: 'Type',title:'Type'},
								  { data: 'Date_creation', title:'Créer le'},
								  { data:null,title:'<em class="fa fa-cog"></em>', searchable: false }
	  		   			],
				   			"columnDefs": [
				   				{"targets": 2 ,  className: "dt-head-center" },//nom
				   				{"targets": 3 ,  className: "dt-head-center" },
				   				{"targets": 4 ,  className: "dt-head-center" },
				   				{"targets": 5 ,  className: "dt-head-center" },
				   				{"targets": 6 ,	"orderable": false, className: "dt-head-center" },
								  {"targets": 7 ,	"orderable": false, className: "dt-head-center" },
								  {"targets": 8 ,	"orderable":false,className: "dt-head-right dt-body-center",
								    "render": function(data,type,full,meta){
								      if ( type === 'display' ) {
												return  '<a href = "/patient/'+data.id+'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter le dossier"><i class="fa fa-hand-o-up fa-xs"></i></a>'+
																'&nbsp;<a href ="/patient/'+data.id+'/edit" class="btn btn-info btn-xs" data-toggle="tooltip" title="modifier"><i class="fa fa-edit fa-xs"></i></a>'+
																 '&nbsp;<a onclick ="getPatientdetail('+data.id+')" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume du patient"><i class="fa fa-eye fa-xs"></i></a>'	;
								      }
								      return data;	
								    },
								    className: "dt-body-center",
							    } 
						   	],
    			});
   			//////////fin v2
     			},
     			error:function(){
     				console.log("error");
     			},
    		});
	});
});	
</script>
@endsection
@section('main-content')
@section('main-content')
<div class="page-content">
	<div class="row">
		<div class="col-sm-12 center">	
			<h2>
				<strong>Bienvenue Docteur:</strong>
				 <q class="blue"> {{ Auth::User()->employ->Nom_Employe }} &nbsp;{{ Auth::User()->employ->Prenom_Employe }}  </q>
			</h2>
		</div>		
	</div>	{{-- row --}}
	<div class="space-12"></div>
	<div class="row panel panel-default" style ="margin-right:-35px;">
		<div class="panel-heading left" style="height: 40px; font-size: 2.3vh;">
			<strong>Rechercher un Patient</strong>
			<div class="pull-right" style ="margin-top: -0.5%;">
				<a href="{{route('assur.index')}}" class ="btn btn-white btn-info btn-bold btn-xs">Rechercher un Fonctionnaire&nbsp;<i class="ace-icon fa fa-arrow-circle-right bigger-120 black"></i></a>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-2">
		      <div class="form-group">
		       	<label class="control-label" for="patientName" ><strong>Nom:</strong></label>
						<div class="input-group">
							<input type="text" class="form-control input-sx" id="patientName" name="patientName" placeholder="nom du patient..." autofocus/>
							<span class="glyphicon glyphicon-search form-control-feedback"></span>
				    </div>
					</div>
				</div>
				<div class="col-sm-2 col-md-offset-1">
					<div class="form-group">
						<label class="control-label" for="patientFirstName" ><strong>Prenom:</strong></label> 
						<div class="input-group">
					  	<input type="text" class="form-control input-sx" id="patientFirstName" name="patientFirstName"  placeholder="prenom du patient..."> 
					  	<span class="glyphicon glyphicon-search form-control-feedback"></span>
		   			</div>		
					</div>
				</div>
				<div class="col-sm-2 col-md-offset-1">
					<div class="form-group">
						<label class="control-label" for="Dat_Naissance" ><strong>Né(e):</strong></label>
						<div class="input-group">
							<input type="text" class="form-control input-sx tt-input date-picker" id="Dat_Naissance" name="Dat_Naissance"	data-date-format="yyyy-mm-dd" placeholder="date de naissance..." data-toggle="tooltip" data-placement="left" title="Date Naissance">
							<span class="glyphicon glyphicon-search form-control-feedback"></span>
						</div>		
					</div>
				</div>
				<div class="col-sm-2 col-md-offset-1">
					<div class="form-group">
						<label class="control-label" for="IPP" ><strong>IPP:</strong></label>
						<div class="input-group">
							<input type="text" class="form-control input-sx tt-input" id="IPP" name="IPP"  placeholder="IPP du patient..." data-toggle="tooltip" data-placement="left" title="Code IPP du patient">
				   	  <span class="glyphicon glyphicon-search form-control-feedback"></span>
						</div>		
					</div>		
				</div>
			</div>
		</div>  {{-- body --}}
		<div class="panel-footer" style="height: 50px;">{{-- onclick="XHRgetPatient();" --}}
	   	<button type="submit" class="btn btn-xs btn-primary findptient " style="vertical-align: middle"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
			<div class="pull-right">
				<button type="button" class="btn btn-danger btn-sm hidden invisible" id="FusionButton"  onclick ="doMerge();"data-toggle="modal" data-target="#mergeModal" data-backdrop="false" hidden><i class="fa fa-angle-right fa-lg"></i><i class="fa fa-angle-left fa-lg"></i>&nbsp;Fusion</button>
				<a  class="btn btn-primary btn-sm hidden" href="patient/create" id=btnCreate role="button" aria-pressed="true"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>
			</div>		
		</div>
 	</div><!-- panel -->
 	<div class="row">
		<div class="col-sm-7">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat widget-header-small">
					<h5 class="widget-title">
					<i class="ace-icon fa fa-user"></i>
					Resultats: </h5> <label for=""><span class="badge badge-info numberResult"></span></label>
				</div>
				<table id="liste_patients" class="display table-responsive" width="100%"></table>
			</div>
		</div>{{-- col-sm-7 --}}
		<div class="hidden-xs hidden-sm col-md-5 col-sm-5">
		  <br>
			<div class="widget-box transparent" id="patientDetail" style ="margin-top: 14px;">
			</div>		
		</div>
	</div>{{-- row --}}
	<div class="row">
		<div  id="mergeModal" class="modal fade" role="dialog" aria-hidden="true"> 
		<div class="modal-dialog modal-ku">
			<div class="modal-content">
		      		<div class="modal-header">
		        			<button type="button" class="close" data-dismiss="modal">&times;</button>
		        			<h4 class="modal-title">Merger les données des Patients :</h4>
		      		</div>
		      		<div class="modal-body">
		        			<p class="center">
						êtes-vous sûr de vouloir de vouloire merger les deux patients ?
		        			</p>
		        			<p> <span  style="color: red;">
		        			mergé les patient est permanent et ne  peut pas  étre refait !!
		        			</span>
					</p>
					<form id="form-merge" class="form-horizontal" role="form" method="POST" action="{{ url('/patient/merge') }}">	
		      				{{ csrf_field() }}
			      			<div id="tablePatientToMerge"></div>
			        			<div class="modal-footer">
			        				<button type="button" class="btn btn-default" data-dismiss="modal">
			        					 <i class="ace-icon fa fa-undo bigger-120"></i>
			        						Fermer
			        				</button>
			        				<button  type="submit" class="btn btn-success" >
			        					  <i class="ace-icon fa fa-check bigger-120"></i>
			        					Valider
			        				</button>
			      			</div> 	
		      </form>
		        		</div>
		      	</div>  	{{-- modal-content --}}
		</div>
		</div>
	</div>{{-- row --}}
</div>
@endsection