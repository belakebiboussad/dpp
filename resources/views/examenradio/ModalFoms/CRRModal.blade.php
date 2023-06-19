<div id="addCRRDialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   	<div class="modal-content">
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;
				</button> <h4 class="modal-title" id="crrModalTitle">Ajouter un compte rendue radiologique </h4>
			</div>
			<div class="modal-body">
			  <form id="CRRForm" action="" method="POST">
			    <input type="hidden" name=""  id="examId" value="">
			     <input type="hidden" name=""  id="crrId" value="">
     		    <div class="row">
			     	<div class="col-xs-12">
			     	 	<label class="pull-left required">Compte rendu radiologique :</label>
					       <textarea class="form-control a" id="conclusion" rows="10" required></textarea>
			      </div>	
			    </div>
			  </form>
			</div>{{-- modal-body --}}
		  <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" id="crrSave" data-dismiss="modal" onclick= "CRRSave();" value="add"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button> {{--<button type="button" class="btn btn-sm btn-success" onclick="ComptRRPrint();" data-dismiss="modal"><i class="ace-icon fa fa-print  bigger-110"></i>Imprimer</button> --}}
        <button type="button" class="btn btn-sm btn-success" onclick="CRRPrint()" data-dismiss="modal"><i class="ace-icon fa fa-print  bigger-110"></i>Imprimer</button>
        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}