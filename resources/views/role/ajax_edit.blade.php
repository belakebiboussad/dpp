<div class="page-header"><h1>Modifier le rôle</h1></div>
<div class="row">
  <div class="col-sm-12">
    <form role="form" id="rolUpdate" method="PUT" action="{{ route('role.update',$role->id) }}">
        <div class="form-group row">
          <label class="col-sm-3 control-label" for="nom">Nom</label>
          <div class="col-sm-9" >
            <input type="text" id="nom" name="nom" placeholder="Nom du role" class="form-control"  value="{{ $role->nom }}" required/>
          </div>
        </div>
         <div class="form-group row">
          <label class="col-sm-3 control-label" for="type">Type</label>
          <div class="col-sm-9">
            <select type="text" id="type" name="type"  class="form-control" required>
              <option value="0" @if($role->type == 'Médical') selected @endif>Médicale</option>
              <option value="" @if($role->type == 'Paramédicale') selected @endif>Paramédicale</option>
              <option value="1"  @if($role->type == 'Administratif') selected @endif>Administratif</option>
             </select>
          </div>
        </div>
        </form>
        <div class="hr hr-dotted"></div>
        <div class="center row">
          <button type="button" id ="rolUpdate" class="btn btn-sm btn-primary" value ="update"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
          <button class="btn btn-sm btn-warning" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler
          </button>
      </div>
    
  </div>
</div>
