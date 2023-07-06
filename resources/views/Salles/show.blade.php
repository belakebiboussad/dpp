<div class="page-header"><h1>Détails de la chambre "{{ $salle->nom }}"</h1></div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header"><h6 class="widget-title">Chambre</h6></div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="form-group">
						<label class="col-sm-3 control-label text-right">Numéro : </label><span> {{ $salle->num }} </span>
          </div>
          <div class = "form-group">
            <label class ="col-sm-3 control-label text-right">Nom :</label><span>{{ $salle->nom }}</span>
          </div>
				  <div class="form-group">
					 <label class="col-sm-3 control-label text-right">Capacité :</label><span>{{ $salle->max_lit }} lits</span>       
				  </div>
				<div class="form-group">
					<label class="col-sm-3 control-label text-right">Lits en place:</label><span> {{ $salle->lits->count() }} lits</span>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label text-right">Bloc :</label>
          <span>{{ $salle->bloc }}</span>
       	</div>
				<div class="form-group">
					<label class="col-sm-3 control-label text-right">Etage :</label><span>{{ $salle->etage }}</span> 
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label text-right">Service :</label><span>{{ $salle->service->nom}}</span>
        </div>
        <div class="form-group disabled">
          <label class="col-sm-3 control-label text-right" for="genre">Unité :</label><span>
            @switch($salle->genre)
                @case(0)
                  Homme
                  @break
                @case(1)
                  Femme
                  @break
                @case(2)
                  Enfant
                  @break
                @Default
                  @break
              @endswitch</span>
        </div>
				<div class="form-group">
          <div class="checkbox col-sm-offset-3">
						<label class="control-label">
              <input type="checkbox" class="ace form-control" {{(isset($salle->etat))? 'checked':''}} disabled/><span class="lbl"> Bloquée</span>
            </label>
          </div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
@if( $salle->lits->count() > 0 )
<div class="row">
  <div class="col-xs-12">
		<div class="widget-box">
			<div class="widget-header"><h5 class="widget-title">Liste des lits</h5></div>
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
								<td>{{ $lit->affectation == 1 ? "Oui" : "Non" }}</td>
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