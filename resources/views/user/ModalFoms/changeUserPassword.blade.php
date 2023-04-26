<div id="passwordReset" class="modal fade" role="dialog"> <!-- by admin -->
  <div class="modal-dialog modal-lg">
    <div class="modal-content custom-height-modal">
      <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Changer le mot de passer</h4></div>
      <div class="modal-body">
<form id="changePWD" class="form-horizontal" method="POST" action="{{ url('reset_password_')}}">      
        <input type="hidden" name="current-password" value="{{ $user->password }}">
         <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="alert alert-danger print-error-msg" style="display:none">
            <strong>Errors:</strong>
            <ul></ul>
          </div>
          <div class="alert alert-success print-success-msg" style="display:none"></div> 
        <div class="mb-3">
          <label for="newPassword" class="form-label">Nouveau mot de passe </label>
          <input type="password" class="form-control" name="newPassword" placeholder="Entrer le mot de passe" required/><small class="help-block"></small> 
        </div>
        <div class="mb-3">
          <label for="password_again" class="form-label">Confirmer nouveau mot de passe </label>     
          <input type="password" class="form-control" name="password_again" placeholder="Entrer à nouveau le mot de passe" required/>
        </div>
      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" id ="passwordResetbtn"><i class="ace-icon fa fa-save"></i> Enregistrer</button>
        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i> Annuler</button>
      </div>
      </form>
    </div>
  </div>
</div>