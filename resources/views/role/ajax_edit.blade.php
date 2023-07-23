<div class="page-header"><h1>Modifier le rôle "{{ $role->nom }}"</h1></div>
<div class="row">
  <div class="col-sm-12">
       <div class="widget-box">
        <div class="widget-header"><h5 class="widget-title">Role </h5></div>
        <div class="widget-body">
          <div class="widget-main">
          <form role="form" id="roleFrm" method="POST" action="{{ route('role.update',$role) }}">{{--rolUpdFrm --}}
            {{ method_field('PUT') }}
            <div class="form-group row">
                <label class="col-sm-3 control-label no-padding-right" for="nom">Nom</label>
                <div class="col-sm-9">
                  <input type="text" id="nom" name="nom"  class="form-control" value="{{ $role->nom }}"  required/>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 control-label no-padding-right" for="type">Type</label>
                <div class="col-sm-9">
                  <select id="type" name="type"  class="form-control" required>
                    <option value="0" @if($role->type == 'Médical') selected @endif>Médicale</option>
                    <option value="" @if($role->type == 'Paramédicale') selected @endif>Paramédicale</option>
                    <option value="1" @if($role->type == 'Administratif') selected @endif>Administratif</option>
                   </select>
                </div>
              </div>
              <div class="center row">
                <button  type="button" id ="rolSave" class="btn btn-xs btn-info" value ="update"><i class="ace-icon fa fa-save"></i>Enregistrer</button> 
                <button class="btn btn-xs btn-warning" type="reset"> <i class="ace-icon fa fa-undo"></i>Annuler </button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>