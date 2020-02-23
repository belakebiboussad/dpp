@extends('app')
@section('title','Rechercher un Fonctionnaire')
@section('page-script')
<script>
	function XHRgetAssure()
	{
		var matricule = $('#matricule').val();
		var nss = $('#nss').val();
		$.ajax({
        		type : 'get',
        		url : '{{URL::to('searchAssure')}}',
        		data:{'matricule':matricule,'nss':nss},
     				   success:function(data,status, xhr){
            	 $('#liste_assures').html(data);
            	 $(".numberResult").html(xhr.getResponseHeader("count"));
            	 $('#matricule').val('');$('#nss').val('');	
        		}
    		});
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
				   	<input type="text" class="form-control input-sm tt-input" id="nss" name="nss"  placeholder="Numéro du sécurité du patient..."
				   	 data-toggle="tooltip" data-placement="left" title="Code IPP du patient">
					</div>
				</div><!-- row -->
			</div><!-- body -->
			<div class="panel-footer" style="height:40px;">
					<button type="submit" class="btn btn-xs btn-primary" style ="margin-top:-0.5%;" onclick="XHRgetAssure();"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
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
						<tr class="info"><th colspan="12">Selectionner dans la liste</th>
						</tr>
						<tr class="liste">
							<th hidden>id</th>
							<th  class="center" width="3%" >#</th>
							<th class="blue">Matricule</th>
							<th class="blue">Num Séc Soc</th>
							<th class="blue">Nom</th>
							<th class="blue">Prénom</th>
							<th class="blue">Né(e) le</th>
							<th class="blue">Sexe</th>
							<th class="blue">Position Actuel</th>
							<th class="blue">Service</th>
						
							<th class="blue"><em class="fa fa-cog"></em></th>
						</tr>
						</thead>
						<tbody id="liste_assures">
							
						</tbody>
					</table>
				</div>
	</div>
</div>
@endsection