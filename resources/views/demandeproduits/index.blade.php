@extends('app')
@section('page.script')
<script type="text/javascript">
	$('#demandes_liste').dataTable({
 		ordering: true,
    "language": 
    {
  		"url": '/localisation/fr_FR.json'
    }, 
  });
</script>
@endsection
@section('main-content')
<div class="row">
	<div class="col-xs-12">
		<div class="col-xs-12">
			<div class="widget-box">
				<div class="widget-header"><h4 class="widget-title">Liste Des Demandes :</h4>	</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<div>
									<table id="demandes_liste" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th class="center"><strong>Date</strong></th>
												<th class="center"><strong>Etat</strong></th>
												<th class="center"><strong>Demandeur</strong></th>
												<th class="center"><strong><em class="fa fa-cog"></em></strong></th>
											</tr>
										</thead>
										<tbody>	
											@foreach($demandes as $demande)
												<tr>
													<td>{{ $demande->Date }}</td>
													<td>
														@if($demande->Etat == "E")
															En attente
														@elseif($demande->Etat == "V")
															Validé
														@elseif($demande->Etat == "R")
															Rejeté
														@endif
													</td>
													<td>{{ $demande->demandeur->nom }} {{ $demande->demandeur->prenom }}</td>
													<td class="center">
														<a href="{{ route('demandeproduit.show', $demande->id) }}" class="btn btn-success btn-xs">
															<i class="ace-icon fa fa-hand-o-up bigger-120"></i>Détails
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
		</div><!-- /.span -->
	</div>
</div>
@endsection