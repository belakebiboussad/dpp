   	<div id="acteModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<div  id="" class="modal-content custom-height-modal">
					<div class="modal-header">
			  		<button type="button" class="close" data-dismiss="modal">&times;</button>
			  		<h4 class="modal-title">Ajouter un Acte Médicale</h4>
			  		@include('patient._patientInfo')
					</div>
					<div class="modal-body">
					<!-- /Acte/save -->
					  <form id="addActe" method="POST" action ="/saveActe" name="form1" id="form1">
					 		{{ csrf_field() }}
					 		<input type="hidden" name="visiteId" id ="visiteId" value="{{ $id }}">
					 		{{-- <input type="hidden" value="{{$id_hosp}}" name="idhosp"> --}}
					 		<div class="space-12"></div>
					 		<div class="row">
					 				<div class="form-group">
										<label for=""class="col-sm-3 control-label no-padding-right"><b>Acte	 :</b></label>
										<div class="col-sm-7">
											<input name="cons" id="cons" class="form-control" required>
										</div>
									</div>
					 			
					 		</div>
					 		<div class="space-12"></div>
							<div class="row">
					 		  <div class="col-sm-3">
					 		    <label for="" class="control-label no-padding-right"><b>Periodes:</b></label>
					 			</div>
						 		<div class="col-sm-3">
						 			<label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Matin" value="Matin" checked><b>Matin</b></label>
						 		</div>	
						 		<div class="col-sm-3">	
									<label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Midi" value="Midi"><b>Midi</b></label>
								</div>
								<div class="col-sm-3">
									<label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Soir" value="Soir"><b>Soir</b></label>
								</div>
							</div>
					 		<div class="space-12"></div>
					 		<div class="row">
					 			<div class="col-sm-3">
					 		    <label for="" class="control-label no-padding-right"><b>description :</b></label>
					 			</div>
					 			<div class="col-sm-7">
									<input type="text" id="description" name="description" class="form-control col-sm-6" placeholder = "applcation de l'acte" />
								</div>
					 		</div>
					 		<div class="space-12"></div>
					 		<div class="row">
					 		  <div class="col-sm-3">
					 		    <label for="" class="control-label no-padding-right"><b>Pendant :</b></label>
					 			</div>
								<div class="col-sm-7">
									<input type="number" id="nbr_j" class="form-control col-sm-6" min="0" value= "1" />
								</div>	
								<div class="col-sm-2">
									<label class="" for="col-sm-3">jour</label>
								</div>	
							</div>
					 
					 		<div class="space-12"></div>
					 		<hr>
					 		<div class="row" align="right">
					 			<button type="submit" id="EnregistrerActe" class="btn btn-primary btn-xs" value ="add">
             			<i class="ace-icon  fa fa-plus-circle fa-lg bigger-110"></i>&nbsp;&nbsp;Ajouter
             		</button>
             		<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
        					<i class="ace-icon fa fa-close bigger-110"></i>Fermer
        				</button>
					 		</div>
					  </form>
					</div>
				</div>
			</div>
		</div>