<div id="ExamIgtModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  	<div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un examen d'imagerie</h4> </div>
	   		<div class="modal-body">
		 		<div class="row">
	      	<div class="col-sm-12">
	      		<label for="control-label examensradio">Examen(s) proposé(s) :</label><br>
						<select id="examensradio" name="examensradio[]" multiple="multiple" data-maximum-selection-length="1" class="form-control select2" data-placeholder="Séléctionner..." >
					 	 @foreach($examensradio as $examenradio)
						 	<option value="{{ $examenradio->id }}"> {{ $examenradio->nom }}</option>
						 @endforeach
						</select>
			    </div>
			  </div><div class="space-12"></div>
				<div class="row">
				<div class="col-sm-12">
			  	<label for="control-label">Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic :</label> <br>
			   	<div class="imgsEx">
            @foreach( $specialite->ImgExams as $exImg)
              <div class="col-xs-2"><input type="radio" name="exmns"  value="{{ $exImg->id }}">
              <label for="male">{{ $exImg->nom}}</label> </div>
            @endforeach 
				</div>
			  </div>
				</div>
			  </div>
				<div class="modal-footer" width = "100%">
			  	<button type="button" class="btn btn-success btn-sm" id="btn-addImgExam" value="add" disabled>
		      	<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
		      <button type="reset" class="btn btn-warning btn-sm" id="btnclose" data-dismiss="modal">
            <i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
				</div>
	  </div>
  </div>
 </div>