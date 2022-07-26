@extends('app')
@section('title','Rechercher un Fonctionnaire')
@section('page-script')
<script>
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
							if($('#widget').hasClass('hidden'))
								$("#widget").removeClass('hidden');
							 $('#liste_ayants').html(data[1]);	
						}else
						{	
							$("#assure").empty();$("#liste_ayants").empty();
							if(!$('#widget').hasClass('hidden'))
								$("#widget").addClass('hidden');
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
	<div class="page-header">	
		<div ><h4>Bienvenu(e) Monsieur :&nbsp;<q class="blue">{{ Auth::User()->employ->full_name }}</q></h4></div>		
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default ">
				<div class="panel-heading left">
					<H5><strong>Rechercher un fonctionnaire</strong></H5>
					@if(in_array(Auth::user()->role->id,[1,2,13,14]))
					<div class="pull-right">
						<a href="{{route('patient.index')}}" class ="btn btn-white btn-info btn-bold btn-xs">Rechercher un patient&nbsp;<i class="ace-icon fa fa-arrow-circle-right bigger-120 black"></i></a>
					</div>
					  @endif
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="form-group col-sm-4"><label>Matricule:</label>
							<div class="input-group col-sm-12">
								<input type="text" class="form-control input-sx" id="matricule" name="matricule" placeholder="Matricule de l'assuré(e)..." autofocus/>
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
					    </div>
						</div>
			      <div class="form-group col-sm-4 col-offset-sm-1"><label>NSS:</label>
							<div class="input-group col-sm-12">
								<input type="text" class="form-control input-sx nssform" id="nss" name="nss" placeholder="Numéro du sécurité..."/>
								<span class="glyphicon glyphicon-search form-control-feedback"></span>
					  	</div>
					  </div>
				
					</div><!-- row -->
				</div><!-- body -->
				<div class="panel-footer">
					<button type="submit" class="btn btn-xs btn-primary findAssure"><i class="fa fa-search"></i>&nbsp;Rechercher</button> 	
					{{--<a href="{{ route('assur.destroy',12122) }}" data-method="DELETE">suprimer</a>--}}
				</div>
			</div><!-- panel -->
		</div>
	</div><!-- row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat widget-header-small">
					<h5 class="widget-title"><img src="img/policeman.png" class="img1 img-thumbnail"><strong> Résultats:</strong></h5>
					<label for=""><span class="badge badge-info numberResult"></span></label>
				</div>
				<div class="bodycontainer scrollable">
					<table class="table display table-responsive table-bordered table-scrollable"  width="100%">
					<thead>
						<tr class="info"><th colspan="12">Détails fonctionnaire</th></tr>
						<tr class="liste">
						  <th class="blue" width="9%">Nom</th>
							<th class="blue" width="9%">Prénom</th>
							<th class="blue" width="7%">Né(e) le</th>
							<th class="blue" width="6%">Genre</th>
							<th class="blue" width="7%">Civilité</th>
							<th class="blue" width="5%">Wilaya Résidence</th>
						  <th class="blue" width="10%">NSS</th>
							<th class="blue" width="8%">Position</th>
							<th class="blue"  width="5%">Matricule</th>
							<th class="blue" width="11%">Service</th>
							<th class="blue" width="7%">Grade</th>
							<th class="blue"><em class="fa fa-cog"></em></th>
						</tr>
						</thead>
						<tbody id="assure"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div><div  class="space-12 "></div>{{-- roww --}}
	<div class="row">
		<div class="col-sm-6">
			<div class="widget-box transparent hidden" id ="widget">
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
		</div><div class="col-sm-6"></div>
	</div>{{-- row --}}
</div>
@endsection