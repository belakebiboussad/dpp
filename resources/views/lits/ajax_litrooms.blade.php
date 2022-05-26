<div class="servive-block servive-block-grey" id="widget-box-2">
<div class="widget-header">
	<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i><span><b>Détails du lit :</b></span>	</h5>
</div>
<div class="widget-body">
	<div class="widget-main">	
		<thead>	</thead>
		<tbody >
		@foreach ($lits as $key=>$lit)			
			<div class="form-group">
				<div class="i-checks">
					<label class="col-sm-3 control-label no-padding-right blue" for="num">Numéro :</label>
					<div><strong>{{ $lit->num }}</strong></div>
				</div>	
			</div>
    @endforeach
	</div>	{{-- widget-main--}}
	</div>{{-- widget-body --}}
	</div> 
<div class="widget-body">
					<div class="widget-main">					
						<div class="form-group">
							
						</div>
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue" for="num">Nom :</label>
							<div>
								@foreach ($lits as $key=>$lit)	     
								<strong>{{ $lit->nom }}</strong><br>
								@endforeach
							</div>
						</div>	
						</div>

	                 <div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue" for="etat">Etat :</label>
							<div>
								<strong>{{ $lit->etat == 1 ? "Non Bloqué" : "Bloqué" }}</strong>
							</div>
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue">Affectation :</label>
							<div><strong> {{ $lit->affectation == 0 ? "Non Affecté" : "Affecté" }}</strong></div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="salle">Chambre :</label>
							<div>
								<strong> {{ App\modeles\salle::where("id",$lit->salle_id)->get()->first()->nom }}</strong>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="salle">Service :</label>
							<div>
                <strong> {{ App\modeles\salle::where("id",$lit->salle_id)->get()->first()->service->nom }}</strong>
							</div>
						</div>
    </div>