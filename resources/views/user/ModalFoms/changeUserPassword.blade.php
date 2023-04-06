<div id="passwordReset" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content custom-height-modal">
      <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Changer le mot de passe</h4></div>
      <div class="modal-body">
        <input type="hidden" value="" id="user_id"/>  
        <div class="mb-3">
          <label for="password" class="form-label">Nouveau mot de passe </label>
          <input type="password" class="form-control" id="newPassword" placeholder="Entrer le mot de passe" required/><small class="help-block"></small> 
        </div>
        <div class="mb-3">
          <label for="password_again" class="form-label">Confirmer nouveau mot de passe </label>     
          <input type="password" class="form-control" id="password_again" placeholder="Entrer à nouveau le mot de passe" required/>
        </div>
      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id ="passwordResetbtn"><i class="ace-icon fa fa-save"></i> Enregistrer</button>
        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i> Annuler</button>
      </div>
    </div>
  </div>
</div>