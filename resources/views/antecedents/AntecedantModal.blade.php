<div id="antecedantModal" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
   	<div  id="" class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" id="AntecCrudModal">Ajouter un Antecedants</h4>
		</div>
		<div class="modal-body">
			<form id="modalFormData" method="POST" action ="" class="form-horizontal" novalidate="">
			{!! csrf_field() !!}
				<input type="hidden" id="atcd_id" value="0">
				<div id="atcdsstypehide" class="form-group">
						<label for="sstypeatcd" class="col-sm-2 control-label">Type:</label>
						<div class="col-sm-10">
							<select class="form-control" id="sstypeatcdc" onchange="resetField();">
								<option value="">Choisir...</option>
								<option value="Medicaux" >Médicaux</option>
								<option value="Chirurigicaux">Chirurigicaux</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="dateatcd" class="col-sm-2 control-label" >Date :</label>
						<div class="col-sm-10">
							<input type="text" id="dateAntcd" class="form-control date-picker" data-date-format="yyyy-mm-dd" data-provide="datepicker" required />
						</div>
					</div>
					<div class="form-group">
			    			<label class="col-sm-2 control-label" for="codecim"><strong>Code Cim10 :</strong></label>
						<div class="col-sm-10 input-group">
							<input type="text" class="form-control" id="cim_code"/><span class="input-group-addon" style=" padding: 0px 6px;"> 
							<button class="btn btn-xs CimCode" type="button" value="cim_code">{{-- data-toggle="modal" data-target="#cim10Modal": --}}
		            					<i class="fa fa-search"></i>
		        				</button>
							    </span>
					    	</div>		
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description :</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="description" required=""></textarea>
						</div>
					</div><div class="space-12"></div>
				</form>
			</div><!-- modal-body -->
			<br>
			<br>
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