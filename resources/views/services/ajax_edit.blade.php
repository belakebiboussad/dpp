<div class="page-header"><h1>Modifier le  service "{{ $service->nom }}"</h1></div>
<div class="row">
  <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title">Service &quot;{{ $service->nom}}&quot;</h5></div>
      <div class="widget-body">
        <div class="widget-main">
          <form role="form" method="POST" action="{{ route('service.update', $service->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group row">
              <label class="col-sm-3 col-control-label" for="nom">Nom</label>
              <div class="col-sm-9">
                <input type="text" id="nom" name="nom" value="{{ $service->nom }}"  class="form-control"/>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-control-label" for="type">Type{{$service->type}}</label>
              <div class="col-sm-9">
                <select id="type" name="type"  class="form-control selectpicker" required >
                  <option value="" @if($service->type == 'Fonctionnel') selected @endif>Fonctionnel</option>
                  <option value="0" @if($service->type == 'Médical') selected @endif>Médical</option>
                  <option value="1" @if($service->type == 'Chirurgie') selected @endif>Chirurgie</option>
                  <option value="2" @if($service->type == "Administratif") selected @endif>Administratif</option>
                </select> 
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-control-label" for="type">Chef</label>
              <div class="col-sm-9">
                <select id="responsable_id" name="responsable_id"  class="form-control selectpicker">
                  <option value="" selected disabled>Selectionner le chef</option>
                  @foreach ($employs as $employ)
                    <option value="{{ $employ->id}}" @if((isset($service->responsable_id)) && ($service->responsable_id == $employ->id)) selected @endif> {{ $employ->full_name }}</option>
                  @endforeach
                </select> 
              </div>
            </div>
            <div class="form-group medChirservice @if($service->type == 2) hidden @endif row">
              <div class="col-sm-9">
                 <div class="checkbox col-sm-offset-4">
                <label><input name="hebergement" type="checkbox" class="ace" value ="1" {{(isset($service->hebergement))? 'checked':''}}> <span class="lbl">Hébergement</span></label>
                </div>          
              </div>
            </div>
            <div class="form-group medChirservice @if($service->type == 2) hidden @endif row">
              <div class="col-sm-9">
                <div class="checkbox col-sm-offset-4">
                <label><input name="urgence" type="checkbox" class="ace" value ="1" {{(isset($service->urgence))? 'checked':''}}><span class="lbl">Urgence</span></label></div>
              </div>
            </div>
            <div class="row center">
              <button class="btn btn-xs btn-primary" type="submit"><i class="ace-icon fa fa-save"></i> Enregistrer</button> 
              <button class="btn btn-xs btn-warning" type="reset"><i class="ace-icon fa fa-undo"></i> Annuler</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@if($service->salles->count() > 0)
<div class="row">
  <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header">
      <div><h5 class="widget-title"><i class="ace-icon fa fa-table"></i> les  chambres du service &quot;{{ $service->nom}} &quot;</h5></div>
      </div>
      <div class="widget-body">
        <div class="widget-main no-padding">
        <table class="table-bordered table-hover irregular-header table-responsive dataTable" id="liste_sorties" style="width:100%">
          <thead class="thin-border-bottom thead-light">
            <tr><th class="center">Numéro</th><th class="center">Nom</th><th class="center">Nombre de lits</th></tr>   
          </thead>
          <tbody>
           @foreach ($service->salles as $salle) 
          <tr>
            <td>{{ $salle->num }}</td>
            <td><a href="/salle/{{$salle->id}}" title="detail de la salle">{{ $salle->nom }}</a></td>
            <td class="center"><span class="badge badge-info">{{ count($salle->lits) }}</span></td>
          </tr>
          @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endif