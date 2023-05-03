<div id="antecedantModal" class="modal fade">
<div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="AntecCrudModal">Ajouter un antécédent</h4>
		</div>
		<div class="modal-body">
			<form id="modalFormAnt" method="POST">
			{!! csrf_field() !!}
				<input type="hidden" id="atcd_id" value="0">
				<div id="atcdsstypehide" class="form-group">
						<label for="sstypeatcd" class="col-sm-2 control-label">Type:</label>
						<div class="col-sm-10">
							<select class="form-control" id="sstypeatcdc">
								<option value="">Selectionnez....</option>
								<option value="Medicaux" >Médicaux</option>
								<option value="Chirurigicaux">Chirurigicaux</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="dateatcd" class="col-sm-2 control-label" >Date :</label>
						<div class="col-sm-10">
							<input type="text" id="dateAntcd" class="form-control date-picker gdob ltnow" data-date-format="yyyy-mm-dd" data-provide="datepicker" autocomplete="off" required />
						</div>
					</div>
					<div class="form-group">
			    	<label class="col-sm-2 control-label" for="codecim">Code(Cim10) :</label>
						<div class="col-sm-10 input-group">
							<input type="text" class="form-control" id="cim_code" disabled/>
							 <button class="btn btn-xs CimCode" value="cim_code">
               <span class="input-group-addon fa fa-search" style=" padding: 0px 6px;">
		          </span>
              </button>
					   </div>		
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description :</label>
						<div class="col-sm-10"><textarea class="form-control" id="description" required=""></textarea></div>
					</div>
				</form>
			</div><!-- modal-body -->
			<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-sm btn-submit" id ="EnregistrerAntecedant" value="add" data-atcd="Perso">
          <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
        </button>
       	<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal">
        	<i class="ace-icon fa fa-close bigger-110"></i>Fermer
        </button>
			</div>
		</div>
	</div>
</div>