@extends('app')
@section('main-content')
<div class="page-header">
	<h1>Liste Des Lits :</h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					Liste des Lits :
				</h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
					<div class="fa fa-plus-circle bigger-90"></div>
					{{-- <a href="/createlit"> --}}
					<a href="/lit/create/"></a>
					 <b>&nbsp;Ajouter un Lit</b></a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Numéro</th>
								<th>Nom</th>
								<th>Bloqué </th>
								<th>Affectation</th>
								<th>Service</th>
								<th>Chambre</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($lits as $lit)
							<tr>
								<td>{{ $lit->num }}</td>
								<td>{{ $lit->nom }}</td>
								<td>{{ $lit->etat == 1 ? "Non" : "Oui" }}</td>
								<td>{{ $lit->affectation == 0 ? "Non" : "Oui" }}</td>
								{{-- {{ App\modeles\salle::where("id",$lit->salle_id)->get()->first()->nom }} --}}
								<td>{{ $lit->nomService }}</td>
								<td>{{ $lit->nomSalle }}</td>
								<td>
									<div class="pull-right">
										<div class="hidden-sm hidden-xs btn-group">
											<a href="{{ route('lit.show', $lit->id) }}" class="btn btn-xs btn-success">
												<i class="ace-icon fa fa-sign-in bigger-120"></i>Afficher
											</a>&nbsp;&nbsp;&nbsp;
											<a href="{{ route('lit.edit', $lit->id) }}" class="btn btn-xs btn-info">
												<i class="ace-icon fa fa-pencil bigger-120"></i>Modifier
											</a>
										&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
										</div>
									</div>
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