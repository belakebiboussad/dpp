<div class="page-header"><h1>Ajouter un nouveau service </h1></div>
<div class="row">
  <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title">Service </h5></div>
      <div class="widget-body">
        <div class="widget-main">
          <form role="form" method="POST">
            <div class="form-group row"><label class="col-sm-3 col-control-label" for="nom">Nom</label>
              <div class="col-sm-9">
                <input type="text" id="nom" placeholder="Nom du dervice" class="form-control"/>
              </div>
            </div>
            <div class="form-group row"><label class="col-sm-3 control-label" for="type">Type</label>
              <div class="col-sm-9">
                <select id="type" class="form-control selectpicker show-menu-arrow" required >
                  <option value="0">Médicale</option>
                  <option value="1">Chirurgical</option>
                  <option value="">Fonctionnel</option>
                  <option value="2">Administratif</option>
                </select> 
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-control-label" for="responsable_id">Chef</label>
              <div class="col-sm-9">
                <select id="responsable_id" class="form-control selectpicker">
                  <option value="" selected disabled>Selectionner le chef du service</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->employ->id}}"> {{ $user->employ->full_name }}</option>
                  @endforeach
                </select> 
              </div>
            </div>
            <div class="form-group medChirservice row">
              <div class="col-sm-9">
                <div class="checkbox col-sm-offset-4">
                  <label><input name="hebergement" type="checkbox" class="ace" value ="1"/><span class="lbl">Hébergement</span></label>
                </div>          
              </div>
            </div>
            <div class="form-group medChirservice row">
              <div class="col-sm-9">
                <div class="checkbox col-sm-offset-4">
                <label><input name="urgence" type="checkbox" class="ace" value ="1"><span class="lbl">Urgence</span></label>
                </div>
              </div>
            </div>
            <div class="row center">
              <button class="btn btn-xs btn-info" type="button" id="serv-save"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; 
              <button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>