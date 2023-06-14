<div id="demandehosp" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Ajouter une demande d'hospitalisation </h4></div>
			<div class="modal-body">
			  <form action="#" method="POST">
        <input type="hidden" id="dh_id" value="">
			  <div class="form-group">
			    <label class="control-label" for="modeAdmissionHospi">Mode d'admission</label>
	    	  <select class="form-control" id="modeAdmissionHospi">
		       	<option value="" selected disabled>Sélectionner...</option>
		        @foreach($modesAdmission as $mode =>$value)
		       	<option value="{{ $value}}">{{ $mode }}</option>
		       	@endforeach
		      </select>
				</div>
      	<div class="form-group">
	     		<label class="control-label" for="specialiteHospi">Spécialité</label>
			   	<select class="form-control" id="specialiteHospi">
				    @foreach($specialites as $specialite)
				   	<option value="{{ $specialite->id}}" @if( Auth::user()->employ->specialite == $specialite->id) selected @endif > {{$specialite->nom}} </option>
				    @endforeach 
				  </select>
			  </div>		
			  <div class="form-group">
	     	 	<label class="control-label" for="serviceHospi">Service</label>
			    <select class="form-control" id="serviceHospi">
					  @foreach($services as $service)
					  <option value="{{ $service->id }}" @if( Auth::user()->employ->service_id == $service->id) selected @endif>{{ $service->nom }}</option>
					  @endforeach     
					</select>
	       </div>	
			  </form>
			</div>
		  <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" id="DHospadd"  data-dismiss="modal" value="add"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer </button>
        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}