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
<div class="page-header">
	<h1 style="display: inline;"><strong>Liste des demandes </strong></h1>
	<div class="pull-right">
		@if(Auth::user()->is(14))
		<a href="{{route('demandeproduit.create')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-plus-circle fa-lg bigger-120"></i> Demande
		</a>
		@endif
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
				<div class="widget-header"><h4 class="widget-title">Demandes :</h4>	</div>
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
															<span class="badge badge-info">	En attente</span>
														@elseif($demande->Etat == "V")
														<span class="badge badge-success">Validé</span>
														@elseif($demande->Etat == "R")
															<span class="badge badge-danger">Rejeté</span>
														@endif
													</td>
													<td>{{ $demande->demandeur->nom }} {{ $demande->demandeur->prenom }}</td>
													<td class="center">
														<a href="{{ route('demandeproduit.show', $demande->id) }}" class="btn btn-xs btn-success" title="voir détails">
															<i class="ace-icon fa fa-hand-o-up bigger-120"></i>
														</a>
														@if((Auth::user()->role_id == 14) && ($demande->Etat == "E"))
														<a href="{{ route('demandeproduit.edit',$demande->id) }}" class="btn btn-white btn-xs" title="editer Demande">
															<i class="fa fa-edit fa-xs"></i>
														</a>
														<a href="{{ route('demandeproduit.destroy',$demande->id) }}" data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger">
															<i class="fa fa-trash-o"></i>
														</a>
														@endif
														@if(Auth::user()->role_id == 10)
														<a href="{{ route ("runDemande",$demande->id) }}" class="btn btn-xs btn-info" title="Traiter Demande" >	{{-- --}}
															<i class="ace-icon fa fa-cog  bigger-110"></i>
														</a>
														@endif
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
</div>
@endsection