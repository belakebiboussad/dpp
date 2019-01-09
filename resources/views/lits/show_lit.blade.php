@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Détails De lit :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title">Détails De lit :</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="num"><strong> Numéro De lit : </strong></label>
							<div>
								<strong>{{ $lit->num }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="nom"><strong> Etat De Lit : </strong></label>
							<div>
								<strong>{{ $lit->etat == 1 ? "Non Bloqué" : "Bloqué" }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="max">
								<strong> Affectation : </strong>
							</label>
							<div>
								<strong> {{ $lit->affectation == 0 ? "Non Affecté" : "Affecté" }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="max">
								<strong> Chambre : </strong>
							</label>
							<div>
								<strong> {{ App\modeles\salle::where("id",$lit->id_salle)->get()->first()->num }}</strong>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="bloc"><strong> Service : </strong></label>
							<div>
								<strong>{{ $service->nom }}</strong>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection