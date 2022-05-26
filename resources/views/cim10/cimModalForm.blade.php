<div id="cim10Modal" class="modal fade" aria-labelledby="CIM" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog modal-lg">
  	<div class="modal-content custom-height-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" id="CIM">Aide au codage CIM-10</h4>   		
      </div>
      <div class="modal-body">
		<input type="hidden" id="inputID" value="">
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-12">
	      		<label for="chapitre"><strong>Chapitre :</strong></label>
	      		<select class="form-control" id="chapitre" name="chapitre">
	      			<option value="0">Selectionner un Chapitre</option>
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
	      			<option value="0">Selectionner un sous chapitre</option>
	      		</select>
	      		</div>
		</div>
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-12">
				<div class="col-xs-12 label label-lg label-primary arrowed-in arrowed-right">
					<b><span class="badge badge-info numberResult"></span>&nbsp;maladies </b>
				</div>
			</div>
		</div>
		<div class="space-12"></div>
		<div class="row">
			<div class="col-sm-12">
				<div class="widget-body">
					<div class="widget-main no-padding">
						<table class="display table-responsive" width="100%" id="liste_codesCIM">
						<thead>
		    					<tr>
						            <th>Code</th>
						            <th>Nom</th>
						            <th><em class="fa fa-cog"></em></th>
				          		</tr>
						</thead>
						</table>    
					</div>
				</div>
			</div>
		</div>	
		</div>
     </div>
  </div>
</div>