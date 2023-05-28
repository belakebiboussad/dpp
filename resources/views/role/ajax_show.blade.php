<div class="page-header"><h1>Détails du rôle &quot;{{ $role->nom }}&quot;</h1></div>
<div class="widget-box">
  <div class="widget-header"><h5 class="widget-title">Service &quot;{{ $role->nom }} &quot;</h5></div>
  <div class="widget-body">
    <div class="widget-main">
      <div class="form-group row"><label class="col-sm-3 control-label">Nom</label>
          <div class="col-sm-9"><p class = "form-control-static">{{ $role->nom }}</p></div>
      </div>
      <div class="form-group row"><label class="col-sm-3 control-label">Type</label>
        <div class="col-sm-9"><p class = "form-control-static">{{ $role->type }}</p></div>
      </div>
    </div>
  </div>
</div>