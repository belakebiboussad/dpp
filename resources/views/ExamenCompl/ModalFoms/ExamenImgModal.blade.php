<div id="ExamIgtModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  	<div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un examen d'imagerie</h4> </div>
	   		<div class="modal-body">
		      <div class="form-group mt-5">
            <label class="control-label">Examen(s) proposé(s)</label>
            <div class="input-group col-sm-12">
              <select id="examensradio" name="examensradio[]" class="form-control select2 row">
             @foreach($examensradio as $examenradio)
              <option value="{{ $examenradio->id }}"> {{ $examenradio->nom }}</option>
             @endforeach
            </select>
            </div>
          </div>
          <div class="form-group">
            <label for="control-label">Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic</label>
            <div class="imgsEx">
            @foreach( $specialite->ImgExams as $exImg)
              <div class="col-sm-2"><input type="radio" name="exmns"  value="{{ $exImg->id }}">&nbsp;<label for="male">{{ $exImg->nom}}</label> </div>
            @endforeach 
            </div>
          </div>
			  </div>
				<div class="modal-footer">
			  	<button type="button" class="btn btn-primary btn-sm" id="btn-addImgExam" value="add" disabled>
		      	<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
		      <button type="reset" class="btn btn-warning btn-sm" id="btnclose" data-dismiss="modal">
            <i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
				</div>
	  </div>
  </div>
 </div>