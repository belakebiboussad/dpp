@extends('app')
@section('title','Rechercher un ptient')
@section('page-script')
<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
<script>
$(document).ready(function(){
	// Defining the local datase
	// Constructing the suggestion engine
	var bloodhound = new Bloodhound({
	        datumTokenizer: Bloodhound.tokenizers.whitespace,
	        queryTokenizer: Bloodhound.tokenizers.whitespace,
	        remote: {
			url: '/user/find1?q=%QUERY%',
				wildcard: '%QUERY%'
		},
	});
	var bloodhoundPrenom = new Bloodhound({
	        datumTokenizer: Bloodhound.tokenizers.whitespace,
	        queryTokenizer: Bloodhound.tokenizers.whitespace,
	        remote: {
			url: '/user/find2?prenom=%QUERY%',
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
		minLength: 1
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
	nom=$('#patientName').val();
	prenom=$('#patientFirstName').val();
	code_barre=$('#IPP').val();
	$.ajax({
                     type : 'get',
        
                    url : '{{URL::to('searchPatient')}}',
                      data:{'search':nom,'prenom':prenom,'code_barre':code_barre},
                      success:function(data,status, xhr){
                        	$('tbody').html(data);
                          	$(".numberResult").html(xhr.getResponseHeader("count"));
                     }
           });
}
function getPatientdetail($id)
{
	// console.log($id);	
	$.ajax({
                     type : 'get',
                            url : '{{URL::to('patientdetail')}}',
                            data:{'search':$id},
                            success:function(data1,status, xhr){
                            	        //console.log(data1);
                        	        $('#patientDetail').html(data1.html);
                           }
           });
}

function doMerge()
{
	alert("sdf");
}
var NewCount = 0;
function KeepCount() {
	NewCount+=1;
	 var n = $( "input:checked" ).length;
	console.log(n);
	if(NewCount  >= 2){
		// $('.check:not(:checked)').attr('disabled','disabled');
		$('.check:not(:checked)').prop("disabled", true);
		$('.check:not(:checked)').attr('disabled');
	}else
	{
		// alert(n);
		//$(':checkbox:disabled').closest("td").prop("disabled",false);
		// $( "input:not(:checked)").prop("disabled",false);
		$( "input:not(:checked)").removeAttr("disabled");
	}
}
 $(function () {
            $('td .chkTrt input[type=checkbox]').change(function () {
                checkedValue = $(this).is(':checked');
                alert(checkedValue);
                // $('div .chkTrt input[type=checkbox]').each(function () {
                //     $(this).attr('checked', false);
                // });
                // $(this).prop('checked', checkedValue);
            });
        });
</script>
@endsection
@section('main-content')
<div class="page-content">
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-12">
		<div class="center">
			<h2 class="blue">
				<strong>Bienvenue Docteur:</strong>
				<q> {{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe }}
				{{ App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}} </q>
			</h2>
		</div>
	</div>		
</div>	{{-- row --}}
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-7 col-lg-7">
		<div class="panel panel-default">
		<div class="panel-heading" style="height: 50px; font-size: 2.6vh;">
			Rechercher un Patient
		</div>
		<div class="panel-body">
		<div class="row">
			<div class="col-sm-2"><label class="control-label" for="patientName" ><strong>&nbsp;&nbsp;&nbsp;Nom :</strong></label></div>
			<div class="col-sm-4"><input type="text" class="form-control input-sm" id="patientName" name="patientName"  placeholder="Rechercher..."/> </div>
			<div class="col-sm-2"><label class="control-label" for="patientFirstName" ><strong>Prenom :</strong></label> </div>
			<div class="col-sm-4"><input type="text" class="form-control input-sm" id="patientFirstName" name="patientFirstName"  placeholder="Rechercher..."></div>
		</div>
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-2"><label class="control-label" for="IPP" ><strong>&nbsp;&nbsp;&nbsp;Id:</strong></label></div>
			<div class="col-sm-4">   <input type="text" class="form-control input-sm" id="IPP" name="IPP"  placeholder="Rechercher..."></div>
		</div>{{-- &nbsp;&nbsp; --}} 
		<div class="space-12"></div>
		</div>	{{-- panel-body --}} 
		<div class="bs-example" style = "height:45px;">
		<div class="form-control" style ="border:none;">
			<button type="submit" class="btn-sm btn-primary" onclick="XHRgePatient();"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
			<button type="button" class="btn btn-outline-primary btn-sm" id="FusionButton" data-toggle="modal" data-target="#mergeModal" style ="margin-left:20%" data-backdrop="false"><i class="fa fa-angle-right fa-lg"></i><i class="fa fa-angle-left fa-lg"></i>&nbsp;Fusion</button>
                 		<a  class="btn btn-primary btn-sm hidden" href="patient/create" id=btnCreate role="button" aria-pressed="true"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>
		</div>            
		</div> 
		</div>	{{-- PANEL --}}
	</div>	{{-- col-sm-7	 --}}
	<div class="col-sm-5 col-lg-7"></div>	
</div>{{-- row --}}
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
							<tr class="info"><th colspan="12">Selectionner le patient dans la liste</th>
							</tr>
							<tr>
								<th hidden>id</th>
								<th hidden>code</th>
								<th  class="center" width="3%" ></th>
								<th>Nom</th>
								<th>Prénom</th>
								<th>Né(e) le</th>
								<th>Sexe</th>
								<th>Age</th>
								<th>Type</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
		</div>{{-- col-sm-7 --}}
		<div class="col-sm-5" id="patientDetail">
			
		</div>
</div>{{-- row --}}
<div class="row">
	<div  id="mergeModal" class="modal fade" role="dialog" aria-hidden="true"> 
	<div class="modal-dialog modal-ku">
		<div class="modal-content">
	      		<div class="modal-header">
	        			<button type="button" class="close" data-dismiss="modal">&times;</button>
	        			<h4 class="modal-title">Mergerg les patients :</h4>
	      		</div>
	      		<div class="modal-body">
	        			<p>
					les données du paient selectionner vont étre merger dans  l'enregistrement de patient souligné
	        			</p>
	        			<p> <span  style="color: red;">
	        			mergé les patient est permanent et ne  peut pas  étre refait !!	
	        			</span></p>
	        		</div>
	      		<form id="mergeform" class="form-horizontal" role="form" method="POST" action="">	
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
	</div>
	</div>
</div>{{-- row --}}
</div>{{-- page-content --}}
@endsection
	