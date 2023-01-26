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
            <div class="form-group">
              <label class="col-sm-3 control-label" for="nom"> Nom :</label>
              <div class="col-sm-9">
                <input type="text" id="nom" name="nom" value="{{ $service->nom }}"  class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="type">Type :</label>
              <div class="col-sm-9">
                <select id="type" name="type"  class="form-control selectpicker" required >
                  <option value="0" @if($service->type == 'Médicale') selected @endif>Médicale</option>
                  <option value="1" @if($service->type == 'Chirurgical') selected @endif>Chirurgical</option>
                  <option value="2" @if($service->type == 'Paramédical') selected @endif>Paramédical</option>
                   <option value="3" @if($service->type == "Administratif") selected @endif>Administratif</option>
                </select> 
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="type">Chef :</label>
              <div class="col-sm-9">
                <select id="responsable_id" name="responsable_id"  class="form-control selectpicker">
                  <option value="" selected disabled>Selectionner le chef</option>
                  @foreach ($employs as $employ)
                    <option value="{{ $employ->id}}" @if((isset($service->responsable_id)) && ($service->responsable_id == $employ->id)) selected @endif> {{ $employ->full_name }}</option>
                  @endforeach
                </select> 
              </div>
            </div>
            <div class="form-group medChirservice @if($service->type == 2) hidden @endif">
              <label class="col-sm-3 control-label" for="hebergement">Hébergement :</label>
              <div class="col-sm-9">
                <label>
                  <input name="hebergement" value="0" type="radio" class="ace" @if(!($service->hebergement)) checked @endif/><span class="lbl">Non</span></label> 
                <label>
                  <input name="hebergement" value="1" type="radio" class="ace" @if($service->hebergement) checked @endif/><span class="lbl">Oui</span></label>              
              </div>
            </div>
            <div class="form-group medChirservice @if($service->type == 2) hidden @endif">
              <label class="col-sm-3 control-label" for="urgence"> Urgence : </label>
              <div class="col-sm-9">
                <label>
                  <input name="urgence" value="0" type="radio" class="ace" @if(!($service->urgence)) checked @endif/><span class="lbl">Non</span></label>
                <label>
                  <input name="urgence" value="1" type="radio" class="ace" @if($service->urgence) checked @endif/><span class="lbl">Oui</span></label>
              </div>
            </div>
            <div class="row center">
              <button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save"></i> Enregistrer</button> 
              <button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo"></i> Annuler</button>
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
         <div><h5 class="widget-title"><i class="ace-icon fa fa-table"></i><b>les  chambres du service &nbsp; &quot;{{ $service->nom}} &quot; </b></h5></div>
      </div>
      <div class="widget-body">
        <div class="widget-main no-padding">
        <table class="table-bordered table-hover irregular-header table-responsive dataTable" id="liste_sorties" style="width:100%">
          <thead class="thin-border-bottom thead-light">
            <tr>
                <th class="center">Numéro</th><th class="center">Nom</th><th class="center">Nombre de lits</th>  
            </tr>    
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