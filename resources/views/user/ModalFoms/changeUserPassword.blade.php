<div id="passwordReset" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">	<!-- Modal content-->
			<div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Changer le mot de Passe</h4></div>
			<div class="modal-body">
			  <div class="row">
			    <div class="col-xs-12">
						<input type="hidden" value="" id="user_id"/>	
				 		<label for="specialiteOrient"><b>Mot de Passe:</b></label>
				 		<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="taper le nouveau mot de passe" autocomplete="off" required/>
            <small class="help-block"></small>
				  </div>
			  </div><div class="space-12"></div>
			  <div class="row">
   				<div class="col-xs-12">
						<label for="motif"><b>Confirmer le Mot de Passe :</b></label>     
			 			<input type="password" class="form-control" id="password_again" name="password_again" placeholder="taper encore le mot de passe" autocomplete="off" required/>
					</div>
				</div><div class="space-12"></div>
	   	</div>{{-- modal-body --}}
			<div class="space-12"></div><div class="space-12"></div>
		  <div class="modal-footer">
          <div class="col-sm-12">
			    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id ="passwordResetbtn"	><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>{{-- <button data-toggle="modal" data-target="#lettreorien"  onclick=""></button> --}}
				  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			  </div>
      </div>
		</div>{{-- modal-content --}}
	</div>{{-- modal-dialog --}}
</div>{{-- modal --}}