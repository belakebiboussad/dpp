<div class="modal fade" id="addRDVModal" tabindex="-1" role="dialog" aria-hidden="true">
  	<div class="modal-dialog" role="document">
   		<div class="modal-content">
        <div class="modal-header">
      		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		<h4 class="modal-title">Ajouter un rendez-vous</h4>   
    		</div>
      	<form  id ="addRdv" role="form" action="/createRDV" method="POST">
		      <div class="modal-body">
				   {{ csrf_field() }}
			          <input type="hidden" id="Debut_RDV" name="Debut_RDV" value="">
			          <input type="hidden" id="Fin_RDV" name="Fin_RDV"  value="" >
			          <input type="hidden" id="fixe" name="fixe"  value="" >
			          <div class="panel panel-default">
                			<div class="panel-heading"><i class="ace-icon fa fa-user"></i><span>Selectionner un Patient</span></div>
				          <div class="row">
					          <div class="col-sm-6">
					          <div class="form-group">
			          		  <label class="col-form-label" for=""> <strong>Filtre : </strong></label>
                        <select class="form-control" id="filtre" onchange="layout();"  {{ isset($patient->id) ? 'disabled' : '' }} ">
                       		<option value="Nom">Nom</option>
                        	<option value="Prenom">Prenom</option>
                        	<option value="IPP">IPP</option>
                        </select>
					          </div>
					          </div>
					          <div class="col-sm-6">
						          <div class="form-group">
						          		<label class="col-form-label" for=""> <strong>&nbsp; </strong></label>
						          		<select class="form-control" id="patient" name ="patient" required>{{-- nav-search-input --}}
		                          @if(isset($patient))
		                            <option value="{{$patient->id}}" selected>{{ $patient->IPP }}-{{ $patient->Nom }}-{{ $patient->Prenom }}</option>
		                          @endif
	                         </select>
	                         </span>
						          </div>
					          </div>
					    </div>
			        </div>
			        @if(Auth::user()->role_id == 2)
			          <div class="panel panel-default">
			           	<div class="panel-heading"><i class="ace-icon fa  fa-user-md bigger-110"></i><span>Selectionner un médecin</span></div>
               		<div class="panel-body">
			           	<div class="row">
			           	<div class="col-sm-6">
			           		<div class="form-group">
					          	<label class="col-form-label" for=""> <strong>Spécialité :</strong></label>
			                <select class="form-control" id="specialite" name="specialite" onchange="getMedecinsSpecialite($(this).val());" required>
                       	<option value="" selected disabled> Selectionner</option>}
                       	option
                       	@foreach($specialites as $specialite)
                     		<option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
                      @endforeach
                      </select>
				         		</div>
			           	</div>
			           	<div class="col-sm-6">
			           		<div class="form-group">
					          	<label class="col-form-label" for=""> <strong>Médecin: </strong></label>
			                <select class="form-control" id="medecin" name ="medecin" disabled ></select>
				         		</div>
			           	</div>
			           </div>
			           </div>
			           </div>
			           @endif
			</div>
		      <div class="modal-footer">
		      <button  class="btn btn-warning" type="submit" id ="btnSave" disabled><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>    
			 <button type="button" class="btn btn-default" data-dismiss="modal" onclick="reset_in();"><i class="fa fa-close" aria-hidden="true"></i>&nbsp;Annuler</button>
		      </div>
		</form>
    		</div>
  	</div>
</div>