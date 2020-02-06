<div id="ExamIgtModal" class="modal fade" role="dialog">
     <div class="modal-dialog modal-lg">
     	<div  id="" class="modal-content custom-height-modal">
     	              <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Ajouter un Examen d'Imagerie</h4>
			  @include('patient._patientInfo')
		</div>
		<div class="modal-body">
		             <div class="space-12"></div>
			<div class="row">
			        	<div class="col-sm12">
			        		<label for="explication"><b>Examen(s) proposé(s)</b></label>
					<br>
					<select id="examensradio" name="examensradio[]" multiple="multiple" data-maximum-selection-length="1" class="select2" data-placeholder="Séléctionner..." >
					 	 @foreach($examensradio as $examenradio)
						 <option value="{{ $examenradio->id }}">
							 {{ $examenradio->nom }}
						</option>
						 @endforeach
					</select>
			        	</div>
			 </div>
			  <div class="space-12"></div>
			<div class="row">
			        	<div class="col-sm-12">
			        		<label for="infos"><b>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic</b></label>
			        		<br>
			        		<div class="imgsEx">
				        		@foreach($examens as $examen)
						{{-- <div class="col-xs-2">
						               <div class="checkbox">
							       	 <label>
								         	<input name="exmns" type="checkbox" class="ace" value="{{ $examen->id }}" />
								         	<span class="lbl">{{ $examen->nom }}</span>
								 </label>
							 </div>
						 </div> --}}
						 <div class="col-xs-2">
						  	<input type="checkbox" value="{{ $examen->id }}" name="exmns[]"><label>{{ $examen->nom }} </label>
						  </div>
						 @endforeach
			        		</div>
			        	</div>
		           </div><!-- row -->
		           <div class="space-12"></div>
		</div>
		<div class="space-12"></div>
		<div class="space-12"></div>
		<div class="modal-footer" width = "100%">
			<div class="space-12"></div>	
			<div class="row">
				<button type="button" class="btn btn-info btn-sm disabledElem" id="btn-addImgExam"value="add">
	          				<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
	          			</button>
	       			<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal">
	        				<i class="ace-icon fa fa-close bigger-110"></i>Fermer
	        			</button>
			</div>
		</div>
     	</div>
     </div>
 </div>