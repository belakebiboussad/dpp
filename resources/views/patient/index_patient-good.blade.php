@extends('app')
@section('title','Rechercher un patient')
@section('page-script')
<script>
$(document).ready(function(){
	var bloodhound = new Bloodhound({
	        datumTokenizer: Bloodhound.tokenizers.whitespace,
	        queryTokenizer: Bloodhound.tokenizers.whitespace,
	        remote: {
			url: '/patients/find?q=%QUERY%',
				wildcard: '%QUERY%'
		},
	});
	var bloodhoundPrenom = new Bloodhound({
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
				source: bloodhound,
				display: function(data) {
					$('#btnCreate').removeClass('hidden')
                                			$('#FusionButton').removeClass('hidden')   
					return data.Nom  //Input value to be set when you select a suggestion. 
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
		source: bloodhoundPrenom,
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
		nom=$('#patientName').val();
		prenom=$('#patientFirstName').val();
		code_barre=$('#IPP').val();
		date_Naiss=$('#Dat_Naissance').val();
		$.ajax({
		       type : 'get',
		       url : '{{URL::to('searchPatient')}}',
		       data:{'search':nom,'prenom':prenom,'code_barre':code_barre,'Dat_Naissance':date_Naiss},
		       success:function(data,status, xhr){
		             $('#liste_patients tbody').html(data);
		             $(".numberResult").html(xhr.getResponseHeader("count"));
		             $('#patientName').val('');$('#patientFirstName').val('');$('#IPP').val('');$('#Dat_Naissance').val('');
     			},
     			error:function(){
     				console.log("error");
     			},
    		});
	});
});
function fetch_data(page){
}

function XHRgetPatient()
{
	$('#btnCreate').removeClass('hidden');
	$('#FusionButton').removeClass('hidden');
	$('#patientDetail').html('');
	nom=$('#patientName').val();
	prenom=$('#patientFirstName').val();
	code_barre=$('#IPP').val();
	date_Naiss=$('#Dat_Naissance').val();
	$.ajax({
		       type : 'get',
		       url : '{{URL::to('searchPatient')}}',
		       data:{'search':nom,'prenom':prenom,'code_barre':code_barre,'Dat_Naissance':date_Naiss},
		       success:function(data,status, xhr){
              $('#liste_patients tbody').html(data);
              $(".numberResult").html(xhr.getResponseHeader("count"));
	             $('#patientName').val('');$('#patientFirstName').val('');$('#IPP').val('');$('#Dat_Naissance').val('');
     		}
    	});
}
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
var values = new Array();
function doMerge()
{
	$.ajax({
            type : 'get',
            url : '{{URL::to('getPatientsToMerge')}}',
            data:{'search':values},
            success:function(data,status, xhr){
                $('#tablePatientToMerge').html(data.html);
            }
          });
}
function KeepCount() {
	var n = $("input:checked").length;
	if(n >= 2){
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
</script>
@endsection
@section('main-content')
<div class="page-content">
<div class="row">
	<div class="col-sm-12 center">	
		<h2>
			<strong>Bienvenue Docteur:</strong>
			 <q class="blue"> {{ Auth::User()->employ->Nom_Employe }} {{ Auth::User()->employ->Prenom_Employe }}  </q>
		</h2>
	</div>		
</div>	{{-- row --}}
<div class="space-12"></div>
{{-- <div class="row"> --}}
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
							<input type="text" class="form-control input-sx" id="patientName" name="patientName"  placeholder="nom du patient..."/>
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
		  	<div class="panel-footer" style="height: 50px;">
		  	{{-- onclick="XHRgetPatient();" --}}
		   	<button type="submit" class="btn btn-xs btn-primary findptient " style="vertical-align: middle"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
			<div class="pull-right">
			<button type="button" class="btn btn-danger btn-sm hidden invisible" id="FusionButton"  onclick ="doMerge();"data-toggle="modal" data-target="#mergeModal" data-backdrop="false" hidden><i class="fa fa-angle-right fa-lg"></i><i class="fa fa-angle-left fa-lg"></i>&nbsp;Fusion</button>
			<a  class="btn btn-primary btn-sm hidden" href="patient/create" id=btnCreate role="button" aria-pressed="true"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>
			</div>		
		  </div>
 		 </div>
{{-- </div> --}}{{-- row --}}
<div class="row">
	<div class="col-sm-7">
		<div class="widget-box transparent">
					<div class="widget-header widget-header-flat widget-header-small">
						<h5 class="widget-title">
						<i class="ace-icon fa fa-user"></i>
						Resultats: </h5> <label for=""><span class="badge badge-info numberResult"></span></label>
					</div>
					<div class="bodycontainer scrollable" >
						{{-- table-condensed --}}
						<table id="liste_patients" class="table table-striped table-bordered table-scrollable table-responsive">
							<thead>
								<tr class="info"><th colspan="12">Selectionner dans la liste</th>
								</tr>
								<tr class="liste">
									<th hidden>id</th>
									<th  class="center" width="3%" >#</th>
									<th class="blue">Nom</th>
									<th class="blue">Prénom</th>
									<th class="blue">IPP</th>
									<th class="blue">Né(e) le</th>
									<th class="blue">Sexe</th>
									<th class="blue">Âge</th>
									<th class="blue">Type</th>
									<th class="blue"><em class="fa fa-cog"></em></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
		</div>
	</div>{{-- col-sm-7 --}}
	<div class="col-md-5 col-sm-5">
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
</div>{{-- page-content --}}
@endsection
	