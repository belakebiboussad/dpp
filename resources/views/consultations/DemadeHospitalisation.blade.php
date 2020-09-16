<div id="demandehosp" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">	<!-- Modal content-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Demande d'hospitalisation </h4>
			</div>
			<div class="modal-body">
			  <form action="#" method="POST">
			    <div class="row">
			      <div class="col-xs-12">
			     	  <br><label for="modeAdmissionHospi"><strong>Mode Admission  :</strong></label>
				      <select class="form-control" id="modeAdmissionHospi" name="modeAdmissionHospi">
				       	<option value="">Sélectionner...</option>
				        @foreach($modesAdmission as $mode =>$value)
				       	<option value="{{ $mode}}">{{ $value }}</option>
				       	@endforeach
				      </select>
				    </div>
			    </div>{{-- row --}}
			    <div class="space-12"></div>
        	<div class="row">
			     	<div class="col-xs-12">
			     		<label for="specialiteHospi"><strong>Specialite:</strong></label>
					   	<select class="form-control" id="specialiteHospi" name="specialiteHospi">
						    <option value="0">Sélectionner la spécialité...</option>
						    @foreach($specialites as $specialite)
						   	<option value="{{ $specialite->id}}">{{$specialite->nom}}</option>
						    @endforeach 
						  </select>
						  <br>
			      </div>		
			    </div>{{-- row --}}
			    <div class="spcae-12"></div>
			    <div class="row">
			     	<div class="col-xs-12">
			     	 	<label for="serviceHospi"><b>Service:</b></label>
					    <select class="form-control" id="serviceHospi" name="serviceHospi">
							  <option value="">Sélectionner le service...</option>
							  @foreach($services as $service)
							  <option value="{{ $service->id }}">{{ $service->nom }}</option>
							  @endforeach     
							</select>
			      </div>	
			    </div>
			  </form>
			</div>{{-- modal-body --}}
			<div class="space-12"></div><div class="space-12"></div><div class="space-12"></div>
		  <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="demandehosp()">
          <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
        </button>
       	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
        	<i class="ace-icon fa fa-close bigger-110"></i>Fermer
        </button>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}
		