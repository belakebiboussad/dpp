<div id="sortieHosp" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal">&times;</button>
	 		<h4 class="modal-title">Sortie Patient</h4>
	  </div>
	  <div class="modal-body">
	 		<div class="space-12"></div>
	 		<div class="row">
				<div class="col-sm-12">
      		<label for="Date_Sortie"><strong>Date de Sortie :</strong></label>
      		<input class="date-picker col-sm-8" id="Date_Sortie" name="Date_Sortie" type="text" data-date-format="yyyy-mm-dd" class="form-control" required/>
          <button class="btn btn-md filelink"  onclick="$('#Date_Sortie').focus();" >
            <i class="fa fa-calendar"></i>
          </button>
      	</div>
			</div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
					<label for="modeSortie"><strong>Mode de Sortie :</strong></label>
					<select name="modeSortie" id="modeSortie" class="form-control">
						<option value="1">Normale</option>
						<option value="2">Transfert</option>
						<option value="3">Contre avis médical</option>
						<option value="4">décès</option>
					</select>
				</div>		
			</div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
	      	<label for=""><strong>Code de Sortie :</strong></label>
	      	<input class="" id="codeSortie" name="codeSortie" type="text" onchange="" />
	        </div>
			</div>
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
	      	<label for=""><strong>Diagnostic de Sortie :</strong></label>
	      	<textarea></textarea>
	        </div>
			</div>
	 		</div>
	 	</div>
	</div>
</div>