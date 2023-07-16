<div id="productAdModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button> <h4 class="modal-title">Ajouter un Produit</h4></div>
        <form action="#" method="POST">
         <div class="modal-body">
           <div class="form-group">
            <label for="gamme" class="control-label">Gamme </label>
            <select class="form-control" id="gamme">
              <option value="" disabled>Sélectionner...</option>
              @foreach($gammes as $gamme)
                <option value="{{ $gamme->id }}">{{ $gamme->nom }}</option>
              @endforeach 
            </select>
          </div>
          <div id = "specialiteDiv" class="form-group">
            <label for="specPrd" class="control-label">Spécialité </label>
            <select class="form-control specPrd" id="specPrd" onchange="selectedSpecDrug(this.value);">
              <option value="" selected disabled>Sélectionner...</option>
              @foreach($specialites as $spec)
                <option value="{{ $spec->id }}">{{ $spec->nom }}</option>
              @endforeach 
            </select> 
          </div>
          <div class="form-group">
            <label for="produit" class="control-label">Produit</label>
            <select class="form-control produit" id="produit">
              <option value="" selected disabled>Sélectionner...</option>
            </select>
          </div>
          <div class="form-group">
            <label for="quantite" class="control-label">Quantité</label>
            <input type="number" class="form-control" id="quantite" min="1">
          </div>
          <div class="form-group">
            <label for="unite" class="control-label">Unité</label>
            <input type="text" class="form-control" id="unite" palceholder="Unité">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-sm" id="Prodadd" data-dismiss="modal" disabled><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
          </button>
        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>