		<div class="widget-box"><!-- debut -->
				<div class="widget-header">
					<h5 class="widget-title"><i class="ace-icon fa fa-bed bigger-120"></i>Détails :</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">					
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label blue">Numéro : </label><span>{{ $lit->num }}</span>
						</div>	
						</div>
						<div class="form-group">
						        <div class="i-checks"><label class="col-sm-3 control-label blue">Nom :</label><span>{{ $lit->nom }}</<span></div>	
						</div>
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label blue"> Etat : </label><span>{{ $lit->bloq == 1 ? "Bloqué" : "Non Bloqué" }}</span>
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label blue" >Affectation :</label>
							<span> {{ $lit->affectation == 1 ? "Affecté" : "Non  Affecté" }}</span>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label blue">Chambre :</label><span>{{ $lit->salle->nom }}</span>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label blue">Service : </label><span>{{ $lit->salle->Service->nom }}</span>
						</div>
					</div>
				</div>
			</div><!-- fin -->