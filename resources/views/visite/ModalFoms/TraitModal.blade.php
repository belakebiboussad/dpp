<div id="traitModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  id="" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="TraitCrudModal">Prescrire un traitement</h4>
      </div> 
      <form id="addTrait" method="POST" action="{{route('traitement.store')}}">
        <input type="hidden" name ="visite_id" value="{{ $visite->id }}"/>
         <input type="hidden" id ="trait_id" value=""/>
      <div class="modal-body">
        <div class="alert alert-danger print-error-msg" style="display:none">
        <strong>Errors:</strong> <ul></ul></div>
        <div class="alert alert-success print-success-msg" style="display:none"></div>
        <div class="form-group">
          <label  class="control-label" for="specialiteProd">Spécialité</label>
          <select class="form-control specPrd" id="specialiteProd">
          <option value="" selected disabled>Sélectionnez la spécialité...</option>
           @foreach($specialitesProd as $specialite)
            <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
          @endforeach 
          </select>
        </div>
        <div class="form-group">
          <label class="control-label" for="med_id">Médicament</label>
          <select name="med_id" id="med_id" data-placeholder="selectionnez le Médicament" class="form-control produit"></select>
        </div>
        <div class="form-group">
            <label  class="control-label" for="posologie">Posologie</label>
            <input type="text" name="posologie" id="posologie" class="form-control" placeholder = "posologie de Traitement"/>
        </div>
        <div class="fom-group">
            <label  class="control-label" for="dureeT">Nombre de prise/jour</label>
            <input type="number" name="nbrPJ" id="nbrPJ" class="form-control"  min="1" value="1" placeholder = "Nombre de prise"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="EnregistrerTrait" class="btn btn-primary btn-sm" value ="add">
            <i class="ace-icon fa fa-save"></i>Enregistrer </button>
          <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
      </div>
      </form>
    </div>
  </div>
</div>
@include('demandeproduits.partials.scripts')