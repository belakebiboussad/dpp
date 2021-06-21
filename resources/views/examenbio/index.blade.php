@extends('app')
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		<div class="space-6"></div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-large">
						<h3 class="widget-title grey lighter"><i class="ace-icon fa fa-leaf green"></i>Liste des demandes</h3>
					</div>
					<div class="widget-body">
						<div class="widget-main padding-24">
							<div class="col-sm-12 widget-container-col">
								<div>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="center">#</th>
												<th class="hidden-480"><strong>Date</strong></th>
												<th class="center"><strong>Médecin traitant</strong></th>
												<th class="center"><strong>Patient</strong></th>
												<th class="center"><strong>Etat</strong></th>
												<th class="center"><em class="fa fa-cog"></em></th>
											</tr>
										</thead>
										<tbody>
											@foreach($demandesexb as $index => $demande)
												<tr>
													<td class="center">{{ $index + 1 }}</td>
													<td>
													@if(isset($demande->id_consultation))
														{{ $demande->consultation->Date_Consultation }}
													@else		
														{{ $demande->visite->date }}
													@endif
													</td>
													<td>
													@if(isset($demande->id_consultation))
														{{ $demande->consultation->docteur->nom }} {{ $demande->consultation->docteur->prenom }}
													@else
														{{ $demande->visite->hospitalisation->medecin->nom }} {{ $demande->visite->hospitalisation->medecin->prenom }}
													@endif	
													</td>
													<td>
													@if(isset($demande->id_consultation))
														{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }} <small class="text-primary">(Consultation)</small>
													@else
														{{ $demande->visite->hospitalisation->patient->Nom }} {{ $demande->visite->hospitalisation->patient->Prenom }} <small class="text-warning">(Hospitalisation)</small>
													@endif
													</td>
													<td>
														@if($demande->etat == null)
															En Attente
														@elseif($demande->etat == "1")
															Validé
														@else
															Rejeté
														@endif
													</td>
													<td class="center">
													  <a href="{{ route('demandeexb.show', $demande->id) }}"><i class="fa fa-eye"></i></a>
									    			<a href="/detailsdemandeexb/{{ $demande->id }}" title="attacher résultat">
															<i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
														</a>
													</td>
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
	</div><!-- /.col -->
</div><!-- /.row -->
@endsection