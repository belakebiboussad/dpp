<div class="page-header"><h1>Ajouter un nouveau rôle</h1></div>
<div class="row">
  <div class="col-sm-12">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title">Role </h5></div>
      <div class="widget-body">
        <div class="widget-main">
          <form role="form" id="roleFrm" method="POST" action="{{ route('role.store') }}">
            <div class="form-group row">
              <label class="col-sm-3 control-label no-padding-right" for="nom">Nom</label>
              <div class="col-sm-9">
                <input type="text" id="nom" name="nom" placeholder="Nom du rôle" class="form-control" required/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label no-padding-right">Type</label>
              <div class="col-sm-9">
                <select  name="type"  class="form-control" required>
                  <option value="0" selected>Médicale</option>
                  <option value="">Paramédicale</option>
                  <option value="1">Administratif</option>
                 </select>
              </div>
            </div>
            <div class="center row">
              <button  type="button" id ="rolSave" class="btn btn-xs btn-info" value ="add"><i class="ace-icon fa fa-save"></i>Enregistrer</button> 
              <button class="btn btn-xs btn-warning" type="reset"> <i class="ace-icon fa fa-undo"></i>Annuler </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>