@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Détails De La Chambre :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">Détails De La Chambre :</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="num"><strong> Numéro Chambre : </strong></label>
							<div>
								<strong>{{ $salle->num }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="nom"><strong> Nom Chambre : </strong></label>
							<div>
								<strong>{{ $salle->nom }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="max">
								<strong> Max  Lits : </strong>
							</label>
							<div>
								<strong>{{ $salle->max_lit }} Lits</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="max">
								<strong> Nombre Lits : </strong>
							</label>
							<div>
								<strong>{{ App\modeles\lit::where("salle_id",$salle->id)->count() }} Lits</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="bloc"><strong> Bloc : </strong></label>
							<div>
								<strong>{{ $salle->bolc }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="etage"><strong> Etage : </strong></label>
							<div>
								<strong>{{ $salle->etage }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="etat"><strong> Etat Chambre : </strong></label>
							<div>
								<strong>{{ $salle->etat }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="service"><strong> Service : </strong></label>
							<div>
								<strong>{{ App\modeles\service::where("id", $salle->service_id)->get()->first()->nom }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">Liste Lits : <strong>{{ $salle->nom }}</strong></h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>Numéro De Lit</th>
									<th>Etat De Lit</th>
									<th>Affectation</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($lits as $lit)
								<tr>
									<td>{{ $lit->num }}</td>
									<td>{{ $lit->etat == 1 ? "Non Bloqué" : "Bloqué" }}</td>
									<td>{{ $lit->affectation == 0 ? "Non Affecté" : "Affecté" }}</td>
									<td></td>
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