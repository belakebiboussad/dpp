<div id="rdvHModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div  id="" class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title"><i class="fa fa-clock-o 2x" aria-hidden="true"></i>&nbsp; Ajouter un Rendez-Vous</h4>
			</div>
			<div class="modal-body">
			<form id"rdvHAddForm" method="POST"  class="form-horizontal"  action="{{  route('rdvHospi.store') }}">
				{!! csrf_field() !!}
			       <input type="hidden" name="demande_id" id="demande_id"  class="demande_id">
			      <input type="hidden"  class="affect" value="0">
				  <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Admissions</h3></div></div>
				<div class="row">
			       <div class="col-xs-12">
			     	<label for="dateEntree"><strong>Date entrée:</strong></label>
			      <div class="input-group">
			     	  <input type="text" name ="dateEntree" id ="dateEntree" class="date-picker form-control" data-date-format="yyyy-mm-dd"
			     	   autocomplete ="off" required>
					    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
					  </div>
				  </div>
			  </div>
			  <div class="row">
			    <div class="col-xs-12">
			    	<label for="heure"><strong>Heure entrée :</strong></label>
			    	<div class="input-group">
			    		<input type="text" name ="heure" id ="heure" class="form-control timepicker1"  required>
					 <div class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></div>
				</div>	
			   	</div>
			  </div>
			  <div class="row">
			   	<div class="col-xs-12">
			   	  <label for="numberDays"><strong>Durée :</strong></label>
			    	<div class="input-group">
			    		<input id="numberDays" min="0" max="50" value="0" class="form-control" type="number" required>
							<span class="input-group-addon">nuit(s)</span>   		
						</div>
			  	</div>
			 </div>
			 <div class="row">
			   	<div class="col-xs-12">
			   		<label for="dateSortiePre"><strong>Date sortie :</strong></label>
			   		<div class="input-group">
			     	  <input type="text" name ="dateSortiePre" id="dateSortiePre" class="date-picker form-control"  data-date-format="yyyy-mm-dd" autocomplete ="off" onchange="updateDureePrevue()" required>
					    <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
					  </div>
			  	</div>
			 </div>
			  <div class="row">
			    	<div class="col-xs-12">
			    	        <label for="heureSortiePrevue"><strong>Heure sortie :</strong></label>
			    		<div class="input-group">
			    			<input type="text" name ="heureSortiePrevue" id ="heureSortiePrevue" class="form-control timepicker1"  required>
					 	<div class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></div>
					</div>	
			      	</div>
			  </div>
		  	<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Hébergement</h3></div></div>
		  	<div class="row ">
				<div class="col-sm-12 col-xs-12">
				  	<label class=" control-label no-padding-right" for="serviceh"><strong> Service :</strong></label>
					<div class="input-group col-xs-12 col-sm-12">
					 	<select  class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12 serviceHosp"/>
							 <option value="0" selected  disabled>Selectionnez un service</option>
							  @foreach($services as $service)
								<option value="{{ $service->id }}">{{ $service->nom }}</option>
								@endforeach
						</select>
					  </div>
				  </div>
			</div>
			<div class="row ">
				<div class="col-sm-12 col-xs-12">
				  	<label class=" control-label no-padding-right" for="salle"><strong>Salle :</strong></label>
					<div class="input-group col-xs-12 col-sm-12">
					 	<select  class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12 salle" disabled/>
							 <option value="0" selected>Selectionnez une salle</option>
						</select>
					  </div>
				  </div>
			</div>
			<div class="row ">
				<div class="col-sm-12 col-xs-12">
				  	<label class=" control-label no-padding-right" for="lit_id"><strong>Lit :</strong></label>
					<div class="input-group col-xs-12 col-sm-12">
					 	<select name="lit" class="selectpicker show-menu-arrow place_holder col-xs-12 col-sm-12 lit_id" disabled/>
							<option value="" selected disabled>Selectionnez un lit</option>
						</select>
					  </div>
				  </div>
			</div>
			  <div class="space-12"></div>
			    <div class="row">
			    	<div class="col-xs-12 center bottom">
			    		<button class="btn btn-info btn-xs btn-submit"><i class="ace-icon fa fa-save bigger-110" ></i>Enregistrer</button>&nbsp; &nbsp; 
					<button class="btn btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			    	</div>
			    </div>
			  </form>
      </div>
		</div>
	</div>
</div>