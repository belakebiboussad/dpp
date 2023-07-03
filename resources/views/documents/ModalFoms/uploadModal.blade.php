<div id="uploadModal" class="modal fade" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Uploader un fichier</h4>
      </div>
      <div class="modal-body">
        <form method='post' action='' enctype="multipart/form-data" >

         <div class="form-group">
             <label class="control-label" for="type">Type</label>
             <select class="form-control" id="type">
                      <option value="" selected disabled>Sélectionner...</option>
                      <option value="2">Report</option>
                      <option value="1">Résultat d'examens biologique</option>
                      <option value="1">Compte rendu biologique</option>
                      <option value="1">ECG</option>
                        <option value="2">Radio</option>
                        <option value="2">SCAN</option>
                      <option value="2">MRI</option>
                      <option value="2">MRI</option>
                      <option value="">Divers</option>
            </select>
             </div>
              <div class="form-group"  >
                    <label class="control-label" for="desc">Description</label><br>
                    <textarea name="desc" id="desc" cols="5" rows="4" class="form-control"></textarea>
             </div>
             <div class="form-group">
                    <label class="control-label" for="type">Selectionner le fichier </label>
                     <input type='file' name='file' id='file' class='form-control'>
            </div>
            <div class="form-group">
             <label class="control-label" for="type">Nom</label>
             <input type="text" name="name" placeholder="Nom du document" class="form-control">  
        </div>
        </form>
      </div>
            <div class="modal-footer">
              <span class="btn btn-info btn-sm" disabled>Enregistrer</span>
              <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Annuler</button>
            </div>
    </div>

  </div>
</div>