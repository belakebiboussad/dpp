<div id="CertifDescrAdd" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content custom-height-modal">
      <div class="modal-header"><button type="button" class="close" data-dismiss="modal">
        &times;</button> <h4 class="modal-title" id="DescripCrudModal">Ajouter un Certificat descriptf</h4>
      </div>
      <div class="modal-body">
        <form id="modalFormDescript" method="POST">
          <input type="hidden" id="decript_id">
          <div class="form-group">
            <label for="description">Examen clinque</label>
            <textarea class="form-control" id="examClin" rows="8"></textarea>
          </div>
        </form>
        <div class="form-group">
        <label><input type="checkbox" class="ace" id="isChronic"/>
          <span class="lbl"> Il s'agit d'une maladie chronique</span>
        </label>
        </div>
      </div>
      <div class="modal-footer">
          <div class="col-sm-12">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id ="decriptifSave" value="add"><i class="ace-icon fa fa-save bigger-110"></i> Enregistrer</button>
            <button type="button" class="btn btn-sm btn-warning"  data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i> Annuler</button>
          </div>
      </div>
    </div>
  </div>
</div>