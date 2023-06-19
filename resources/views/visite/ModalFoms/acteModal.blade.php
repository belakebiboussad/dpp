<div id="acteModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="acteCrudModal">Prescrire un Acte Médicale</h4>
      </div>
      <div class="modal-body">
        <form id="addActe" method="POST">
        <input type="hidden" id ="acte_id">
        <div class="form-group">
            <label class="control-label" for="specialiteProd">Acte :</label>
            <input type="text" id="acte" class="form-control" placeholder = "Nom de l'Acte"/> 
        </div>
        <div class="form-group">
            <label for="type" class="control-label">Type :</label>
            <select class="form-control" id="type" data-placeholder="selectionnez le type de l'acte">
              <option value="" selected disabled >selectionnez le type de l'acte</option>
              <option value="paramedicale">paramédicale</option>
              <option value="medicale">médicale</option>
            </select>    
        </div>
        <div class="form-group">
            <label class="control-label" for="code_ngap">Code NGAP :</label>
            <select id="code_ngap" class="form-control">
              <option value="" selected disabled>selectionnez le Code NGAP</option>
              @foreach($codesNgap as $code)
              <option value="{{ $code->code }}">{{ $code->libelle }}</option>}
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label  class="control-label" for="specialiteProd">Application :</label>
            <input type="text" id="description" class="form-control" placeholder = "applcation de l'acte"/> 
        </div>
         <div class=" form-group">
            <label  class="control-label" for="dureeT">Fois/Jour :</label>
            <input type="number" id="nbrFJ" class="form-control"  min="1" value="1" placeholder = "Nombre de prise"/><!-- <label for="dureeT">Durée(jour):</label>
      <input type="number" id="dureeT" class="form-control"  min="1" value="1" placeholder = "Duree"/> -->
        </div>
        <div class="row" align="right">
          <button type="submit" id="EnregistrerActe" class="btn btn-primary btn-xs" value ="add">
            <i class="ace-icon fa fa-save"></i>Enregistrer</button>
          <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler </button>
        </div>
      </form>
      </div>  
    </div>
  </div>
</div>