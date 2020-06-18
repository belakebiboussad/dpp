		{{-- homme C	 --}}
		<div id="Homme_C" class="tab-pane">
		   	<div id ="homme_cPart">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="header smaller lighter blue"><b>Information de l'Homme de confiance</b></h3>
					</div>	
				</div>{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nomA"><strong>Nom :</strong></label>
							<div class="col-sm-9">
								<input type="text" id="nomA" name="nom_homme_c" placeholder="Nom..." class="col-xs-12 col-sm-12" />
							</div>
							<br>
						</div>
						<br>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="prenomA"><strong>Prénom :</strong></label>
							<div class="col-sm-9">
								<input type="text" id="prenomA" name="prenom_homme_c" placeholder="Prénom..." class="col-xs-12 col-sm-12" />
							</div>
							<br>
						</div>
						<br>
					</div>
				</div>
				{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="datenaissanceA"><strong class="text-nowrap">Né(e) le :</strong>	</label>
							<div class="col-sm-9">
								<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance_h_c" name="datenaissance_h_c" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label " for="lien"><strong>Lien de parenté :</strong></label>
							<div class="col-sm-9">
								<select id="lien" name="lien" class="col-xs-12 col-sm-12" />
									<option value="">Sélectionner...</option>
									<option value="conjoint">Conjoint(e)</option>
									<option value="père">Père</option>
									<option value="mère">Mère</option>
									<option value="frère">Frère </option>
									<option value="soeur">Soeur </option>
									<option value="membre_famille">Membre de famille </option>
									<option value="ami">Ami </option>
									<option value="Autre">Autre </option>
								</select>
							</div>
						</div>
					</div>					
				</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label " for="type_piece_id"><strong>Type  pièce d'identité:</strong>			</label>
						<div class="col-sm-9">
							<select id="type_piece_id" name="type_piece_id" class="col-xs-12 col-sm-12"/>
								<option value="">Sélectionner...</option>
								<option value="CNI">Carte d'identité nationale</option>
								<option value="Permis">Permis de Conduire</option>
								<option value="Passeport">Passeport </option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="npiece_id"><strong>N° de la pièce :</strong></label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" id="npiece_id" name="npiece_id" class="col-xs-12 col-sm-12" placeholder="N° de la pièce d'identité..." />
							</div>
						</div>
					</div>
					<br>
				</div>					
			</div>	
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="date_piece_id"><strong>Délivré le :</strong></label>
				               <div class="col-sm-9">
							<input class="col-xs-12 col-sm-12 date-picker" id="date_piece_id" name="date_piece_id" type="text" data-date-format="yyyy-mm-dd" placeholder="Délivré le..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<br><br>
				</div>
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
					<h3 class="header smaller lighter blue"><b>Contact</b></h3>
				</div>
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-5">
					<div class="form-group">
						<label class="control-label col-sm-3" for="adresseA"><b>Adresse :</b></label>
						<div class="col-sm-9">
							<textarea class="form-control" id="adresseA" name="adresseA" placeholder="Adresse..."></textarea>	
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<div class="form-group">
							<label class="control-label text-nowrap col-sm-2" for="mobileA"><i class="fa fa-phone"></i><b>Mob :</b></label>
							<div class="col-sm-2">
								<select name="operateur_h" id="operateur_h" class="form-control" >
							           <option value="">XX</option>
							         	<option value="05">05</option>         
							   	<option value="06">06</option>
							           <option value="07">07</option>
                </select>	
							</div>
						<input id="mobileA" name="mobile_homme_c"  maxlength =8 minlength =8  name="mobileA" type="tel" autocomplete="off" class="col-sm-2" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX"  />
						</div>
					</div>
				</div>
			</div>	{{-- row --}}	
			</div>{{-- homme_cPart	 --}}
		</div>	{{-- tab-pane --}}
		{{--fin homme--}}