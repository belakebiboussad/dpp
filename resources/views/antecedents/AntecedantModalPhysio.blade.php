<div id="antecedantPhysioModal" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
   	<div  id="" class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" id="AntecPhysCrudModal">Ajouter un Antecedant</h4>
		</div>
		<div class="modal-body">
			<form id="modalFormDataPhysio" method="POST" action ="" class="form-horizontal" novalidate="">
			{!! csrf_field() !!}
				<input type="hidden" id="atcdPhys_id" value="0"><!-- <input type="hidden" id="typeAntecedantPhys" value="Physiologiques"> -->
				<div id="PhysiologieANTC"  class="form-group">
					<label for="habitudeAlim" class="col-sm-2 control-label">Habitudes Alimentaires:</label>
					<div class="col-sm-10">
						<input type="text" id="habitudeAlim" class="form-control"/><br>
						<label><input type="checkbox" class="ace" id="tabac"/>	<span class="lbl" >&nbsp; &nbsp;tabac</span></label>&nbsp; &nbsp; &nbsp;
				          <label><input type="checkbox" class="ace" id="ethylisme"/><span class="lbl"> &nbsp; &nbsp;ethylisme</span></label>
				     </div>
				</div>
				<div class="form-group">
					<label for="dateatcd" class="col-sm-2 control-label" >Date :</label>
					<div class="col-sm-10">
						<input type="text" id="dateAntcdPhys" class="form-control date-picker" data-date-format="yyyy-mm-dd" data-provide="datepicker" required />
					</div>
				</div>
				<div class="form-group">
		    	<label class="col-sm-2 control-label" for="codecim"><strong>Code Cim10 :</strong></label>
					<div class="col-sm-10 input-group">
						<input type="text" class="form-control" id="phys_cim_code"/><span class="input-group-addon" style=" padding: 0px 6px;">  {{--  --}}
						<button class="btn btn-xs CimCode" type="button" value="phys_cim_code"><i class="fa fa-search"></i></button>
					  </span>
				  </div>		
				</div>
				<div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description :</label>
					<div class="col-sm-10"><textarea class="form-control" id="descriptionPhys" required=""></textarea></div>
				</div><div class="space-12"></div>
				</form>
			</div><!-- modal-body -->
			<br>
			<br>
			<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-sm btn-submit" id ="EnregistrerAntecedantPhys" value="add" data-atcd="Perso">
		          <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
		        </button>
		       		<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer
		        </button>
			</div>
		</div>
	</div>
</div>