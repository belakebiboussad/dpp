<div id="ticket" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <input type="text" name="id_patient" id="id_patient" value="{{ $patient->id }}" hidden>
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un ticket d'enregistrement</h4>
    </div>
    <div class="modal-body">
      <div  class="form-group">
        <label for="typecons" class="form-label">Type de consultation</label>
        <select class="form-control" id="typecons" required>
          <option value="" selected disabled>Séléctionner...</option>
          <option value="Normale">Normale</option>
          <option value="Urgente">Urgente</option>
          <option value="controle">Contrôle</option>
          <option value="specialise">Spécialisée</option>
        </select>
      </div>
      <div  class=" form-group">
        <label for="document" class="form-label">Document</label>
        <select class="form-control" id="document" required>
          <option value="" selected disabled>Séléctionner...</option>
          <option value="Rendez-vous">Rendez-vous</option>
          <option value="Lettre d'orientation">Lettre d'orientation</option>
          <option value="Consultation généraliste">Consultation généraliste</option>
          <option value="autre">Autre</option>
        </select>
      </div>
      <div  class="form-group">
        <label for="specialite" class="form-label">Spécialité</label>
        <select class="form-control" id="specialiteTick" disabled required>
          @foreach($specialites as $specialite)
            <option value="{{ $specialite->id}}" {{($specialite->id == Auth::User()->employ->specialite) ?"selected disabled":'' }}> {{ $specialite->nom}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" id ="print"><i class="ace-icon fa fa-copy"></i> Générer un ticket</button>  
      <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i> Fermer</button>
    </div>
      </div>
    </div>
</div>