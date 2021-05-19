<div id="addCRRDialog" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">	<!-- Modal content-->
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Compte Rendue Radiologique </h4></div>
			<div class="modal-body">
			  <form action="#" method="POST">
			    <input type="hidden" name=""  id="examId" value="">
			    <div class="row">
			      <div class="col-xs-12"><br><label for="modeAdmissionHospi"><strong> Indication:</strong></label>
			     		 <textarea class="form-control" name="" rows="3"></textarea>	
				    </div>
			    </div>{{-- row --}}
			    <div class="space-12"></div>
        	<div class="row">
			     	<div class="col-xs-12">
			     		<label for="specialiteHospi"><strong>Technique de réaliation :</strong></label>
							<textarea class="form-control" name="" rows="6"></textarea>	
			      </div>		
			    </div>{{-- row --}}
			    <div class="space-12"></div>
			    <div class="row">
			     	<div class="col-xs-12">
			     	 	<label for="serviceHospi"><b>Resultat:</b></label>
					    <textarea class="form-control" name="" rows="6"></textarea>
			      </div>	
			    </div>
			    <br>
			    <div class="row">
			     	<div class="col-xs-12">
			     	 	<label for="serviceHospi"><b>Synthèse & Conclusion:<span style="color: red">*</span></b></label>
					    <textarea class="form-control" name="" rows="6" required></textarea>
			      </div>	
			    </div>
			  </form>
			</div>{{-- modal-body --}}
			<div class="space-12"></div><div class="space-12"></div><div class="space-12"></div>
		  <div class="modal-footer">
        {{-- <form class="form-horizontal" method="POST" action="/">
    			{{ csrf_field() }}
    			<input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
      		<div class="clearfix form-actions">
     		  <div class="col-md-offset-5 col-md-7">
        		<button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>
          </div>
		    </div>
		    </form> --}}
        <button type="submit" class="btn btn-primary btn-sm" data-dismiss="modal" onclick= "CRRSave();"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
        <button type="button" class="btn btn-sm btn-success" onclick=""><i class="ace-icon fa fa-print  bigger-110"></i>Imprimer</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">	<i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}