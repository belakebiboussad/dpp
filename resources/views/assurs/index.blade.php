@extends('app')
@section('title','Rechercher un Fonctionnaire')
@section('page-script')
<script>
	function selectPatient(nom,prenom)
	{
		alert(nom);
	}
	$(document).ready(function(){
		$(document).on('click','.findAssure',function(event){
			event.preventDefault();
			$('#btnCreate').removeClass('hidden');
			var matricule = $('#matricule').val();
		       var nss = $('#nss').val();
		     	$.ajax({
					type : 'get',
					url : '{{URL::to('searchAssure')}}',
					data:{'matricule':matricule,'nss':nss},
					success:function(data,status, xhr){
						if(data != "")
						{
							$('#assure').html(data[0]);
							 if($('#widget').hasClass('invisible'))
								$("#widget").removeClass('invisible');
							 $('#liste_ayants').html(data[1]);	
						}else
						{	
							$("#assure").empty();$("#liste_ayants").empty();
							if(!$('#widget').hasClass('invisible'))
								$("#widget").addClass('invisible');
						}
						$(".numberResult").html(xhr.getResponseHeader("count"));
						 $('#matricule').val('');$('#nss').val('');		
					}
			});
		});
	});
</script>
@endsection
@section('main-content')
<div class="page-content">
	<div class="row">
		<div class="col-sm-12 center">	
			<h2><strong>Bienvenue Docteur:</strong><q class="blue">{{ Auth::User()->employ->nom }} {{ Auth::User()->employ->prenom }}</q></h2>
		</div>		
	</div>
	<div class="space-12"></div>
	<div class="row">
		<div class="panel panel-default ">
			<div class="panel-heading left" style="height: 40px; font-size: 2.3vh;">
				<strong>Rechercher un Fonctionnire</strong>
				<div class="pull-right" style ="margin-top:-0.5%;">
					<a href="{{route('patient.index')}}" class ="btn btn-white btn-info btn-bold btn-xs">Rechercher un Patient&nbsp;<i class="ace-icon fa fa-arrow-circle-right bigger-120 black"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-2">
						<label class="control-label pull-right" for="Matricule" >
							<strong>&nbsp;Mat:</strong>
						</label>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control input-sm tt-input" id="matricule" name="matricule"  placeholder="Matricule de l'assuré(e)...">
					</div>
					<div class="col-sm-2"><label class="control-label pull-right" for="Dat_Naissance" >
						<strong>NSS:</strong></label>
					</div>
					<div class="col-sm-3">
					<input type="text" class="form-control input-sm tt-input" id="nss" name="nss"  placeholder="Numéro du sécurité..."
					 data-toggle="tooltip" data-placement="left" title="Code IPP du patient">
					</div>
				</div><!-- row -->
			</div><!-- body -->
			<div class="panel-footer" style="height:40px;">
				<button type="submit" class="btn btn-xs btn-primary findAssure" style ="margin-top:-0.5%;" ><i class="fa fa-search"></i>&nbsp;Rechercher</button>
				<!-- <a href="{{ route('assur.destroy',12) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Supprimer</a> -->
				
				@if(Auth::user()->role_id == 4)
				<div class="pull-right">
					<a  class="btn btn-primary btn-xs hidden" href="{{ route('assur.create') }}" id=btnCreate role="button" aria-pressed="true"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>
				</div>
				@endif
			</div>
		</div><!-- panel -->
	</div><!-- row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat widget-header-small">
					<h5 class="widget-title"><img src="img/policeman.png" class="img1 img-thumbnail">Resultats: </h5>
					<label for=""><span class="badge badge-info numberResult"></span></label>
				</div>
				<div class="bodycontainer scrollable">
					<table class="table table-striped table-bordered table-condensed table-scrollable">
					<thead>
						<tr class="info"><th colspan="12">Fonctionnaire</th></tr>
						<tr class="liste">
						    	<th class="blue" width="9%">Nom</th>
							<th class="blue" width="9%">Prénom</th>
							<th class="blue" width="7%">Civilité</th>
						       <th class="blue"  width="5%">Matricule</th>
							<th class="blue" width="10%">Num Séc Soc</th>
							<th class="blue" width="7%">Né(e) le</th>
							<th class="blue" width="6%">Genre</th>
							<th class="blue" width="10%">Position Actuel</th>
							<th class="blue" width="9%">Service</th>
							<th class="blue" width="7%">Grade</th>
							<th class="blue"><em class="fa fa-cog"></em></th>
						</tr>
						</thead>
						<tbody id="assure"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	{{-- roww --}}
	<div  class="space-12 "></div>
	<div class="row">
		<div class="col-sm-6">
			<div class="widget-box transparent invisible"  id ="widget">
				<div class="widget-header widget-header-flat widget-header-small"></div>
				<div class="bodycontainer scrollable">
					<table class="table table-striped table-bordered table-condensed table-scrollable">
						<thead>
							<tr class="info"><th colspan="12"><i class="ace-icon fa fa-table"></i>Ayants droits</th></tr>
							<tr class="liste">
						    		 <th class="blue" width="25%">Prénom</th>
								<th class="blue" width="20%">Relation</th>
								<th class="blue"><em class="fa fa-cog"></em></th>	
							</tr>
						</thead>
						<tbody id="liste_ayants"></tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-sm-6"></div>
	</div>{{-- row --}}
</div>
@endsection