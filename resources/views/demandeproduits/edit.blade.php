@extends('app_phar')
@section('page.script')
<script type="text/javascript">
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12">
			<div class="widget-box">
				<div class="widget-header"><h4 class="widget-title">Détails de la demande :</h4>
					<div class="pull-right" style ="margin-top: -0.5%;">
						<a href="{{route('demandeproduit.index')}}" class ="btn btn-white btn-info btn-bold btn-xs">Liste demandes&nbsp;<i class="ace-icon fa fa-arrow-circle-left bigger-120 black"></i></a>
					</div>
				</div>
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
														<div class="profile-info-value"><span class="editable" id="username">{{ $demande->Date }}</span></div>
													</div>
												</div>
												<div class="profile-user-info profile-user-info-striped">
													<div class="profile-info-row">
														<div class="profile-info-name"> Etat : </div>
														<div class="profile-info-value">
															<span class="editable" id="username">
																@if($demande->Etat == "E")En Attente. @elseif($demande->Etat =="V") Validé
																@elseif($demande->Etat =="R")
																	Rejeté
																@endif
															</span>
														</div>
													</div>
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
												<th class="center"><strong>Code Produit</strong></th>
												<th class="center"><strong>Produit</strong></th>
												<th class="center"><strong>Spécialité</strong></th>
												<th class="center"><strong>Gamme</strong></th>
												<th class="center"><strong>Qte Demandé</strong></th>
												<th class="center"><strong>Qte Donnée</strong></th>
											</tr>
										</thead>
										<tbody>
											@foreach($demande->dispositifs as $dispositif)
												<tr>
													<td>{{ $dispositif->code }}</td>
													<td>{{ $dispositif->nom }}</td>
													<td>/</td>
													<td>Dispositif médical</td>
													<td>{{ $dispositif->pivot->qte }}</td>
												</tr>
											@endforeach
											@foreach($demande->medicaments as $medicament)
												<tr>
													<td>{{ $medicament->code_produit }}</td>
													<td>{{ $medicament->nom }}</td>
													<td>{{ $medicament->specialite->nom }}</td>
													<td> Médicament</td>
													<td>{{ $medicament->pivot->qte }}</td>
												</tr>
											@endforeach
											@foreach($demande->reactifs as $reactif)
												<tr>
													<td>{{ $reactif->code }}</td>
													<td>{{ $reactif->nom }}</td>
													<td>/</td>
													<td>Réactifs </td>
													<td>{{ $reactif->pivot->qte }}</td>
													<td><input type="number" name="qtedonne" value="" placeholder=""/></td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
								<br />
								<form class="form-horizontal"  method="POST" action="{{ route('demandeproduit.update', $demande->id) }}">
									{{ csrf_field() }}
  									{{ method_field('PUT') }}
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="avis"> <b>Avis :</b> </label>
										<div class="col-sm-8">
											<select class="chosen-select col-xs-10 col-sm-5" id="avis" name="avis" data-placeholder="Séléctionner...">
												<option value=""></option>
												<option value="R">Rejeté</option>
												<option value="V">Validé</option>
											</select>
										</div>
									</div>
									<div id="motifr" class="form-group" hidden>
										<label class="col-sm-3 control-label no-padding-right" for="motif"> <b>Motif :</b> </label>
										<div class="col-sm-9">
											<input type="text" id="motif" name="motif" placeholder="Motif..." class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="form-actions center">
										<button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save icon-on-left bigger-110"></i>&nbsp;Enregistrer</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.span -->
	</div>
</div>
@endsection