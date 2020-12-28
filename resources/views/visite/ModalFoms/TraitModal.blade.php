<div id="traitModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<div  id="" class="modal-content custom-height-modal">
					<div class="modal-header">
			  			<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un Traitement Médicale</h4>
			  		</div>
					<div class="modal-body">
				    <form id="addTrait" method="POST" action ="{{route('traitement.store')}}" name="form1" id="form1">	<!-- /Acte/save -->
				 		{{ csrf_field() }}
				 		<input type="hidden" name="id_visite" id ="id_visite" value="{{ $id }}">
				 		<input type="hidden" value="" name="idhosp">
				 		<input type="hidden" value="" id ="trait_id" name="trait_id">
				 		<div class="space-12"></div>
			 			<div class="row">
					 		<div class="col-sm-3">
					 	    <label for="" class="control-label no-padding-right"><b>Specialité :</b></label>
					 		</div>
					 		<div class="col-sm-7">
								<select type="text" id="specialiteProd" name="specialiteProd" data-placeholder="selectionnez la Specialite de Produit" class="selectpicker show-menu-arrow place_holde form-control col-sm-6" required />
								  <option value="0" selected>Sélectionner...</option>
								  @foreach($specialitesProd as $specialite)
									 <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
									 @endforeach
								</select>
							</div>	
					 	</div>
					 	<div class="space-12"></div>
			 			<div class="row">
			 				<div class="form-group">
								<label for=""class="col-sm-3 control-label no-padding-right"><b>Médicament:</b></label>
								<div class="col-sm-7">
									<select type="text" name="produit" id="produit" data-placeholder="selectionnez le Médicament" class="selectpicker show-menu-arrow place_holde form-control col-sm-6" disabled>
									</select>
								</div>
							</div>
				 		</div>
					 		<div class="space-12"></div>
					 		<div class="row">
					 			<div class="col-sm-3">
					 		    <label for="" class="control-label no-padding-right"><b>Posologie :</b></label>
					 			</div>
					 			<div class="col-sm-7">
					 					<input type="text" id="posologie" name="posologie" class="form-control col-sm-6" placeholder = "posologie de Traitement" />
								</div>	
					 		</div>
					 		<div class="space-12"></div>
							<div class="row">
					 		  <div class="col-sm-3">
					 		    <label for="" class="control-label no-padding-right"><b>Periodes:</b></label>
					 			</div>
						 		<div class="col-sm-3">
						 			<label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="Matin" value="Matin" checked><b>Matin</b></label>
						 		</div>	
						 		<div class="col-sm-3">	
									<label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="Midi" value="Midi"><b>Midi</b></label>
								</div>
								<div class="col-sm-3">
									<label class="checkbox-inline ace"><input type="checkbox" name="pT[]" id="Soir" value="Soir"><b>Soir</b></label>
								</div>
							</div>
					 		<div class="space-12"></div>
					 		<div class="row">
					 		  	<div class="col-sm-3"><label for="" class="control-label no-padding-right"><b>Pendant :</b></label></div>
								<div class="col-sm-7"><input type="number" id="dureeT" name="dureeT" class="form-control col-sm-6" min="1" value="1" />	</div>	
								<div class="col-sm-2"><label class="" for="col-sm-3">jour</label></div>
							</div>
					 		<div class="space-12"></div>
					 		<hr>
					 		<div class="row" align="right">
					 			<button type="submit" id="EnregistrerTrait" class="btn btn-primary btn-xs" value ="add">
             							<i class="ace-icon fa fa-save bigger-110"></i>&nbsp;&nbsp;Enregistrer
             						</button>
             		<button type="button" class="btn btn-default btn-xs" data-dismiss="modal">
        					<i class="ace-icon fa fa-close bigger-110"></i>Fermer
        				</button>
					 		</div>
					  </form>
					</div>
				</div>
			</div>
		</div>