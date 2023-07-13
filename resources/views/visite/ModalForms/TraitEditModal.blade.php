<div id="traitEditModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  id="updateTraitFrm" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modifier le Traitement Médical</h4>
      </div> 
    <form id="traitEditFrm" method="POST" action="">
        {{ method_field('PUT') }}
       <div class="modal-body">
          <div class="alert alert-danger print-error-msg" style="display:none">
        <strong>Errors:</strong> <ul></ul></div>
        <div class="alert alert-success print-success-msg" style="display:none"></div>
        <div class="form-group">
        <label  class="control-label">Spécialité</label>
        <select class="form-control specPrd" onchange="selectedSpecDrug(this.value);">
          <option value="" selected disabled>Sélectionnez la spécialité...</option>
           @foreach($specialitesProd as $specialite)
            <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
          @endforeach 
          </select>
        </div>
    <div class="form-group">
      <label class="control-label">Médicament</label>
      <select name="med_id" data-placeholder="selectionnez le Médicament" class="form-control produit"></select>
    </div>
  <div class="form-group">
      <label  class="control-label" for="posologie">Posologie</label>
      <input type="text" name="posologie" id="posologie" class="form-control" placeholder = "posologie de Traitement"/>
  </div>
  <div class="fom-group">
      <label  class="control-label">Nombre de prise/jour</label>
      <input type="number" name="nbrPJ" id="nbrPJ" class="form-control"  min="1" value="1" placeholder = "Nombre de prise"/>
  </div>
        </div>
      <div class="modal-footer">
        <button type="submit" id="updateTrait" class="btn btn-primary btn-sm">
            <i class="ace-icon fa fa-save"></i>Enregistrer </button>
          <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
      </div>
    </form>
    </div>
  </div>
</div>