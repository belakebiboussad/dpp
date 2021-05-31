		<div class="widget-box" id="widget-box-1"><!-- debut -->
				<div class="widget-header">
					<h5 class="widget-title"><i class="ace-icon fa fa-bed bigger-120"></i><strong>Détails :</strong>
					</h5>
				</div>
				<div class="widget-body">
					<div class="widget-main">					
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue" for="num"><strong> Numéro : </strong></label>
							<div><strong>{{ $lit->num }}</strong></div>
						</div>	
						</div>
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue" for="num"><strong> Nom :</strong></label>
							<div><strong>{{ $lit->nom }}</strong><br></div>
						</div>	
						</div>
						<div class="form-group">
						<div class="i-checks">
							<label class="col-sm-3 control-label no-padding-right blue" for="etat"><strong> Etat : </strong></label>
							<div><strong>{{ $lit->etat == 1 ? "Non Bloqué" : "Bloqué" }}</strong></div>
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="max"><strong> Affectation :</strong></label>
							<div><strong> {{ $lit->affectation == 0 ? "Non Affecté" : "Affecté" }}</strong></div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="salle">
								<strong>Chambre :</strong></label>
							<div><strong>{{ $lit->salle->nom }}</strong></div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right blue" for="bloc"><strong> Service : </strong></label>
							<div><strong>{{ $lit->salle->nom }}</strong></div>
						</div>
					</div>
				</div>
			</div><!-- fin -->