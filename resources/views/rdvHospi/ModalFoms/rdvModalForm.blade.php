<div id="rdvHModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div  id="" class="modal-content custom-height-modal">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title"><i class="fa fa-clock-o 2x" aria-hidden="true"></i>&nbsp; Ajouter un Rendez-Vous</h4>
			</div>
			<div class="modal-body">
			<form id="modalFormData" name="modalFormData" method="POST" action ="" class="form-horizontal" novalidate="">
				{!! csrf_field() !!}
			  <input type="hidden" id="demande_id" name="demande_id" value="">
			  <input type="text" id="affect" value="1" hidden>
				<div class="row">
			    <div class="col-xs-12">
			     	<label for="dateEntree"><strong>Date entrée:</strong></label>
			      <div class="input-group">
			     	  <input type="text" name ="dateEntree" class="date-picker form-control"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd"
			     	   autocomplete ="off" required>
					    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
					  </div>
				  </div>
			  </div><div class="space-12"></div>
			  <div class="row">
			    <div class="col-xs-12">
			    	<label for="heure_rdvh"><strong>Heure entrée :</strong></label>
			    	<div class="input-group">
			    		<input type="text" name ="heure_rdvh" class="form-control timepicker" required>
					 		<div class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></div>
					 	</div>	
			   	</div>
			  </div><div class="space-12"></div>
			  <div class="row">
			   	<div class="col-xs-12">
			   	  <label for="numberDays"><strong>Durée :</strong></label>
			    	<div class="input-group">
			    		<input id="numberDays" min="0" max="50" value="0" class="form-control" type="number" required>
							<span class="input-group-addon">nuit(s)</span>   		
						</div>
			  	</div>
			  </div><div class="space-12"></div>
			  <div class="row">
			   	<div class="col-xs-12">
			   		<label for="dateSortiePre"><strong>Date sortie :</strong></label>
			   		<div class="input-group">
			     	  <input type="text" name ="dateSortiePre" id="dateSortiePre" class="date-picker form-control"  data-date-format="yyyy-mm-dd"
			     	   value="<?= date("Y-m-j") ?>" autocomplete ="off" required>
					    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
					  </div>
			  	</div>
			  </div>
			  <div class="space-12"></div>
			    <div class="row">
			    	<div class="col-xs-12 center bottom">
			    		<button class="btn btn-info btn-xs btn-submit" id='AffectSave' disabled><i class="ace-icon fa fa-save bigger-110" ></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
							<button class="btn btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			    	</div>
			    </div>
			  </form>
      </div>
		</div>
	</div>
</div>