<div id="bedAffectModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div  id="" class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title"><i class="fa fa-bed fa-2x" aria-hidden="true"></i>&nbsp; Affecter un lit</h4>
		</div>
		<div class="modal-body">
		<form id="modalFormData" name="modalFormData" method="POST" action ="" class="form-horizontal" novalidate="">
			{!! csrf_field() !!}
			  <input type="hidden" class="demande_id" name="demande_id">
		    <input type="hidden" id="patient_id" name="patient_id">
			 <input type="hidden" class="affect" value="1" >
			<div class="row">
	  	 	<div class="col-xs-12">
		     	<label for="service"><strong>Service:</strong></label>
		         <select class="form-control serviceHosp" name="serviceh">
		       	<option value="">Sélectionner...</option>
		        @foreach($services as $mode =>$service)
		       	<option value="{{ $service->id }}">{{ $service->nom }}</option>
		       	@endforeach
		      </select>
				</div>
			 </div><div class="space-12"></div>
			    <div class="row">
			    	<div class="col-xs-12">
			    		<label for="salle"><strong>Salle:</strong></label>
			    		<select class="form-control salle" name="salle" disabled>
			    		</select>
			    	</div>
			    </div>
			<div class="space-12"></div>
			    <div class="row">
			    	<div class="col-xs-12">
			    		<label for="lit_id"><strong>Lit :</strong></label>
			    		<select class="form-control lit_id"  name="lit_id" id ="lit_id" disabled>
			    		</select>
			    	</div>
			    </div>
			    <div class="space-12"></div>
			    <div class="row">
			    	<div class="col-xs-12 center bottom">
			    	<button class="btn btn-info btn-xs btn-submit" id='AffectSave' disabled><i class="ace-icon fa fa-save bigger-110" ></i>Enregistrer</button>&nbsp; &nbsp;<button class="btn btn-xs" data-dismiss="modal" >
				<i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			    	</div>
			    </div>
			  </form>
      </div>
		</div>
	</div>
</div>