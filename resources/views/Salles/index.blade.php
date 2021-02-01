@extends('app')
@section('main-content')
<div class="page-header">
	<h1>Liste Des Chambres :</h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box widget-color-light" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					Liste des Chambres :
				</h5>
				<div class="widget-toolbar widget-toolbar-primary no-border">
					<a class="btn btn-primary btn-sm" href="createsalle" role="button">
						<i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i> <strong>Chambre</strong>
					</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class ="center" width="5%"><strong>N°</strong></th>
								<th class ="center" width="15%"><strong>Nom</strong></th>
								<th class ="center" width="10%"><strong>Lits(nbr)</strong></th>
								<th class ="center"  width="10%"><strong>n° Bloc</strong></th>
								<th class ="center"><strong>Etage</strong></th>
								<th class ="center"><strong>Etat</strong></th>
								<th class ="center"><strong>Service</strong>Service</th>
								<th class ="center" width="15%"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						@foreach($salles as $salle)
							<tr>
								<td width="5%">{{ $salle->num }}</td>
								<td width="15%">{{ $salle->nom }}</td>
								<td width="10%">{{ $salle->max_lit }}</td>
								<td width="10%">{{ $salle->bolc }}</td>
								<td>{{ $salle->etage }}</td>
								<td>{{ $salle->etat }}</td>
								<td>{{ $salle->service->nom }}</td>
								<td class ="center" width="15%">
									<a href="{{ route('salle.show', $salle->id) }}" class="btn btn-xs btn-success smalltext">
										<i class="ace-icon fa fa-hand-o-up bigger-120"></i>
									</a>
									<a href="{{ route('salle.edit', $salle->id) }}" class="btn btn-xs btn-info smalltext">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</a>
									<a href="/lit/create/{{ $salle->id }}" class="btn btn-xs btn-grey smalltext">
										<i class="ace-icon fa fa-plus bigger-120"></i>
									</a>	
									<a href="{{ route('salle.destroy', $salle->id) }}"  data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger smalltext">
										<i class="ace-icon fa fa-trash-o fa-xs"></i>
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
@endsection