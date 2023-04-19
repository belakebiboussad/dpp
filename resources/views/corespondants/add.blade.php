<div id="gardeMalade" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"  id="CoresCrudModal">Ajouter un correspondant(e)</h4> 
      </div>
      <div class="modal-body">
        <form id="addGardeMalade" method="POST" action ="{{  route('hommeConfiance.store') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="patientId" id ="patientId" value="{{ $patient->id }}">
          <input type="hidden" name="userId" id ="userId" value="{{ Auth::user()->employe_id}}">
           <input type="hidden" id="hom_id" name="hom_id" value="0">
          <hr>
          <div class="form-group">
            <span>
              <select name="typeH" id="typeH" >
                <option value="0">Garde malade</option>
                <option value="1">Personne à prévenir</option>
              </select>
             </span>
          </div>
          <div class="mb-3">
             <label for="nom_h" class="col-form-label">Nom :</label>
             <input type="text" class="form-control" id="nom_h">
          </div>
          <div class="mb-3">
            <label for="prenom_h" class="col-form-label">Prénom:</label>
            <input type="text" class="form-control" id="prenom_h">
          </div>
          <div class="mb-3">
            <label for="datenaissance_h">Né(e) le :</label>
            <input class="form-control date-picker ltnow" id="datenaissance_h" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" required />
          </div>
          <div class="mb-3">
            <label for="lien_par">Qualité :</label>
            <select class="form-control" id="lien_par" required>
              <option value="" selected>Sélectionner...</option>
              <option value="0">Conjoint(e)</option>
              <option value="1">Père</option>
              <option value="2">Mère</option>
              <option value="3">Frère </option>
              <option value="4">Soeur </option>
              <option value="5">Ascendant</option>
              <option value="6">Grand-parent</option>
              <option value="7">Membre de famille </option>
              <option value="8">Ami </option>
              <option value="9">Collègue</option>
              <option value="10">Employeur</option>
              <option value="11">Employé</option>
              <option value="12">Tuteur</option>
              <option value="13">Autre </option>
            </select>
          </div>
          <div class="mb-3">
            <label for="type_piece">Type de la pièce d'identité :</label>
            <div class="radio">
              <label>
              <input id="CNI" name="type_piece" value="0" type="radio" class="ace" checked /><span class="lbl">Carte nationale d'identité</span>
              </label>
              <label><input id="Permis" name="type_piece" value="1" type="radio" class="ace" /><span class="lbl">Permis de Conduire</span></label>
              <label><input id="Passeport" name="type_piece" value="2" type="radio" class="ace" /><span class="lbl">Passeport</span></label>
            </div>
          </div>
          <div class="mb-3">
            <label for="num_piece">N° pièce :</label>
            <input type="text" id="num_piece" class="form-control" placeholder="N° pièce..."/>
          </div>
          <div class="mb-3">
            <label for="num_piece">Délivré le :<span class="red">*</span></label>
            <input class="form-control date-picker" id="date_piece_id" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD"/>
          </div>
          <div class="mb-3">
            <label for="num_piece"><i class="fa fa-map-marker light-orange"></i>Adresse :</label>
            <input class="form-control" id="adresse_h" placeholder="Adresse..." />
          </div>
          
          <div class="form-froup">
            <label for="mobile_h">Mob :</label>
            <div class="input-group col-sm-12">
              <span class="input-group-addon fa fa-phone"></span>
              <input type="tel" id="mobile_h" class="form-control mobile" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
              <span class="tel validity input-group-text"></span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-info btn-xs btn-submit" id ="EnregistrerGardeMalade" value="add"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
       <button type="button" class="btn btn-warning btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
      </div>
    </div>
  </div>
</div>