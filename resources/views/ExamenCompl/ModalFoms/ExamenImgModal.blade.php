<div id="ExamIgtModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  	<div  id="" class="modal-content">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un examen d'imagerie</h4> </div>
        <form  action="#" role="form">
	   		<div class="modal-body">
		       <div class="panel panel-default">
          <div class="panel-heading"><span>Selectionner un examen</span></div>
          <div class="panel-body">
            <div class="form-group">
            <label class="col-form-label blue" for="">Examen(s) proposé(s)</label>
            <select id="examensradio" name="examensradio[]" class="form-control">
              @foreach($examensradio as $examenradio)
              <option value="{{ $examenradio->id }}">{{ $examenradio->nom }}</option>
             @endforeach
            </select>
            </div>
          </div>
        </div>
          <div class="panel panel-default">
          <div class="panel-heading"><span>Selectionner un examen</span></div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-form-label blue">Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic</label>  
               <div class="imgsEx">
            @foreach( $specialite->ImgExams as $exImg)
              <div class="col-sm-3"><input type="radio" name="exmns"  value="{{ $exImg->id }}">&nbsp;<label for="male">{{ $exImg->nom}}</label> </div>
            @endforeach 
            </div>
            </div>
          </div>
        </div>
			  </div>
				<div class="modal-footer">
			  	<button type="button" class="btn btn-primary btn-sm" id="btn-addImgExam" value="add" disabled>
		      	<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
		      <button type="reset" class="btn btn-warning btn-sm" id="btnclose" data-dismiss="modal">
            <i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
				</div>
      </form>
	  </div>
  </div>
 </div>