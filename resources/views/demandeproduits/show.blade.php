@extends('app')
@section('title','Détails demande')
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Détails de la demande du </strong> &quot;{{ $demande->Date}}&quot;</h1>
	<div class="pull-right">
		<a href="{{route('demandeproduit.index')}}" class="btn btn-info btn-bold"><i class="ace-icon fa fa-arrow-circle-left blue"></i>Demandes</a>
		@if(!isset($demande->etat) &&( $demande->demandeur->service == Auth::user()->employ->service))
		<a href="{{route('demandeproduit.destroy',$demande->id)}}" class="btn btn-danger btn-bold" title="Supprimer Demande" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
			<i class="ace-icon fa fa-trash-o orange"></i>Supprimer
		</a>
		@endif
	</div>
</div>
<div class="space-12"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header"><h4 class="widget-title">Détails de la demande :</h4></div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<div class="user-profile row">
									<div class="col-xs-12 col-sm-3 center">
								   	<div class="profile-user-info profile-user-info-striped">
									  	<div class="profile-info-row">
												<div class="profile-info-name"> Date : </div>
												<div class="profile-info-value"><span class="editable" id="username">{{ $demande->Date }}</span></div>
											</div>
										</div>
										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name">Etat : </div>
												<div class="profile-info-value">
														@if($demande->etat == null)
															<span class="badge badge-success">En Cours
														@elseif($demande->etat == 1)
															<span class="badge badge-primary">Validé	
														@elseif($demande->etat == 0)
																<span class="badge badge-warning">Rejeté
														@endif
														</span>
													</div>
												</div>
												@if($demande->motif)
												<div class="profile-info-row">
													<div class="profile-info-name"> Motif : </div>
													<div class="profile-info-value"><span class="editable" id="username">{{ $demande->motif }}</span></div>
												</div>
												@endif
												<div class="profile-info-row">
													<div class="profile-info-name"> Demandeur : </div>
													<div class="profile-info-value">
														<span class="editable" id="username">{{ $demande->demandeur->nom }} {{ $demande->demandeur->prenom }}</span>
													</div>
												</div>
												</div>
											</div>
									</div>
									<br>
								<div>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="center"><strong>Code Produit</strong></th>
												<th class="center" ><strong>Produit</strong></th>
												<th class="center"><strong>Spécialité</strong></th>
												<th class="center"><strong>Gamme </strong></th>
												<th class="center"><strong>Quantité</strong></th>
												@if($demande->etat == "1")
												<th class="center">Qte Donnée</th>
												@endif
											</tr>
										</thead>
										<tbody>
											@foreach($demande->dispositifs as $dispositif)
												<tr>
													<td>{{ $dispositif->code}}</td>
													<td>{{ $dispositif->nom}}</td>
													<td>/</td>
													<td>DISPOSITIFS MEDICAUX</td>
													<td  class="center">{{ $dispositif->pivot->qte }}</td>
													@if($demande->etat == "1")
													<td  class="center">{{ $dispositif->pivot->qteDonne }}</td>
													@endif
												</tr>
											@endforeach
											@foreach($demande->medicaments as $medicament)
												<tr>
													<td>{{ $medicament->code_produit }}</td>
													<td>{{ $medicament->nom }}</td>
													<td>{{ $medicament->specialite->nom }}</td>
													<td><span>MEDICAMENTS</span></td>
													<td  class="center">{{ $medicament->pivot->qte }}</td>
													@if($demande->etat == "1")
													<td  class="center">{{ $medicament->pivot->qteDonne }}</td>
													@endif
												</tr>
											@endforeach
											@foreach($demande->reactifs as $reactif)
												<tr>
													<td>{{ $reactif->code }}</td>
													<td>{{ $reactif->nom }}</td>
													<td>/</td>
													<td><span>Réactifs chimiques et dentaires</span></td>
													<td class="center">{{ $reactif->pivot->qte }}</td>
													@if($demande->etat == "1")
														<td  class="center">{{ $reactif->pivot->qteDonne }}</td>
													@endif
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
@endsection