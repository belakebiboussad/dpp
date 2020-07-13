<div id="gardeMalade" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
	 <div class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Ajouter un Correspondant</h4>
		</div>
		<div class="modal-body">
			{{-- {{  route('hommeConfiance.store') }} --}}
			<!-- /hommeConfiance/save -->
			<form id="addGardeMalade" method="POST" action ="">
				{!! csrf_field() !!}
				<input type="hidden" name="patientId" id ="patientId" value="{{ $patient->id }}">
				<input type="hidden" name="userId" id ="userId" value="{{ Auth::user()->employee_id}}">
				<hr>
	 			<div class="row">	
		 			<div class="col-sm-12">				
	              <span style="float: right; display: none;" id="relation_autre">
	            			<label id="labelFor_editCorrespondant_relation_autre" for="editCorrespondant_relation_autre" class="" title="Rôle autre">Rôle autre</label> :
	             			<input id="editCorrespondant_relation_autre" autocomplete="off" name="relation_autre" value="" type="text">
	         			</span>
	          		<span  class ="primary"  style="float: left;">
	            		<select name="type" id="type" class="enum list|prevenir|garde">
										<option value="garde">Garde Malade</option>
										<option value="prevenir">Personne à prévenir</option>
									</select>
	          		</span>
	          </div>
					</div>
					<div class="row">
						<div class="col-sm-12">				
							<h3 class="header smaller lighter blue">Informations&nbsp;&nbsp;&nbsp;</h3>
							</div>
				 		</div>	{{-- row --}}
				 		<div class="row">
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="col-sm-3 control-label no-padding-right" for="nom_h">
									<b>Nom:</b> 
								</label>
								<div class="col-sm-9">
									<input type="text" id="nom_h" name="nom_h"  placeholder="Nom..." class="col-xs-12 col-sm-6"  required/>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="col-sm-3 control-label no-padding-right" for="prenom_h">
									<b>Prénom :</b>
								</label>
								<div class="col-sm-9">
								<input type="text" id="prenom_h" name="prenom_h" placeholder="Prénom..." class="col-xs-12 col-sm-6" required/>
								</div>
							</div>
						</div>
				  	</div>	{{-- row --}}
						<div class="space-12"></div>
			  		<div class="row">
					<div class="col-sm-6">
						<div class="form-group ">
							<label class="col-sm-3 control-label no-padding-right" for="datenaissance_h">
								<b class="text-nowrap">Né(e) le :</b>
							</label>
							<div class="col-sm-9">
							<input class="col-xs-6 col-sm-6 date-picker" id="datenaissance_h" name="datenaissance_h" type="text" placeholder="Date de naissance..." data-date-format="yyyy-mm-dd" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
							<div class="form-group ">
								<label class="col-sm-3 control-label no-padding-right" for="lien_par">
									<b>Relation :</b>
								</label>
								<div class="col-sm-5">
									<select class="form-control" id="lien_par" name="lien_par" placeholder="date de délivrance ..." required>
										<option value="">Sélectionner...</option>
										<option value="Conjoint">Conjoint(e)</option>
										<option value="Père">Père</option>
										<option value="Mère">Mère</option>
										<option value="Frère">Frère </option>
										<option value="Soeur">Soeur </option>
										<option value="Ascendant">Ascendant</option>
										<option value="Grand-parent">Grand-parent</option>
										<option value="membre_famille">Membre de famille </option>
										<option value="Ami">Ami </option>
										<option value="Collègue">Collègue</option>
										<option value="Employeur">Employeur</option>
										<option value="Employé">Employé</option>
										<option value="Tuteur">Tuteur</option>
										<option value="Autre">Autre </option>
									</select>
								</div>
							</div>
					</div>			
				  	</div>	{{-- row --}}
			  		<div class="space-12"></div>
			  		<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="type_piece">
									<b>Type de la pièce d'identité :</b>
								</label>
								<div class="col-sm-9">					
									<div class="radio">
										<label>
										<input id="CNI" name="type_piece" value="CNI" type="radio" class="ace" checked />
											<span class="lbl">Carte Nationale d'Identité</span>
										</label>
										<label>
											<input id="Permis" name="type_piece" value="Permis" type="radio" class="ace"  />
											<span class="lbl">Permis de Conduire</span>
										</label>
										<label>
											<input id="Passeport" name="type_piece" value="Passeport" type="radio" class="ace" />
											<span class="lbl"> Passeport</span>
										</label>
									</div>
								</div>
							</div>
						</div>
				  	</div>{{-- row --}}
			  		<div class="space-12"></div>
				  	<div class="row">	
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="sf">
									<b>N° de la pièce: </b>
								</label>
								<div class="col-sm-9">
								<input type="text" id="num_piece" name="num_piece" placeholder="N° pièce..." class="col-xs-12 col-sm-6" required/>
							</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="col-sm-3 control-label no-padding-right" for="date_piece_id">
									<b class="text-nowrap">Délivré le :</b>
								</label>
								<div class="col-sm-9">
								<input class="col-xs-12 col-sm-6 date-picker" id="date_piece_id" name="date_piece_id" type="text" data-date-format="yyyy-mm-dd" placeholder="date de délivrance ..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
								</div>
							</div>
						</div>
			  		</div>{{-- row --}}
						<div class="space-12"></div>
				    <div class="row">
				 			<div class="col-sm-6">
								<div>
										<i class="fa fa-map-marker light-orange bigger-110"></i>
										<label for="adresse"><b>Adresse :</b></label>
										<textarea class="form-control" id="adresse_h" name="adresse_h" placeholder="Adresse..." required></textarea>
								</div>
							</div>
							<div class="col-sm-1">
							</div>
							<div class="col-sm-5">
								<div class="form-group col-sm-8">
									<i class="fa fa-phone"></i>
									<label for="mobile_h"><b>Tél-mob : </b></label>
									<br/>
									<input type="tel" id="mobile_h" name="mobile_h" placeholder="XX XX XX XX XX" autocomplete="off" maxlength="10" minlength="10"  pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"  class="col-sm-12" required>
									<span class="tel validity"></span>
								</div>
							</div>			
				    </div>	{{-- row --}}
					  <div class="space-12"></div>
					  <div class="space-12"></div>
					  <div class="space-12"></div>	
			 		</form>
			</div>
			<div class="modal-footer">
			<!--  -->
				<button type="submit" class="btn btn-info btn-sm btn-submit" id ="EnregistrerGardeMalade" value="add">
          <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
        </button>
          <input type="hidden" id="hom_id" name="hom_id" value="0">
       	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
        	<i class="ace-icon fa fa-close bigger-110"></i>Fermer
        </button>

			</div>	
		</div>
	</div>
</div>