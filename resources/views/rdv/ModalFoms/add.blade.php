<div class="modal fade" id="addRDVModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<div class="modal-content">
       <div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal">&times;</button>
    		<h4 class="modal-title">Ajouter un rendez-vous</h4>   
  	</div>
  	<form  id ="addRdv" role="form" class="form-horizontal"> 
	      <div class="modal-body"> {{-- csrf_field() --}}
       		<input type="hidden" id="date"><input type="hidden" id="fin">
          <input type="hidden" id="fixe"><input type="hidden" id="pat_id">
           	@if(Auth::user()->role_id == 2)
					 <div class="panel panel-default">
		 			    <div class="panel-heading"><i class="ace-icon fa  fa-user-md bigger-110"></i><span>Selectionner une spécialité</span></div>
             		<div class="panel-body">
		         		<div class="row">
				         	<div class="col-sm-12">
			           		<div class="form-group">
					          	<label class="col-form-label" for=""><strong>Spécialité :</strong></label>
					          	 {{-- onchange="getMedecinsSpecialite($(this).val());" --}}
		                		<select class="form-control" id="specialite" required>
	                       	<option value="" selected disabled> Selectionner...</option>
	                       	@foreach($specialites as $specialite)
	                     		<option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
	                     		 @endforeach
	                      </select>
				         		</div>
			           	</div>{{--<div class="col-sm-6"><div class="form-group"><label class="col-form-label"><strong>Médecin: </strong></label><select class="form-control" id="medecin" name ="medecin" disabled></select></div></div>--}}
			          </div>
			        </div>
	          </div>
	          @endif
	          <div class="panel panel-default">
          		<div class="panel-heading"><i class="ace-icon fa fa-user"></i><span>Selectionner un patient</span></div>
	          	<div class="panel-body">	
	          		<div class="row">
			          	<div class="col-sm-4">
				          	<div class="form-group">
		          		  	<label class="col-form-label" for="filtre"> <strong>Filtre : </strong></label> <!-- onchange="layout();"  -->
		          		  	<select class="form-control" id="filtre" @if(isset($patient->id)|| (Auth::user()->role_id == 2 )) disabled @endif> 
		                 		<option value="" selected disabled="">Selectionner...	</option>
		                 		<option value="Nom">Nom</option>
		                  	<option value="Prenom">Prenom</option>
		                  	<option value="IPP">IPP</option>
		                  </select>
				          	</div>
			          	</div><div class="col-sm-1"></div>
			          	<div class="col-sm-7">
			          		<div class="form-group">
			          			<label class="col-form-label" for="patient"> <strong>&nbsp; </strong></label>
			          			<select class="form-control" id="patient" required disabled><!-- @if(isset($patient->id) || (Auth::user()->role_id == 2 )) disabled @endif -->
                        @if(isset($patient))
                          <option value="{{$patient->id}}" selected>{{ $patient->IPP }}-{{ $patient->Nom }}-{{ $patient->Prenom }}</option>
                        @endif
                     	</select>
                    </div>
			          	</div>
		          	</div>
		          </div>
		        </div>
	        </div><!-- modal-body -->
	        <div class="modal-footer">
		      	<button  class="btn btn-success" type="button" id ="btnSave"  data-dismiss="modal" disabled><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>    
			 			<button type="button" class="btn btn-default" data-dismiss="modal" onclick="reset_in();"><i class="fa fa-close" aria-hidden="true"></i>&nbsp;Annuler</button>
		      </div>
      	</form>
  		</div>
  </div><!-- modal-dialog -->
 </div>