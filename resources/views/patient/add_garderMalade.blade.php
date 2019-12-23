<div id="gardeMalade" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<!-- Modal content-->
	 	<div class="modal-content custom-height-modal">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Ajouter Garde Malade/Homme de Confiance</h4>
			  @include('patient._patientInfo')
			</div>
			<div class="modal-body">
			<!-- {{  route('hommeConfiance.store') }} -->
				<form id="addGardeMalade" method="POST" action ="/hommeConfiance/save">
					 {!! csrf_field() !!}
					 <input type="hidden" name="patientId" id ="patientId" value="{{ $patient->id }}">
	 				<div class="row">	
	 				<tr>
                  <span style="float: right; display: none;" id="relation_autre">
            <label id="labelFor_editCorrespondant_relation_autre" for="editCorrespondant_relation_autre" class="" title="Rôle autre">Rôle autre</label> :
              <input id="editCorrespondant_relation_autre" autocomplete="off" name="relation_autre" value="" type="text">
          </span>
          <span style="float: left;">
            <select id="editCorrespondant_relation" name="relation" class="enum list|prevenir|garde" onchange="toggleRelationAutre(this); toggleUrrsafParente(this); toggleConfiancePrevenir(this); toggleAssurance(this);">
						<option value="garde">Garde Malade</option>
						<option value="prevenir">Personne à prévenir</option>
					</select>
          </span>
        </tr>
					</div>
					<div class="row">
							<div class="col-sm-12">				
								<h3 class="header smaller lighter blue">
									Informations de l'homme de confiance
									&nbsp;&nbsp;&nbsp;
									 <a class="orange" href="#" id="edit_hc" ><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
									 <a class="green" href="#" id="add_hc"><i class="glyphicon glyphicon-plus-sign"></i></a>
								</h3>
							</div>
				 		 </div>	{{-- row --}}
				 		<div class="row">
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="col-sm-3 control-label no-padding-right" for="nom_h">
									<b>Nom :</b> 
								</label>
								<div class="col-sm-9">
									<input type="hidden" id="id_h" name="id_h"  @if(isset($homme_c)) value="{{ $homme_c->id}}" @endif/>
									<input type="hidden" id="etat_h" name="etat_h" @if(isset($homme_c)) value="actuel" @endif/>
									<input type="text" id="nom_h" name="nom_h" @if(isset($homme_c)) value="{{ $homme_c->nom }}" @endif placeholder="Nom..." class="col-xs-12 col-sm-6" readonly/>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="col-sm-3 control-label no-padding-right" for="prenom_h">
									<b>Prénom :</b>
								</label>
								<div class="col-sm-9">
								<input type="text" id="prenom_h" name="prenom_h" @if(isset($homme_c)) value="{{ $homme_c->prénom }}" @endif placeholder="Prénom..." class="col-xs-12 col-sm-6" readonly/>
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
								<input class="col-xs-12 col-sm-6 date-picker" id="datenaissance_h" name="datenaissance_h" @if(isset($homme_c)) value="{{ $homme_c->date_naiss}}" @endif type="text" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" readonly />
								</div>
							</div>
					</div>
					<div class="col-sm-6">
							<div class="form-group ">
								<label class="col-sm-3 control-label no-padding-right" for="lien_par">
									<b>Relation :</b>
								</label>
								<div class="col-sm-5">
									<select class="form-control" id="lien_par" name="lien_par" placeholder="date de délivrance ..." readonly>
										
										@if(isset($homme_c))
										<option  value="{{ $homme_c->lien_par }}"> {{ $homme_c->lien_par }}</option>
										@else
										<option value="">Sélectionner...</option>
										@endif
										<option value="conjoint">Conjoint(e)</option>
										<option value="père">Père</option>
										<option value="mère">Mère</option>
										<option value="frère">Frère </option>
										<option value="soeur">Soeur </option>
										<option value="ascendant">Ascendant</option>
										<option value="grand_parent">Grand-parent</option>
										<option value="membre_famille">Membre de famille </option>
										<option value="ami">Ami </option>
										<option value="collegue">Collègue</option>
										<option value="employeur">Employeur</option>
										<option value="employe">Employé</option>
										<option value="tuteur">Tuteur</option>
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
										<input id="type_pieceCNI" name="type_piece" value="CNI" type="radio" class="ace" checked />
											<span class="lbl">Carte Nationale d'Identité</span>
										</label>
										<label>
											<input id="type_piecePC" name="type_piece" value="Permis" type="radio" class="ace"  />
											<span class="lbl">Permis de Conduire</span>
										</label>
										<label>
											<input id="type_pieceP" name="type_piece" value="passeport" type="radio" class="ace" />
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
								<input type="text" id="num_piece" name="num_piece" @if(isset($homme_c)) value="{{ $homme_c->num_piece }}" @endif placeholder="N° pièce..." class="col-xs-12 col-sm-6" readonly/>
							</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group ">
								<label class="col-sm-3 control-label no-padding-right" for="date_piece_id">
									<b class="text-nowrap">Délivré le :</b>
								</label>
								<div class="col-sm-9">
								<input class="col-xs-12 col-sm-6 date-picker" id="date_piece_id" name="date_piece_id" @if(isset($homme_c)) value="{{$homme_c->date_naiss}}" @endif type="text" data-date-format="yyyy-mm-dd" placeholder="date de délivrance ..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" readonly/>
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
										<textarea class="form-control" id="adresse_h" name="adresse_h" placeholder="Adresse..." readonly>@if(isset($homme_c))  {{ $homme_c->adresse }} @endif</textarea>
								</div>
							</div>
							<div class="col-sm-1">
							</div>
							<div class="col-sm-5">
								<div class="form-group col-sm-8">
									<i class="fa fa-phone"></i>
									<label for="mobile_h"><b>Tél-mob : </b></label>
									<br/>
									<input type="tel" id="mobile_h" name="mobile_h" @if(isset($homme_c)) value="{{$homme_c->mob}}" @endif placeholder="XX XX XX XX XX" autocomplete="off" maxlength="10" minlength="10"  pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"  class="col-sm-12"readonly>
									<span class="tel validity"></span>
								</div>
							</div>			
				    </div>	{{-- row --}}
					  <div class="space-12"></div>
					  <div class="space-12"></div>
					  <div class="space-12"></div>	
			 		</form>
			</div><!-- modal-body -->	<!-- onclick="addGardeMaladeFct();" -->
			<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-sm" id ="EnregistrerGardeMalade" onclick="addGardeMaladeFct();"  >
          <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
        </button>
       	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
        	<i class="ace-icon fa fa-close bigger-110"></i>Fermer
        </button>
			</div>	
		</div>
	</div>
</div>