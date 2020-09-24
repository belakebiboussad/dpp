@extends('app_radiologue')
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		<div class="space-6"></div>
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="widget-box transparent">
					<div class="widget-header widget-header-large">
						<h3 class="widget-title grey lighter"><i class="ace-icon fa fa-leaf green"></i>Liste des Demandes</h3>
					</div>
					<div class="widget-body">
						<div class="widget-main padding-24">
							<div class="col-sm-12 widget-container-col" id="widget-container-col-13">
								<div>
									<table class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="center">#</th>
												<th class="hidden-480 center"><strong>Date</strong></th>
												<th class="center"><strong>Médecin traitant</strong></th>
												<th class="center"><strong>Patient</strong></th>
												<th class="center"><strong>Etat</strong></th>
												<th class="center"><em class="fa fa-cog"></em></th>
											</tr>
										</thead>
										<tbody>
											@foreach($demandesexr as $index => $exr)
												<tr>
													<td class="center">{{ $index + 1 }}</td>
													<td>{{ $exr->Date }}</td>
													<td>{{ $exr->consultation->docteur->nom }}{{ $exr->consultation->docteur->prenom }}</td>
													<td>{{ $exr->consultation->patient->Nom }}{{ $exr->consultation->patient->Prenom }}
													</td>
													<td>
														@if($exr->etat == "E")
															En Attente
														@elseif($exr->etat == "V")
															Validé
														@else
															Rejeté
														@endif
													</td>
													<td class="center">
													 	<a href="{{ route('demandeexr.show', $exr->id) }}"><i class="fa fa-eye"></i></a>
			              				<a href="/details_exr/{{ $exr->id}}">	<i class="glyphicon glyphicon-upload glyphicon glyphicon-white" title="attacher résultat"></i></a>
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