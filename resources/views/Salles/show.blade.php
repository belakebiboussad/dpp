@extends('app')
@section('main-content')
	<div class="page-header"><h4>Détails de la chambre "{{ $salle->nom }}"</h4></div>
	<div class="row">
		<div class="col-xs-6">
			<div class="widget-box">
				<div class="widget-header"><h6 class="widget-title">Détails de la chambre :</h6></div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="form-group">
							<label class="col-sm-3 control-label">Numéro chambre:</label><span> {{ $salle->num }} </span>
            </div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nom :</label> <span>{{ $salle->nom }}</span>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Capacité :</label><span> {{ $salle->max_lit }} lits</span>       
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Lits en place :</label><span> {{ $salle->lits->count() }} lits  </span>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Bloc : </label><span>{{ $salle->bloc }}</span>
         					</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Etage : </label><span>{{ $salle->etage }}</span> 
                                              </div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Etat : </label>
              	                        <span class="label label-sm label-{{ (isset($salle->etat )) ? 'warning' : 'primary' }}">
                                                    @if(!(isset( $salle->etat )))    Non   @endif
                                                     Bloquée</span>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Service :</label><span>{{ $salle->service->nom}}</span>
            </div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-6">
		  @if( $salle->lits->count() > 0 )
			<div class="widget-box">
				<div class="widget-header"><h5 class="widget-title">Liste des lits :</h5></div>
				<div class="widget-body">
					<div class="widget-main">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr><th>Numéro</th><th>Nom</th><th>Etat</th><th>Affectation</th></tr>
							</thead>
							<tbody>
								@foreach($salle->lits as $lit)
								<tr>
									<td>{{ $lit->num }}</td><td>{{ $lit->nom }}</td>
									<td>{{ $lit->bloq == 1 ? "Bloqué" : "Non Bloqué" }}</td>
									<td>{{ $lit->affectation == 1 ? "Affecté" : "Non Affecté" }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
	@endsection