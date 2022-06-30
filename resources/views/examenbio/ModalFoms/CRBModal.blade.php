<div id="addCRBDialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">	<!-- Modal content-->
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;
				</button> <h4 class="modal-title" id="crrModalTitle">Ajouter un compte-rendue biologique </h4>
			</div>
			<div class="modal-body">
			  <form id="CRBForm" action="" method="POST" class="form-horizontal">
			    <input type="hidden" name=""  id="crbId" value="">
			    <div class="row">
			      <div class="col-xs-12"><br><label for="crbm"><strong></strong></label>
			     		 <textarea class="form-control" id="crbm" rows="10"></textarea>	
				    </div>
			    </div>{{-- row --}}
			  </form>
			</div>{{-- modal-body --}}
		  <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" id="crbSave" data-dismiss="modal" onclick= "CRBSave();" value="add"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
        <button type="button" class="btn btn-sm btn-success" onclick="CRBPrint();" data-dismiss="modal"><i class="ace-icon fa fa-print  bigger-110"></i>Imprimer</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i>Fermer</button>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}