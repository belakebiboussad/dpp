@extends('app_phar')
@section('page-script')
<script src="{{asset('/js/jquery-2.2.4.js')}}"></script>
<script src="{{ asset('/js/datatables.js') }}"></script>
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
				<div class="widget-header">
					<h4 class="widget-title">Liste Des Demandes :</h4>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<div>
									<table id="demandes_liste" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>Date</th>
												<th>Etat</th>
												<th>Demandeur</th>
												<th></th>
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
													<td>
														{{ $demande->demandeur->Nom_Employe }} {{ $demande->demandeur->Prenom_Employe }}
													</td>
													<td class="center">
														<a href="/traiterdemande/{{ $demande->id }}" class="btn btn-white btn-xs">
															<i class="ace-icon fa fa-info-circle"></i>
															Détails
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