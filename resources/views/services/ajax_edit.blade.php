<div class="page-header"><h1>Modifier le  service "{{ $service->nom }}"</h1></div>
<div class="row">
  <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title">Service &quot;{{ $service->nom}}&quot;</h5></div>
      <div class="widget-body">
        <div class="widget-main">
          <form role="form" id="serviceFrm" method="POST" action="{{ route('service.update', $service->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group row">
              <label class="col-sm-3 col-control-label text-right" for="nom">Nom :</label>
              <div class="col-sm-9">
                <input type="text" id="nom" name="nom" value="{{ $service->nom }}"  class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-control-label text-right" for="type">Type :</label>
              <div class="col-sm-9">
                <select id="type" name="type"  class="form-control selectpicker">
                  <option value="" @if($service->type == '') selected @endif>Fonctionnel</option>
                  <option value="0" @if($service->type == '0') selected @endif>Médical</option>
                  <option value="1" @if($service->type == '1') selected @endif>Chirurgie</option>
                  <option value="2" @if($service->type == "2") selected @endif>Administratif</option>
                </select> 
              </div>
            </div>
            <div class="form-group healthServ row" @if($service->type == 2) style="display:none" @endif><label class="col-sm-3 control-label text-right">Spécialite :</label>
              <div class="col-sm-9">
                <select id="specialite_id" nom="specialite_id" class="form-control selectpicker">
                <option value=""disabled>---Selectionner---</option>
                @foreach($specs as $spec)
                <option id ="{{ $spec->id}}" {{ ($service->specialite_id == $spec->id) ? 'selected' :'' }}> {{ $spec->nom }}</option>
                @endforeach
                </select> 
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-control-label text-right" for="type">Chef :</label>
              <div class="col-sm-9">
                <select id="responsable_id"  name="responsable_id" class="form-control selectpicker">
                  <option value="">Selectionner le chef du service</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->employ->id }}" {{($service->responsable_id ===$user->employ->id)? 'selected':''}}> {{ $user->employ->full_name }}</option>
                  @endforeach
                </select>  
              </div>
            </div>
            <div class="form-group healthServ row" @if($service->type == 2) style="display:none" @endif>
              <div class="col-sm-9">
                 <div class="checkbox col-sm-offset-4">
                <label><input name="hebergement" type="checkbox" class="ace" value ="1" {{(isset($service->hebergement))? 'checked':''}}> <span class="lbl"> Hébergement</span></label>
                </div>          
              </div>
            </div>
            <div class="form-group healthServ row" @if($service->type == 2) style="display:none" @endif>
              <div class="col-sm-9">
                <div class="checkbox col-sm-offset-4">
                <label><input name="urgence" type="checkbox" class="ace" value ="1" {{(isset($service->urgence))? 'checked':''}}><span class="lbl"> Urgence</span></label></div>
              </div>
            </div>
            <div class="row center">
              <button class="btn btn-xs btn-primary" type="submit" id="serSave" value="update"><i class="ace-icon fa fa-save"></i> Enregistrer</button> 
              <button class="btn btn-xs btn-warning" type="reset"><i class="ace-icon fa fa-undo"></i> Annuler</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>