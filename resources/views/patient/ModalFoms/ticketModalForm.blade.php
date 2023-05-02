<div id="ticket" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter un ticket d'enregistrement</h4>
    </div>
    <div class="modal-body">
      <form id="ticketAddForm" class="form-horizontal" method="POST" action="{{ Route('ticket.store')}}">
         <input type="hidden" name="id_patient" value="{{ $patient->id }}" >
      <div class="alert alert-danger print-error-msg" style="display:none">
      <strong>Errors:</strong> <ul></ul></div>
      <div class="alert alert-success print-success-msg" style="display:none"></div>
      <div  class="form-group">
        <label for="type_consultation" class="form-label">Type de consultation</label>
        <select class="form-control" name="type_consultation" required>
          <option value="" selected disabled>Séléctionner...</option>
          <option value="Normale">Normale</option>
          <option value="Urgente">Urgente</option>
          <option value="controle">Contrôle</option>
          <option value="specialise">Spécialisée</option>
        </select>
      </div>
      <div  class=" form-group">
        <label for="document" class="form-label">Document</label>
        <select class="form-control" name="document" required>
          <option value="" selected disabled>Séléctionner...</option>
          <option value="Rendez-vous">Rendez-vous</option>
          <option value="Lettre d'orientation">Lettre d'orientation</option>
          <option value="Consultation généraliste">Consultation généraliste</option>
          <option value="autre">Autre</option>
        </select>
      </div>
      <div  class="form-group">
        <label for="specialite" class="form-label">Spécialité</label>
        <select class="form-control" name="specialite" required>
          <option value="" selected disabled>Séléctionner...</option>
          @foreach($specialites as $specialite)
            <option value="{{ $specialite->id}}"> {{ $specialite->nom}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" id ="printTck"><i class="ace-icon fa fa-copy"></i> Générer un ticket</button>  
      <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="ace-icon fa fa-close bigger-110"></i> Fermer</button>
    </div>
      </div>
    </div>
</div>