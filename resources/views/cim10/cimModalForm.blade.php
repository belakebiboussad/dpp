<div id="cim10Modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
  	<div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
	   		<h4 class="modal-title">Aide au codage CIM10</h4>
      </div>
      <div class="modal-body">
		 		<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-12">
	      		<label for="chapitre"><strong>Chapitre :</strong></label>
	      		<select class="form-control" id="chapitre" name="chapitre">
	      			<option value="">Selectionner un Chapitre</option>
	      			@foreach($chapitres as $chapitre)
							<option value="{{$chapitre->C_CHAPI}}">{{ $chapitre->C_CHAPI }} : {{ $chapitre->TITRE_CHAPITRE }}</option>
							@endforeach
						</select>
	      	</div>
				</div>
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-12">
	      		<label for="chapitre"><strong>S/Chapitre :</strong></label>
	      		<select class="form-control" id="schapitre" name="schapitre" disabled>
	      			<option value="">Selectionner un Sous Chapitre</option>
	      		</select>
	      	</div>
				</div>
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-12">
					<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right">
						<b><span class="badge badge-info numberResult"></span>&nbsp;maladies </b>
					</div>
					</div>
				</div>
			</div>
     </div>
  </div>
</div>