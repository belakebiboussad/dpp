@extends('app')
@section('title','Rechercher un patient')
@section('page-script')
<script>
$(document).ready(function(){
	// Defining the local datase
	// Constructing the suggestion engine
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
}); 
function XHRgePatient()
{
	$('#btnCreate').removeClass('hidden');
               $('#FusionButton').removeClass('hidden');
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
                     }
           });
}
function getPatientdetail(id)
{
	// console.log(id);	
	$.ajax({
                     type : 'get',
                            url : '{{URL::to('patientdetail')}}',
                            data:{'search':id},
                            success:function(data1,status, xhr){
                            		// console.log(data1);
                            	          $('#patientDetail').html(data1.html);
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
{{-- <div class="space-12"></div> --}}
<div class="row">
	<div class="col-sm-12">
		<div class="center">
			<h2 class="blue">
				<strong>Bienvenue Docteurs:</strong>
				<q> {{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe }}
				{{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}} </q>
			</h2>
		</div>
		
	</div>		
</div>	{{-- row --}}
<div class="space-12"></div>
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-7 col-lg-7">
		<div class="panel panel-default">
			<div class="panel-heading" style="height: 50px; font-size: 2.6vh;">
				Rechercher un Patient
			</div>
		    	<div class="panel-body">
			<div class="row">
				<div class="col-sm-2">
					<label class="control-label pull-right" for="patientName" ><strong>&nbsp;&nbsp;&nbsp;Nom :</strong>
					</label>
				</div>
				<div class="col-sm-4">
					<input type="text" class="form-control input-sm" id="patientName" name="patientName"  placeholder="Rechercher..."/>
				 </div>
				 <div class="col-sm-2">
					<label class="control-label pull-right" for="patientFirstName" ><strong>Prenom :</strong>
					</label> 
				</div>
				<div class="col-sm-4">
					<input type="text" class="form-control input-sm" id="patientFirstName" name="patientFirstName"  placeholder="Rechercher...">
				</div>
			</div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-2"><label class="control-label pull-right" for="IPP" ><strong>Code:</strong></label>
				</div>
				<div class="col-sm-4">
				   <input type="text" class="form-control input-sm tt-input" id="IPP" name="IPP"  placeholder="Rechercher...">
				 </div>
				 <div class="col-sm-2"><label class="control-label pull-right" for="Dat_Naissance" ><strong>date Nai:</strong></label>
				</div>
				<div class="col-sm-4">
				   <input type="text" class="form-control input-sm tt-input date-picker" id="Dat_Naissance" name="Dat_Naissance"  data-date-format="yyyy-mm-dd" placeholder="Rechercher...">
				 </div>
			</div>
			<div class="space-12"></div>	
		    	</div>  {{-- body --}}
		   	<div class="panel-footer">
		   		<button type="submit" class="btn-sm btn-primary" onclick="XHRgePatient();"><i class="fa fa-search"></i>&nbsp;Rechercher
				</button>
				<div class="pull-right">
					<button type="button" class="btn btn-danger btn-sm hidden invisible" id="FusionButton"  onclick ="doMerge();"data-toggle="modal" data-target="#mergeModal" data-backdrop="false" hidden><i class="fa fa-angle-right fa-lg"></i><i class="fa fa-angle-left fa-lg"></i>&nbsp;Fusion
					</button>
					<a  class="btn btn-primary btn-sm hidden" href="patient/create" id=btnCreate role="button" aria-pressed="true"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>
				</div>
				
		   	</div>
 		 </div>
	</div>	{{-- col-sm-7	 --}}
{{-- 	<div class="col-sm-4 col-lg-4">
		<div class="infobox infobox-green">
		<div class="infobox-icon">
		<i class="ace-icon fa fa-users"></i>
		</div>
		<div class="infobox-data">
			<span class="infobox-data-number">{{ App\modeles\patient::all()->count() }}</span>
			<div class="infobox-content"><b>Patients</b></div>
		</div>
		</div>
		<div class="infobox infobox-blue">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-user-md"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\modeles\consultation::all()->count() }}</span>
				<div class="infobox-content"><b>Consultations</b></div>
			</div>
		</div>
		<div class="infobox infobox-pink">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-table"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\modeles\rdv::all()->count() }}</span>
				<div class="infobox-content"><b>Rendez-vous</b></div>
			</div>
		</div>
		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-hospital-o"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\modeles\hospitalisation::all()->count() }}</span>
				<div class="infobox-content"><b>Hospitalisations</b></div>
			</div>
		</div>
	</div>	
 --}}</div>{{-- row --}}
<div class="row">
	<div class="col-sm-7">
		<div class="widget-box transparent">
					<div class="widget-header widget-header-flat widget-header-small">
						<h5 class="widget-title">
						<i class="ace-icon fa fa-user"></i>
						Resultats: </h5> <label for=""><span class="badge badge-info numberResult"></span></label>
					</div>
					<div>
					<table id="liste_patients" class="table table-striped table-bordered">
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
								<th class="blue">Age</th>
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
		<br><br>
		<div class="col-md-5 col-sm-5"  id="patientDetail">
			
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
	