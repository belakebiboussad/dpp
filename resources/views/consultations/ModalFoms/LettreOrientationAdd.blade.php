<div id="LettreOrientationAdd" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
   	<div class="modal-content custom-height-modal">
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal">
        &times;</button><h4 class="modal-title" id="orientCrudModal">Ajouter une Lettre d'orientation</h4>
      </div>
			<div class="modal-body">
			  <form id="modalFormDataOroient" method="POST" class="form-horizontal">
          <input type="hidden" id="orient_id">
				 	<div class="form-group">	
            <label for="specialiteOrient">Spécialité :</label>
				  	<select class="form-control" id="specialiteOrient">
					  	<option value="" disabled selected="">Sélectionner...</option>
					  	@foreach($specialites as $specialite)
					  	<option value="{{ $specialite->id}}">{{$specialite->nom}}</option>
					  	@endforeach 
				  	</select>
          </div>
		      <div class="form-group">  
			  		<label for="motif">Motif de consultation :</label>     
						<textarea class="form-control" id="motifC" cols="10" rows="3"></textarea>
          </div>
          <div class="form-group">  
						<label for="motif">Examen général :</label>     
						<textarea class="form-control" id="motifOrient" cols="20" rows="3"></textarea>
          </div>
				</form>
			</div>
		  <div class="modal-footer">
          <div class="col-sm-12">
			    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id ="orientationSave" value="add"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
          <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i> Annuler</button>
			  </div>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}
<div id="lettreorien" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content custom-height-modal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title"><b>Lettre Orientation :</b></h4>
			</div>
			<div class="row"><canvas id="lettreorientation" height="1%"><img id='itfL'/></canvas></div>
		</div>
	</div>
</div>