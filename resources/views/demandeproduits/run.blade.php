@extends('app')
@section('page-script')
<script>
$(function(){
	$("#reject").click(function(e){
		e.preventDefault();
  		 var id = '{{ $demande->id}}';
  		 Swal.fire({
		        icon: 'warning',
		        title: 'Motif de rejet :',
		        input: 'textarea',
		        showCancelButton: true,
		        confirmButtonColor: '#3085d6',
		        cancelButtonColor: '#d33',
		        confirmButtonText: 'Oui, Rejeter!',
		        cancelButtonText: 'Non'
		 }).then((result) => {
		        if (result.value) {
		               window.location.href="/demandeproduit/rejeter/"+id+"/"+result.value;
		        }
   		 })
	})
});//window.location.href='/demandeproduit/valider/'+'/'+id;	
$('document').ready(function(){
	$('#validerdmd').click(function(){
		var tb = $('#cmd tbody');
  		var produits = [];
  		tb.find("tr").each(function(index, element) {
  	  		var jsonData = {};
  		  	$(element).find('td').each(function(index1, element) {
  		  		switch(index1){
							case 0:
								jsonData ["produit"]= $(element).text();
			    			break;
				    	case 3:
			    			jsonData["gamme"] = $(element).text();
			    			break;
				    	case 6:	
				    		jsonData["qteDem"] = $(element).find('input').val() ;
			    			break;
							default:				
			    					break;	
		    		}
      		        });
 			 produits.push(jsonData);
  		});
  		var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(produits)+"' hidden>");
		champ.appendTo('#runForm');
     		$('#runForm').submit();
	});
});
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Traitement de la demande du </strong> &quot;{{ $demande->demandeur->nom }} &nbsp;{{ $demande->demandeur->prenom}}&quot;</h1>
	<div class="pull-right">
		<a href="{{route('demandeproduit.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>Demandes
		</a>
	</div>
</div><div class="space-12"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header"><h4 class="widget-title">Détails de la demande :</h4></div>
			<div class="widget-body">
				<div class="widget-main">
				<div class="row">
					<div class="col-xs-12">
						<div id="user-profile-1" class="user-profile row">
							<div class="col-xs-12 col-sm-3 center">
							<div class="profile-user-info profile-user-info-striped">
							<div class="profile-info-row"><div class="profile-info-name"> Date : </div>
							<div class="profile-info-value"><span class="editable">{{ $demande->Date }}</span></div>
							</div>
							</div>
							<div class="profile-user-info profile-user-info-striped">
							<div class="profile-info-row"><div class="profile-info-name"> Etat : </div>
								<div class="profile-info-value">
									<span class="badge badge-success">En cours</span>
								</div>
							</div>
							<div class="profile-info-row"><div class="profile-info-name"> Demandeur : </div>
							<div class="profile-info-value">
							<span class="editable">{{ $demande->demandeur->nom }} {{ $demande->demandeur->prenom }}</span>
							</div>
							</div>
							</div>
						  </div>
						</div>
					</div>				
					</div><div class="space-12"></div>
					<div class="row">
						<div class="col-xs-12">
							<table id="cmd" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th hidden><strong>Produit</strong></th>
										<th class="center"><strong>Produit</strong></th>
										<th class="center"><strong>Code Produit</strong></th>
										<th class="center"><strong>Gamme</strong></th>
										<th class="center"><strong>Spécialité</strong></th>
										<th class="center"><strong>Quantité</strong></th>
										<th class="center"><strong>Quantité Donner</strong></th>
										<th><em class="fa fa-cog"></em></th>
									</tr>
								</thead>
								<tbody>
								@foreach($demande->dispositifs as $dispositif)
									<tr>
										<td hidden>{{ $dispositif->id }} </td>
										<td>{{ $dispositif->nom }}</td>
										<td>{{ $dispositif->code }}</td>
										<td>DISPOSITIFS MEDICAUX</td>
										<td>/</td>
										<td>{{ $dispositif->pivot->qte }}</td>
										<td><input type="number" class="form-control" name="" value="{{ (isset($dispositif->pivot->qteDonne)) ? $dispositif->pivot->qteDonne: $dispositif->pivot->qte }}" min="1" max="{{ $dispositif->pivot->qte }}"> </td>
										<td class="center align-middle" rowspan = "{{ $demande->dispositifs->count() + $demande->medicaments->count() +  $demande->reactifs->count()  }}">
						{{-- <button type="button" class="btn  btn-warning btn-xs" id="reject" rel1="bjr"><i class="fa fa-ban" aria-hidden="true"></i></button> --}}
												<a  href="" class="btn  btn-warning btn-xs" id="reject" rel1="bjr"><i class="fa fa-ban" aria-hidden="true"></i></a>
										</td>
									</tr>
								@endforeach
								@foreach($demande->medicaments as $medicament)
									<tr>
										<td hidden>{{ $medicament->id }}</td>
										<td>{{ $medicament->nom }}</td>
										<td>{{ $medicament->code_produit }}</td>
										<td> MEDICAMENTS</td>
										<td>{{ $medicament->specialite->nom }}</td>
										<td>{{ $medicament->pivot->qte }}</td>
										<td><input type="number" class="form-control" name="" value="{{ (isset($medicament->pivot->qteDonne)) ? $medicament->pivot->qteDonne: $medicament->pivot->qte }}"  min="1" max="{{ $medicament->pivot->qte }}"> </td>
									</tr>
								@endforeach
								@foreach($demande->reactifs as $reactif)
									<tr>
										<td hidden>{{ $reactif->id }}</td>
										<td>{{ $reactif->nom }}</td>
										<td>{{ $reactif->code }}</td>
										<td>Réactifs chimiques et dentaires</td>
										<td>/</td>
										<td>{{ $reactif->pivot->qte }}</td>
										<td><input type="number" class="form-control" name="" value="{{ (isset($reactif->pivot->qteDonne)) ? $reactif->pivot->qteDonne: $reactif->pivot->qte }}" placeholder="" min="1" max="{{ $reactif->pivot->qte }}"> </td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div><!-- row-->
				</div><!-- widget-main -->
			</div><!-- widget-body -->
		</div><div class="space-12"></div>
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" id ="runForm" method="POST" action="{{ route('demandeproduit.valider', $demande->id) }}">
				{{ csrf_field() }}{{-- {{ method_field('PUT') }} --}}					
				<div class="form-actions center">
					<button type="submit" id="validerdmd" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save icon-on-left bigger-110"></i>&nbsp;Enregistrer</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection