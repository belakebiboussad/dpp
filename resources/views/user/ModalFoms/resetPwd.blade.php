<div id="resetPwd" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content custom-height-modal">
      <div class="modal-header"><button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">Changer le mot de passe</h4></div>
       
        <input type="hidden" name="id" value="{{ Auth::id() }}"/>
      <div class="modal-body">
        <div class="mb-3">
            <label class="col-sm-2 control-label">Utilisateur</label>
            <div class="col-sm-10">
              <p class="form-control-static">{{ Auth::user()->name }}</p>
              <span class="help-block"></span>
            </div>
        </div>
        <div class="mb-3">
          <label class="col-sm-2 control-label" for="password" accesskey="">Mot de passe</label>
          <div class="col-sm-10">
            <input class="form-control" name="password" type="password" id="password" required="required" aria-required="true">
            <span class="help-block">Saisissez votre mot de passe actuel</span>
          </div>
        </div>
        <div class="mb-3">
          <label class="col-sm-2 control-label" for="newPassword">Nouveau mot de passe</label>
          <div class="col-sm-10">
            <input class="form-control" name="newPassword" type="password" id="newPassword" value="" required="required" aria-required="true">
            <span class="help-block">Saisissez votre nouveau mot de passe</span>
          </div>
        </div>
        <div class="form-group ">
        <label class="col-sm-2 control-label" for="retypeNewPassword" accesskey="">Confirmez le mot de passe</label>
        <div class="col-sm-10">
            <input class="form-control" name="retypeNewPassword" type="password" id="retypeNewPassword" value="" required="required" aria-required="true">
            <span class="help-block"></span>
        </div>
    </div>
      </div>
       <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save"></i> Enregistrer</button>
        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i> Annuler</button>
      </div>
    </div>
  </div>
</div>