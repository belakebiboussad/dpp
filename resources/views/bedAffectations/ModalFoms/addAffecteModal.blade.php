<div id="bedAffectModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalBedaffect" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   <div  class="modal-content custom-height-modal">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 id="myModalBedaffect"> Affecter un lit</h4>
        </div>
          <form id="modalFormData" name="modalFormData" method="POST" class="form-horizontal" novalidate="">
        {!! csrf_field() !!}
        <input type="hidden" class="demande_id" name="demande_id">
        <input type="hidden" id="patient_id" name="patient_id">
        <input type="hidden" class="affect" value="1" >
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label" for="heureSortiePrevue">Service : </label>
              <div >
               <select  class="form-control selectpicker serviceHosp"/>
                 <option value="" selected  disabled>Selectionnez un service</option>
                  @foreach($services as $service)
                  <option value="{{ $service->id }}">{{ $service->nom }}</option>
                  @endforeach
               </select>
               </div>  
              </div>
              <div class="form-group">
                <label class="control-label" for="salle">Salle :</label>
                <div >
                  <select  class="form-control selectpicker salle" disabled/>
                    <option value="0" selected>Selectionnez une salle</option>
                  </select>
               </div>  
              </div>
                <div class="form-group row">
                  <label class="control-label" for="lit_id">Lit :</label>
                  <div >
                    <select  class="form-control selectpicker lit_id" required disabled/>
                      <option value="" selected disabled>Selectionnez un lit</option>
                    </select>
               </div>  
              </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary btn-xs" id='AffectSave' disabled><i class="ace-icon fa fa-save"></i>Enregistrer</button>
          <button class="btn btn-xs btn-warning" data-dismiss="modal" aria-hidden="true"><i class="ace-icon fa fa-undo"></i>Annuler</button></button>
       </div>
       </form>
      </div>
      </div>
  </div>