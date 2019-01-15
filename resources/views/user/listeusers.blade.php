@extends('app')
@section('title','Gestion des Utilisateures')
@section('page-script')
{{-- <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script> --}}
<script>
$(document).ready(function() {
	var bloodhound = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				remote: {
					url: '/user/find?q=%QUERY%',
					wildcard: '%QUERY%'
				},
	});
	$('#userName').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'users',
				source: bloodhound,
				display: function(data) {
					console.log(data.name);
					return data.name  //Input value to be set when you select a suggestion. 
				},
				templates: {
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucun Utilisateur</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					suggestion: function(data) {
					return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.name + '</div></div>'
					}
				}
			});
})
	function XHRgetUser()
	{
		$value=$('#userName').val();
		      $.ajax({
                            type : 'get',
                            url : '{{URL::to('searchUser')}}',
                            data:{'search':$value},
                            success:function(data,status, xhr){
                                $('tbody').html(data);
                                var count = xhr.getResponseHeader("count");
                                $(".numberUser").html(count);
                            }
                       });
	}
	function go()
	{
			
	}
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1>Liste Des Utilisateurs :</h1>
	<div class="row">
		<div class="col-sm-6">
			<div class="space-12"></div>
			<div class="row">
				<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Rechercher un Utilisateur:</h3>
				</div>
				<div class="panel-body">
					<div class="form-group   has-feedback">
						<label class="control-label" for="userName" ><strong>Nom Utilisateur:</strong></label>
						 &nbsp;&nbsp;   <input type="text" class="form-control" id="userName" name="nomUser"  placeholder="Rechercher..."/>
						    {{-- <span class="glyphicon glyphicon-search form-control-feedback"></span> --}}
						     <button type="submit" class="btn-sm btn-success" onclick="XHRgetUser();"><i class="fa fa-search"></i></button>
					</div>
				</div>
				</div>
			</div>
		</div>{{-- col-sm-5 --}}
		<div class="col-sm-7">
			
		</div>{{-- col-sm-7 --}}
	</div>
	<div class="row">
		<div class="col-sm-6">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-flat widget-header-small">
				<h5 class="widget-title"><i class="ace-icon fa fa-user"></i>Resultats: </h5> 
				<label for=""><span class="badge badge-info numberUser"></span></label>
			</div>
			<div class="widget-body">
				<div>
				<table id="user" class="table table-striped table-bordered" role="grid">
				<thead>
					<tr>
						<th class="center">#</th>
						<th hidden>id</th>
						<th><strong style="font-size:16px;">Nom Utilisateur</strong></th>
						<th><strong style="font-size:16px;">E-mail</strong>
						</th>
						<th><strong style="font-size:16px;">Rôle</strong>
						</th>
						<th>Acive</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>	
				</tbody>
				</table>
				</div>	{{-- div --}}
			</div>
		</div>
		</div>{{-- col-sm-6 --}}
		<div class="col-sm-6">
		
		</div>
	</div>
</div>
@endsection