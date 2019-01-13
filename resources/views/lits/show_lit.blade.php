@extends('app')
@section('main-content')
	<div class="page-header">
		<h1>Détails du Lit :</h1>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget-box" id="widget-box-1">
				<div class="widget-header">
					<h5 class="widget-title"><i class="ace-icon fa fa-bed bigger-120"></i><strong>Détails :</strong>
					</h5>
					<div class="widget-toolbar widget-toolbar-light no-border">
					<i class="ace-icon fa fa-table"></i>
					<a href="/lit"> <b>&nbsp;Liste des Lits</b></a>
				</div>
				</div>
				<div class="widget-body">
					<div class="widget-main">					
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue" for="num"><strong> Numéro : </strong></label>
							<div>
								<strong>{{ $lit->num }}</strong>
							</div>
						</div>	
						</div>
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue" for="num"><strong> Nom : </strong></label>
							<div>
								<strong>{{ $lit->nom }}</strong><br>
							</div>
						</div>	
						</div>
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue" for="etat"><strong> Etat : </strong></label>
							<div>
								<strong>{{ $lit->etat == 1 ? "Non Bloqué" : "Bloqué" }}</strong>
							</div>
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
							<label class="col-sm-3 control-label no-padding-right blue" for="salle">
								<strong> Chambre : </strong>
							</label>
							<div>
								<strong> {{ App\modeles\salle::where("id",$lit->id_salle)->get()->first()->nom }}</strong>
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