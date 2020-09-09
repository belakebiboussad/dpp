<div id="sortieHosp" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal">&times;</button>
	 		<h4 class="modal-title">Sortie Patient</h4>
	  </div>
	  <div class="modal-body">
	  	<input type="hidden" id="hospID" value="">
	 		<div class="space-12"></div>
	 		<div class="row">
				<div class="col-sm-12">
      		<label for="Date_Sortie"><strong>Date de Sortie :</strong></label>
     			<input type="text" name="Date_Sortie" id="Date_Sortie" class="form-control date-picker"  data-date-format="yyyy-mm-dd" data-provide="datepicker" required/>
			 	</div>
			</div>
			<div class="space-12"></div>
	 		<div class="row">
				<div class="col-sm-12">
      		<label for="Date_Sortie"><strong>Heure de Sortie :</strong></label>
     			<input type="text" name="Heure_sortie" id="Heure_sortie" class="form-control timepicker" />
			 	</div>
			</div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
	      		<label for="modeSortie"><strong>Mode de Sortie :</strong></label>
	      		<select class="form-control" id="modeSortie" name="modeSortie">
	      			<option value="1">Normale</option>
							<option value="2">Transfert</option>
							<option value="3">Contre avis médical</option>
							<option value="4">décès</option>
							<option value="5">Reporter</option>
	      		</select>
	      	</div>
				</div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
	      	<label for="codeSortie"><strong>Code de Sortie :</strong></label>
	      	<input class="form-control" id="codeSortie" name="codeSortie" type="text" onchange="" />
	      	<span class="input-group-addon">
						<i class="fa fa-clock-o bigger-110"></i>
					</span>	
	      </div>
			</div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
	      	<label for="diagSortie"><strong>Diagnostic de Sortie :</strong></label>
	      	<textarea class="form-control"  id="diagSortie" name="diagSortie"></textarea>
	        </div>
			</div>
	 	</div>
	 	<div class="space-12"></div>
	 	<div class="modal-footer">
			<button type="submit" class="btn btn-info btn-sm btn-submit" id ="saveCloturerHop" value="add" data-atcd="Perso">  <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
		  <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
		</div>
	</div>
	</div>
</div>