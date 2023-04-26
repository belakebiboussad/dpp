<div id="resetPwd" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content custom-height-modal">
    <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Changer le mot de passez</h4></div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
<form id="userChangePasswordForm" class="form-horizontal" method="POST" action="{{ Route('user.change.password')}}">
      <div class="alert alert-danger print-error-msg" style="display:none">
      <strong>Errors:</strong> <ul></ul></div>
      <div class="alert alert-success print-success-msg" style="display:none"></div>
          <div class="mb-3"> 
            <br>
            <label for="password" class="form-label">Mot de passe </label>
            <input type="password" class="form-control" name="current-password" placeholder="Entrer le mot de passe" required/><small class="help-block">Saisissez votre mot de passe actuel</small> 
          </div>
          <div class="mb-3">
          <label for="newPassword" class="form-label">Nouveau mot de passe </label>
            <input type="password" class="form-control" name="newPassword" placeholder="Entrer le mot de passe" required/><small class="help-block">Saisissez votre nouveau mot de passe</small> 
          </div>
          <div class="mb-3">
            <label for="password_again" class="form-label">Confirmer nouveau mot de passe </label>     
            <input type="password" class="form-control" name="password_again" placeholder="Entrer à nouveau le mot de passe" required/>
          </div>
        </div>
      </div>
    </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" id="changePassword"><i class="ace-icon fa fa-save"></i> Enregistrer</button>
      <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i> Annuler</button>
    </div>
  </div>
</div>
</div>