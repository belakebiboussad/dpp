<div class="servive-block servive-block-grey">
<div class="widget-header">
	<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i><span>Détails du lit :</span></h5>
</div>
<div class="widget-body">
	<div class="widget-main">	
		<tbody >
		@foreach ($lits as $key=>$lit)			
			<div class="form-group">
				<div class="i-checks">
					<label class="col-sm-3 control-label no-padding-right">Numéro :</label><div>{{ $lit->num }}</div>
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
							<label class="col-sm-3 control-label  no-padding-right">Nom : </label>
							<div>
								@foreach ($lits as $key=>$lit)	
								{{ $lit->nom }}<br>
		            @endforeach
							</div>
						</div>	
						</div>
	                 <div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue">Etat : </label>
							<div>
								<strong>{{ $lit->bloq == 1 ? "Bloqué" : "Non Bloqué" }}</strong>
							</div>
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue">Affectation : </label>
							<div>{{ $lit->affectation == 1 ? "Affecté" : "Non Affecté" }}</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue">Chambre : </label>
							<div> {{ App\modeles\salle::where("id",$lit->salle_id)->get()->first()->nom }}	</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue">Service : </label>			
							<div> {{ App\modeles\salle::where("id",$lit->salle_id)->get()->first()->service->nom }}</div>
						</div>
    </div>