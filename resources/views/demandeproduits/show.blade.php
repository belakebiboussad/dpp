@extends('app')
@section('title','Détails demande')
@section('main-content')
<div class="page-header">
	<h1>Détails de la demande du &quot;{{ $demande->date->format('Y-m-d')}}&quot;</h1>
	<div class="pull-right">
	<a href="{{route('demandeproduit.index')}}" class="btn btn-info"><i class="ace-icon fa fa-arrow-circle-left blue"></i> Demandes</a>
    @if($demande->demandeur->service == Auth::user()->employ->service)
	<a href="{{route('demandeproduit.destroy',$demande->id)}}" class="btn btn-danger{!!$isInprog($demande)!!}" title="Supprimer Demande" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
			<i class="ace-icon fa fa-trash-o"></i> Supprimer</a>
	  @endif
	</div>
</div><div class="space-12"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header"><h5 class="widget-title">Détails de la demande</h5></div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
						<div class="col-xs-12">@include("demandeproduits.partials._show")<div class="space-12"></div>
						<div>
							<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th class="center">Code produit</th><th class="center" >Produit</th>
											<th class="center">Spécialité</th><th class="center">Gamme </th>
											<th class="center">Quantité</th>
											@if($demande->etat == "1")
											<th class="center">Quantité donnée</th>
											@endif
											<th class="center">Unite</th>
										</tr>
									</thead>
									<tbody>
										@foreach($demande->dispositifs as $dispositif)
											<tr>
												<td>{{ $dispositif->code}}</td><td>{{ $dispositif->nom}}</td><td>/</td>
												<td>DISPOSITIFS MEDICAUX</td>
												<td  class="center">{{ $dispositif->pivot->qte }}</td>
												@if($demande->etat == "1")
												<td  class="center">{{ $dispositif->pivot->qteDonne }}</td>
												@endif
												<td class="center">{{ $dispositif->pivot->unite }}</td>
											</tr>
										@endforeach
										@foreach($demande->medicaments as $medicament)
											<tr>
												<td>{{ $medicament->code_produit }}</td><td>{{ $medicament->nom }}</td>
												<td>{{ $medicament->specialite->nom }}</td><td><span>MEDICAMENTS</span></td>
												<td  class="center">{{ $medicament->pivot->qte }}</td>
												@if($demande->etat == "1")
												<td  class="center">{{ $medicament->pivot->qteDonne }}</td>
												@endif
												<td class="center">{{ $medicament->pivot->unite }}</td>
											</tr>
										@endforeach
										@foreach($demande->reactifs as $reactif)
											<tr>
												<td>{{ $reactif->code }}</td><td>{{ $reactif->nom }}</td><td>/</td>
												<td><span>Réactifs chimiques et dentaires</span></td>
												<td class="center">{{ $reactif->pivot->qte }}</td>
												@if($demande->etat == "1")
													<td  class="center">{{ $reactif->pivot->qteDonne }}</td>
												@endif
												<td class="center">{{ $reactif->pivot->unite }}</td>
											</tr>
										@endforeach
										@foreach($demande->consomables as $consomable)
											<tr>
												<td>{{ $consomable->code }}</td><td>{{ $consomable->nom }}</td><td>/</td>
												<td>Produits consommables de Labo</td>
												<td class="center">{{ $consomable->pivot->qte }}</td>
												@if($demande->etat == "1")
													<td  class="center">{{ $reactif->pivot->qteDonne }}</td>
												@endif
												<td class="center">{{ $consomable->pivot->unite }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>
@stop