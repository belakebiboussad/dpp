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
					Liste Des Lits :
				</h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
					<a href="/createlit"> <b>Ajouter Un Lit</b></a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>Numéro De Lit</th>
								<th>Etat De Lit</th>
								<th>Affectation</th>
								<th>Numéro De La Chambre</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($lits as $lit)
								<tr>
									<td>{{ $lit->num }}</td>
									<td>{{ $lit->etat == 1 ? "Non Bloqué" : "Bloqué" }}</td>
									<td>{{ $lit->affectation == 0 ? "Non Affecté" : "Affecté" }}</td>
									<td>{{ App\modeles\salle::where("id",$lit->id_salle)->get()->first()->num }}</td>
									<td>
										<div class="pull-right">
											<div class="hidden-sm hidden-xs btn-group">
												<a href="{{ route('lit.show', $lit->id) }}" class="btn btn-xs btn-success">
													<i class="ace-icon fa fa-sign-in bigger-120"></i>
													Afficher
												</a>
												<a href="{{ route('lit.edit', $lit->id) }}" class="btn btn-xs btn-info">
													<i class="ace-icon fa fa-pencil bigger-120"></i>
													Modifier
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