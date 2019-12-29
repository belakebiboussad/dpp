<div id="antecedantModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<!-- Modal content-->
	 	<div  id="antecedantModal" class="modal-content custom-height-modal">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Ajouter un Antecedant</h4>
			  @include('patient._patientInfo')
			</div>
			<div class="modal-body">
				<form id="modalFormData" name="modalFormData" method="POST" action ="" class="form-horizontal" novalidate="">
					{!! csrf_field() !!}
					<input type="hidden" name="patientId" id ="patientId" value="{{ $patient->id }}">
					 <input type="hidden" id="atcd_id" name="atcd_id" value="0">
					<div class="form-group">
            <label for="inputAntecedant" class="col-sm-2 control-label">Antécédant:</label>
            <div class="col-sm-10">
                <select class="form-control" id="Antecedant" name="Antecedant" onchange="atcd();"   placeholder="Enter URL" required>
                <option value="null" selected>Choisir...</option>
									<option value="Personnels">Personnels</option>
									<option value="Familiaux" selected>Familiaux</option>
								</select>
            </div>
          </div>
          <div id="sous_type" class="form-group" hidden="true">
          	<div class="col-sm-2"></div>
          	<div class="col-sm-10">
          		<select class="form-control" id="typeAntecedant" name="typeAntecedant" onchange="atcdhide()">
								<option value="null" selected>Choisir...</option>
								<option value="Physiologiques">Physiologiques</option>
								<option value="Pathologiques">Pathologiques</option>
							</select>
          	</div>		
					</div>
					<div id="atcdsstypehide" class="form-group" hidden="true">
						<label for="sstypeatcd" class="col-sm-2 control-label">Type:</label>
						<div class="col-sm-10">
							<select class="form-control" id="sstypeatcdc" name="sstypeatcdc" onchange="resetField();">
								<option value="null">Choisir...</option>
								<option value="Medicaux" >Médicaux</option>
								<option value="Chirurigicaux">Chirurigicaux</option>
							</select>
						</div>
					</div>
					<div id="PhysiologieANTC" hidden="true" class="form-group" >
						<label for="habitudeAlim" class="col-sm-2 control-label">Habitude Alimentaire:</label>
						<div class="col-sm-10">
							<input type="text" name="habitudeAlim" class="form-control" id="habitudeAlim"/><br>
							<label>
	            	<input type="checkbox" class="ace"  id="tabac" name="tabac"/>
	            	<span class="lbl" >&nbsp; &nbsp;tabac</span>
	        		</label>&nbsp; &nbsp; &nbsp;
	        		<label>
	            			<input type="checkbox" class="ace" id="ethylisme" name=""/>
	            			<span class="lbl"> &nbsp; &nbsp;ethylisme</span>
	        		</label>
						</div>
					</div>
					<div class="form-group">
							<label for="dateatcd" class="col-sm-2 control-label" >Date :</label>
							<div class="col-sm-10">
								<input type="text" name="dateAntcd" class="form-control date-picker" id="dateAntcd"  data-date-format="yyyy-mm-dd" data-provide="datepicker" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required />
							</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description :</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="description" name="description" required></textarea>
						</div>
					</div>
					<div class="space-12"></div>
				
				</form>
			</div><!-- modal-body -->
			<br>
			<br>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-sm btn-submit" id ="EnregistrerAntecedant" value="add">
          <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
       	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
        	<i class="ace-icon fa fa-close bigger-110"></i>Fermer
        </button>
			</div>
		</div>
	</div>
</div>