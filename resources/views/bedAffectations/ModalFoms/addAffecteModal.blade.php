<div class="modal" id="bedAffectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"  id="exampleModalLongTitle">Affecter un lit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" class="demande_id" name="demande_id">
          <input type="hidden" id="patient_id" name="patient_id"><input type="hidden" class="affect" value="1"> 
          <div class="form-group">
            <label class="col-form-label">Service : </label>
             <select  class="form-control selectpicker serviceHosp"/>
             <option value="" selected  disabled>Selectionnez un service</option>
              @foreach($services as $service)
              <option value="{{ $service->id }}">{{ $service->nom }}</option>
              @endforeach
           </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Salle :</label>
            <select  class="form-control selectpicker salle" disabled/>
              <option value="" selected disabled>Selectionnez une salle</option>
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Lit :</label>
            <select  class="form-control selectpicker lit_id" disabled/>
              <option value="" selected disabled>electionnez un lit</option>
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-xs" id='AffectSave' disabled><i class="ace-icon fa fa-save"></i>Enregistrer</button>
        <button class="btn btn-xs btn-warning" data-dismiss="modal" aria-hidden="true"><i class="ace-icon fa fa-undo"></i>Annuler</button>
      </div>
    </div>
  </div>
</div>