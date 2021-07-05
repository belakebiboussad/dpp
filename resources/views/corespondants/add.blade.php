<div id="gardeMalade" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
	 <div class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"  id="CoresCrudModal">Ajouter un correspondant(e)</h4> 
		</div>
		<div class="modal-body">
			<form id="addGardeMalade" method="POST" action ="{{  route('hommeConfiance.store') }}">
				{!! csrf_field() !!}
				<input type="hidden" name="patientId" id ="patientId" value="{{ $patient->id }}">
				<input type="hidden" name="userId" id ="userId" value="{{ Auth::user()->employee_id}}">
				 <input type="hidden" id="hom_id" name="hom_id" value="0">
				<hr>
	 			<div class="row">	
		 			<div class="col-sm-12">				
				              <span style="float: right; display: none;" id="relation_autre">
				            		<label id="labelFor_editCorrespondant_relation_autre" for="editCorrespondant_relation_autre" class="" title="Rôle autre">Rôle autre</label> :
				            		<input id="editCorrespondant_relation_autre" autocomplete="off" name="relation_autre" value="" type="text">
				         	</span>
			          		<span  class ="primary"  style="float: left;">
			            		<select name="typeH" id="typeH" class="enum list|prevenir|garde">
							<option value="0">Garde malade</option>
							<option value="1">Personne à prévenir</option>
						</select>
			          		</span>
			          </div>
				</div>
				<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Informations&nbsp;&nbsp;&nbsp;</h3></div></div>	
				<div class="row">
					<div class="col-sm-6 col-sm-12">
						<div class="form-group ">
							<label class="col-sm-3 control-label no-padding-right" for="nom_h"><b>Nom:</b> </label>
							<div class="col-sm-9">
								<input type="text" id="nom_h" name="nom_h"  placeholder="Nom..." class="col-xs-12 col-sm-12"  required/>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-sm-12">
						<div class="form-group ">
							<label class="col-sm-3 control-label no-padding-right" for="prenom_h"><b>Prénom :</b></label>
							<div class="col-sm-9">
								<input type="text" id="prenom_h" name="prenom_h" placeholder="Prénom..." class="col-xs-12 col-sm-12" required/>
							</div>
						</div>
					</div>
				  </div>	<div class="space-12"></div>
		  		<div class="row">
					<div class="col-sm-6">
						<div class="form-group ">
							<label class="col-sm-3 control-label no-padding-right" for="datenaissance_h"><b class="text-nowrap">Né(e) le :</b></label>
							<div class="col-sm-9">
								<input class="col-xs-12 col-sm-12 date-picker ltnow" id="datenaissance_h" name="datenaissance_h" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" required />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group ">
							<label class="col-sm-3 control-label no-padding-right" for="lien_par"><b>Relation :</b></label>
							<div class="col-sm-9">
								<select class="form-control col-xs-12 col-sm-12" id="lien_par" name="lien_par" placeholder="date de délivrance ..."  required>
									<option value="">Sélectionner...</option>
									<option value="0">Conjoint(e)</option>
									<option value="1">Père</option>
									<option value="2">Mère</option>
									<option value="3">Frère </option>
									<option value="4">Soeur </option>
									<option value="5">Ascendant</option>
									<option value="6">Grand-parent</option>
									<option value="7">Membre de famille </option>
									<option value="8">Ami </option>
									<option value="9">Collègue</option>
									<option value="10">Employeur</option>
									<option value="11">Employé</option>
									<option value="12">Tuteur</option>
									<option value="13">Autre </option>
								</select>
							</div>
						</div>
					</div>			
			  	</div>	{{-- row --}}
		  		<div class="space-12"></div>
		  		<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="type_piece">	<b>Type de la pièce d'identité :</b></label>
							<div class="col-sm-9">					
							<div class="radio">
								<label>
								<input id="CNI" name="type_piece" value="0" type="radio" class="ace" checked /><span class="lbl">Carte nationale d'identité</span>
								</label>
								<label><input id="Permis" name="type_piece" value="1" type="radio" class="ace" /><span class="lbl">Permis de Conduire</span></label>
								<label><input id="Passeport" name="type_piece" value="2" type="radio" class="ace" /><span class="lbl">Passeport</span></label>
							</div>
							</div>
						</div>
					</div>
			  	</div>{{-- row --}}
		  		<div class="space-12"></div>
			  	<div class="row">	
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="num_piece"><b>N° pièce: </b></label>
							<div class="col-sm-9">
								<input type="text" id="num_piece" name="num_piece" placeholder="N° pièce..." class="col-xs-12 col-sm-6" required/>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group ">
							<label class="col-sm-3 control-label no-padding-right" for="date_piece_id"><b class="text-nowrap">Délivré le :</b></label>
							<div class="col-sm-9">
								<input class="col-xs-12 col-sm-6 date-picker" id="date_piece_id" name="date_piece_id" type="text" data-date-format="yyyy-mm-dd" placeholder="date de délivrance ..."/>
							</div>
						</div>
					</div>
		  		</div>{{-- row --}}
				<div class="space-12"></div>
			      <div class="row">
		 			<div class="col-sm-6">
						<div>
							<i class="fa fa-map-marker light-orange bigger-110"></i><label for="adresse"><b>Adresse :</b></label>
							<input class="form-control" id="adresse_h" name="adresse_h" placeholder="Adresse..." />
						</div>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
							<div class="form-group col-sm-8">
								<i class="fa fa-phone"></i><label for="mobile_h"><b>Mob : </b></label>
								<br/>
								<input type="tel" id="mobile_h" name="mobile_h" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"  class="col-sm-12 mobile" required>
								<span class="tel validity"></span>
							</div>
					</div>			
			       </div>	{{-- row --}}
				<div class="space-12"></div>  <div class="space-12"></div><div class="space-12"></div>	
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-sm btn-submit" id ="EnregistrerGardeMalade" value="add"> <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
      	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
      </div>	
		</div>
	</div>
</div>