<div id="traitModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="TraitCrudModal">Prescrire un traitement</h4>
        </div> 
        <form id="addTrait" method="POST" id="form1" action="">
        {{ csrf_field() }}
        <input type="hidden" name="id_visite" id ="id_visiteT" value="{{ $id }}">
        <input type="hidden" id ="trait_id" value=""/>
        <div class="modal-body">
        <div class="form-group">
               <label  class="control-label" for="specialiteProd">Spécialité :</label>
              <select class="form-control" id="specialiteProd" name="specialiteProd">
              <option value="" selected disabled>Sélectionnez la spécialité...</option>
               @foreach($specialitesProd as $specialite)
                <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
              @endforeach 
              </select>
        </div>
        <div class="form-group">
              <label class="control-label" for="produit">Médicament :</label>
              <select id="produit" data-placeholder="selectionnez le Médicament" class="selectpicker  form-control" disabled></select>
        </div>
        <div class="form-group">
            <label  class="control-label" for="posologie">Posologie :</label>
            <input type="text" id="posologie" class="form-control" placeholder = "posologie de Traitement"/>
        </div>
        <div class="fom-group">
            <label  class="control-label" for="dureeT">Nombre de prise/jour :</label>
            <input type="number" id="nbrPJ" class="form-control"  min="1" value="1" placeholder = "Nombre de prise"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="EnregistrerTrait" class="btn btn-success btn-sm" value ="add">
            <i class="ace-icon fa fa-save"></i>Enregistrer </button>
          <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
      </div>
      </form>
    </div>
  </div>
</div>