<div id="sortieHosp" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div  id="" class="modal-content custom-height-modal">
		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Sortie Patient</h4>
		</div>
		  <div class="modal-body">
		  	<input type="hidden" id="hospID" value="">
	 		<div class="space-12"></div><div class="space-12"></div>
	 		<div class="row">
				<div class="col-sm-12">
    					<label for="Date_Sortie"><strong>Date de Sortie :</strong></label>
   					<input type="text" id="Date_SortieH" class="form-control date-picker"  data-date-format="yyyy-mm-dd" data-provide="datepicker" required/>
		 		</div>
			</div><div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
  						<label for="Date_Sortie"><strong>Heure de Sortie :</strong></label>
 						<input type="text" id="Heure_sortie" class="form-control timepicker" />
	 			</div>
			</div><div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
	      			<label for="remumeSortie"><strong>Résumé de sortie:</strong></label><textarea class="form-control"  id="remumeSortie"></textarea>
	      		</div>
			</div><div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
	      			<label for="etatSortie"><strong>Etat a la sortie:</strong></label><textarea class="form-control"  id="etatSortie"></textarea>
	      		</div>
			</div><div class="space-12"></div>  
			<div class="row">
				<div class="col-sm-12">
	      		<label for="modeSortie"><strong>Mode de Sortie :</strong></label>
	      		<select class="form-control" id="modeSortie">
	      			<option value="">Domicile</option>
					<option value="0">Transfert</option>
					<option value="1">Contre avis médical</option>
					<option value="2">Décès</option>
					<option value="3">Reporter</option>
	      		</select>
	      	</div>
			</div>	<div class="space-12"></div>
			<div class="row hidden" id="structure">
				<div class="col-sm-12">
	      		<label for="strucTransfert"><strong>Malade adresé à :</strong></label>
	      		<input type="text" class="form-control" id="strucTransfert" value="" placeholder="saisir l'Hôptital de Transfert">
	      	</div>
			</div><div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
			      	<label for="diagSortie"><strong>Diagnostic de Sortie :</strong></label><textarea class="form-control"  id="diagSortie"></textarea>
			     </div>
		  	</div>	<div class="space-12"></div>
		  	<div class="row">
				<div class="col-sm-12">
			      	<label for="diagSortie"><strong>Code Cim10 :</strong></label>
			      	<div class="input-group">
					    <input type="text" class="form-control" id="ccimdiagSortie"/>
					     <span class="input-group-addon" style=" padding: 0px 6px;"> 
					      <button class="btn btn-xs CimCode" type="button" value="ccimdiagSortie">
            			<i class="fa fa-search"></i>
        				</button>
					    </span>
			    	</div>
			     </div>
		  	</div>	<div class="space-12"></div>
		 	<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-sm btn-submit" id ="saveCloturerHop" data-dismiss="modal">  <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
	  			<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
			</div>
		</div>
		</div>
	</div>
</div>