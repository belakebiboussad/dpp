<div id="sortieHosp" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div  id="" class="modal-content custom-height-modal">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Sortie du patient</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id" value="">
        <div class="mb-3">
          <label for="Date_SortieH">Date de sortie</label>
          <input type="text" id="Date_SortieH" class="form-control date-picker"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd" required/>
        </div>
        <div class="mb-3">
          <label for="Heure_sortie">Heure de sortie</label>
          <input type="text" id="Heure_sortie" class="form-control timepicker1" />
        </div>
        <div class="mb-3">
          <label for="modeSortie">Mode de sortie</label>
          <select class="form-control" id="modeSortie">
            <option value="">Domicile</option>
            <option value="0">Transfert</option>
            <option value="1">Contre avis médical</option>
            <option value="2">Décès</option>
            <option value="3">Reporter</option>
          </select>
        </div>
        <div class="mb-3 ndeces">
          <label for="resumeSortie">Résumé de sortie</label>
          <textarea class="form-control"  id="resumeSortie"></textarea>
        </div>
        <div class="mb-3 ndeces">
          <label for="etatSortie">Etat a la sortie</label>
          <textarea class="form-control"  id="etatSortie"></textarea>
        </div>
        <div class="mb-3 ndeces">
          <label for="diagSortie">Diagnostic de sortie</label>
          <textarea class="form-control"  id="diagSortie"></textarea>
        </div>
        <div class="mb-3 hidden transfert">
          <label for="structure">Malade adressé à</label>
          <input type="text" class="form-control" id="structure" placeholder="saisir structure de Transfert">
        </div>
        <div class="mb-3 hidden transfert">
          <label for="motif">Motif du transfert</label>
          <input type="text" class="form-control" id="motif" placeholder="motif du Transfert">
        </div>
        <div class="mb-3 hidden deces">
          <label for="date">Date décès</label>
          <input type="text" id="date" class="form-control date-picker"  data-date-format="yyyy-mm-dd" data-provide="datepicker" required/>
        </div>
        <div class="mb-3 hidden deces">
          <label for="heure">Heure décès</label>
          <input type="text" id="heure" class="form-control timepicker1" />
        </div>
        <div class="mb-3 hidden deces">
          <label for="medecin">Médecin constatant décès</label>
          <select class="form-control" id="medecin">
            @foreach($medecins as $medecin)
              <option value="{{ $medecin->id }}">{{$medecin->full_name }}</option> 
            @endforeach
          </select>
        </div>
        <div class="mb-3 hidden deces">
          <label for="cause">Cause décès</label>
          <textarea class="form-control" id="cause" placeholder="Cause de décès"></textarea>
        </div>  
        <div class="mb-3">
          <label for="ccimdiagSortie">Code Cim10</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search" id="ccimdiagSortie" disabled>
            <div class="input-group-btn">
              <button class="btn btn-default btn-xs CimCode" type="button" value="ccimdiagSortie">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-info btn-xs" id ="cloturerHop" data-dismiss="modal">
        <i class="ace-icon fa fa-save"></i>Enregistrer</button>
      <button type="reset" class="btn btn-warning btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-close"></i>Annuler</button>
    </div>
    </div>
  </div>
</div>