@extends('app')
@section('main-content')
	<div class="page-header"><h1>Détails de la chambre "{{ $salle->nom }}"</h1></div>
	<div class="row">
		<div class="col-xs-6">
			<div class="widget-box">
				<div class="widget-header"><h6 class="widget-title">Chambre</h6></div>
				<div class="widget-body">
					<div class="widget-main">
						<div class="form-group">
							<label class="col-sm-3 control-label text-right">Numéro </label><p class = "form-control-static"> {{ $salle->num }} </p>
            </div>
            <div class = "form-group">
            <label class = "col-sm-3 control-label text-right">Nom</label>
            <div class ="col-sm-9">
               <p class ="form-control-static">{{ $salle->nom }}</p>
            </div>
         </div>


						<div class="form-group">
							<label class="col-sm-3 control-label text-right">Capacité</label><p class ="form-control-static">{{ $salle->max_lit }} lits</p>       
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label text-right">Lits en place</label><p class ="form-control-static"> {{ $salle->lits->count() }} lits</p>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Bloc</label><p class ="form-control-static">{{ $salle->bloc }}</o>
         					</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Etage</label><span>{{ $salle->etage }}</span> 
            </div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Bloquée ?</label>
              <span class="label label-sm label-{{ (isset($salle->etat )) ? 'warning' : 'primary' }}">
                @if(!(isset( $salle->etat )))    Non   @endif
              </span>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Service</label><span>{{ $salle->service->nom}}</span>
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
								<tr><th>Numéro</th><th>Nom</th><th>Bloqué ?</th><th>Affectation</th></tr>
							</thead>
							<tbody>
								@foreach($salle->lits as $lit)
								<tr>
									<td>{{ $lit->num }}</td><td>{{ $lit->nom }}</td>
									<td>{{ $lit->bloq == 1 ? "Oui" : "Non" }}</td>
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
	@stop