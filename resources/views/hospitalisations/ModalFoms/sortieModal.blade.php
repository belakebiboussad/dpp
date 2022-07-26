<div id="sortieHosp" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Sortie du patient</h4>
		</div>
		<div class="modal-body">
		 	<input type="hidden" id="hospID" value="">
	 		<div class="form-group row">
    				<label for="Date_Sortie"><strong>Date de sortie :</strong></label>
   				<input type="text" id="Date_SortieH" class="form-control date-picker"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd" data-provide="datepicker" required/>
		 	
			</div>
			<div class="form-group row">
  				<label for="Heure_sortie"><strong>Heure de sortie :</strong></label>
 				<input type="text" id="Heure_sortie" class="form-control timepicker1" />
			</div>
			<div class="form-group row">
			      	<label for="resumeSortie"><strong>Résumé de sortie:</strong></label><textarea class="form-control"  id="resumeSortie"></textarea>
	   
			</div>
			<div class="form-group row">
        <label for="etatSortie"><strong>Etat a la sortie:</strong></label><textarea class="form-control"  id="etatSortie"></textarea>
			</div>
			<div class="form-group row">
                	      	<label for="modeSortie"><strong>Mode de sortie :</strong></label>
                	      	<select class="form-control" id="modeSortie">
                	      		<option value="">Domicile</option>
                				<option value="0">Transfert</option>
                				<option value="1">Contre avis médical</option>
                				<option value="2">Décès</option>
                				<option value="3">Reporter</option>
                	      	</select>
                	</div>
			<div class="form-group row hidden transfert">
	           		<label for="structure"><strong>Malade adressé à :</strong></label>
		   		<input type="text" class="form-control" id="structure" value="" placeholder="saisir structure de Transfert">
          	     </div>
	      	        <div class="form-group row hidden transfert" >
		      		<label for="motif"><strong>Motif du transfert :</strong></label>
	      	        	<input type="text" class="form-control" id="motif" value="" placeholder="motif du Transfert">
	      		</div>
			<div class="form-group  row hidden deces" >
		  		<label for="motif"><strong>Cause décès :</strong></label>
	      	        	<input type="text" class="form-control" id="cause" value="" placeholder="Cause de décès">
	      		</div>
			<div class="form-group  row  hidden deces">
					<label for="date"><strong>Date décès :</strong></label>
   					<input type="text" id="date" class="form-control date-picker"  data-date-format="yyyy-mm-dd" data-provide="datepicker" required/>
		 	</div>
			<div class="form-group row hidden deces">
  				<label for="heure"><strong>Heure décès :</strong></label>
 				<input type="text" id="heure" class="form-control timepicker" />
			</div>
			<div class="form-group row hidden deces">
				<label for="medecin"><strong>Médecin constatant décès  :</strong></label>
				<select class="form-control" id="medecin">
				@foreach($medecins as $medecin)
					<option value="{{ $medecin->id }}">{{$medecin->full_name }}</option> 
				@endforeach
				</select>
			</div>
			<div class="form-group row">
			    <label for="diagSortie"><strong>Diagnostic de sortie :</strong></label>
                            <textarea class="form-control"  id="diagSortie"></textarea>
		  </div>
		  <div class="form-group row">
       <label for="diagSortie" class="control-label">Code Cim-10 :</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search" id="ccimdiagSortie" disabled>
          <div class="input-group-btn">
            <button class="btn btn-default btn-xs CimCode" type="button" value="ccimdiagSortie">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
      </div>    </div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-info btn-xs btn-submit" id ="saveCloturerHop" data-dismiss="modal">  <i class="ace-icon fa fa-save"></i>Enregistrer</button>
	  	<button type="reset" class="btn btn-warning btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-close"></i>Annuler</button>
		</div>
	</div>
	</div>
</div>