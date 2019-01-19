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
	  $('#patientName').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'patients',
				source: bloodhound,
				display: function(data) {
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
});  
function XHRgePatient()
{
	$('#Controls').removeClass('invisible');
	$value=$('#patientName').val();
		$.ajax({
                            type : 'get',
                            url : '{{URL::to('searchPatient')}}',
                            data:{'search':$value},
                            success:function(data,status, xhr){
                                $('tbody').html(data);
                                var count = xhr.getResponseHeader("count");
                                $(".numberUser").html(count);
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
	<div class="col-sm-7">
	<div class="space-12"></div>
		<div class="row">
		            <div class="form-horizontal">
			<div class="panel panel-default">
				<div class="panel-heading initialism" style="height: 50px; font-size: 3vh;">
					Rechercher un Patient
				</div>
				<div class="panel-body">
					<div class="form-group has-feedback">
						<label class="control-label" for="patientName" ><strong>Nom Patient:</strong></label>&nbsp;&nbsp; 
						 <input type="text" class="form-control input input-sm" id="patientName" name="patientName"  placeholder="Rechercher..."/>
						   &nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" class="btn-sm btn-primary" onclick="XHRgePatient();"><i class="fa fa-search"></i></button>

					</div>
				</div>	{{-- panel-body --}} 
				<div class="bs-example" style = "height:45px;">
				<div class="form-control invisible" style ="border:none;" id="Controls">
					<button type="button" class="btn btn-outline-primary btn-sm"><i class="fa fa-angle-right fa-lg"></i><i class="fa fa-angle-left fa-lg"></i>&nbsp;Fusion</button>
                 				
				            <a  class="btn btn-primary btn-sm " href="#" role="button" aria-pressed="true" hidden><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>
				</div>            
				</div> 
			</div>
				
			</div>	{{-- PANEL --}}
		</div>{{-- row --}}
	</div>	{{-- col-sm-7	 --}}
	<div class="col-sm-5"></div>	
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
								<tr class="info"><th colspan="12">Selectionner le patient dans la liste</th></tr>
								<tr>
									<th hidden>id</th>
									<th hidden>code</th>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Date Naissance</th>
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
</div>{{-- page-content --}}
@endsection
	