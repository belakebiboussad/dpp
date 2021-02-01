@extends('app')
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Détails de la demande de produit du </strong> &quot;{{ $demande->Date}}&quot;</h1>
	<div class="pull-right">
		<a href="{{route('demandeproduit.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i> Liste Demandes
		</a>
	</div>
</div>
<div class="space-12"></div><!-- / -->
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12">
			<div class="widget-box">
				<div class="widget-header"><h4 class="widget-title">Détails de la demande :</h4></div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<div>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<div class="profile-user-info profile-user-info-striped">
													<div class="profile-info-row">
														<div class="profile-info-name"> Date : </div>
														<div class="profile-info-value">
															<span class="editable" id="username">{{ $demande->Date }}</span>
														</div>
													</div>
												</div>
												<div class="profile-user-info profile-user-info-striped">
													<div class="profile-info-row">
														<div class="profile-info-name"> Etat : </div>
														<div class="profile-info-value">
															<span class="editable" id="username">
																@if($demande->Etat == "E")
																	En Attente.
																@elseif($demande->Etat =="V")
																	Validé
																@elseif($demande->Etat =="R")
																	Rejeté
																@endif
															</span>
														</div>
													</div>
													@if($demande->motif)
													<div class="profile-info-row">
														<div class="profile-info-name"> Motif : </div>
														<div class="profile-info-value">
															<span class="editable" id="username">{{ $demande->motif }}</span>
														</div>
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
									</div>
								</div>
								<br>
								<div>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Code Produit</th>
												<th>Produit</th>
												<th>Spécialité</th>
												<th>Gamme</th>
												<th>Qte</th>
											</tr>
										</thead>
										<tbody>
											@foreach($demande->dispositifs as $dispositif)
												<tr>
													<td>{{ $dispositif->code }}</td>
													<td>{{ $dispositif->nom }}</td>
													<td>/</td>
													<td>DISPOSITIFS MEDICAUX</td>
													<td>{{ $dispositif->pivot->qte }}</td>
												</tr>
											@endforeach
											@foreach($demande->medicaments as $medicament)
												<tr>
													<td>{{ $medicament->code_produit }}</td>
													<td>{{ $medicament->dci }}</td>
													<td>{{ $medicament->specialite->specialite_produit }}</td>
													<td>MEDICAMENTS</td>
													<td>{{ $medicament->pivot->qte }}</td>
												</tr>
											@endforeach
											@foreach($demande->reactifs as $reactif)
												<tr>
													<td>{{ $reactif->code }}</td>
													<td>{{ $reactif->nom }}</td>
													<td>/</td>
													<td>Réactifs chimiques et dentaires</td>
													<td>{{ $reactif->pivot->qte }}</td>
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
		</div><!-- /.span -->
	</div>
</div>
@endsection