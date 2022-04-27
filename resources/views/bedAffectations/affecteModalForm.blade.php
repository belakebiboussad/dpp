<div id="bedAffectModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
   <div  class="modal-content custom-height-modal">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 id="myModalLabel"> Affecter un lit</h4>
        </div>
          <form id="modalFormData" name="modalFormData" method="POST" action ="" class="form-horizontal" novalidate="">
        {!! csrf_field() !!}
        <input type="hidden" class="demande_id" name="demande_id">  <input type="hidden" id="patient_id" name="patient_id">
       <input type="hidden" class="affect" value="1" >
        <div class="modal-body">
             <div class="form-group">
                                <label class="control-label" for="heureSortiePrevue">Service : </label>
                                <div >
                                     <select  class="form-control selectpicker show-menu-arrow place_holder serviceHosp"/>
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
                                     <select  class="form-control selectpicker show-menu-arrow place_holder salle"/>
                                           <option value="0" selected>Selectionnez une salle</option>
                                     </select>
                             </div>  
                      </div>
                         <div class="form-group">
                                <label class="control-label" for="lit_id">Lit :</label>
                                <div >
                                     <select  name="lit_id" class="form-control selectpicker show-menu-arrow place_holder lit_id"/>
                                           <option value="" selected disabled>Selectionnez un lit</option>
                                     </select>
                             </div>  
                      </div>
        </div>
        <div class="modal-footer">
              <button class="btn btn-primary" id='AffectSave' disabled><i class="ace-icon fa fa-save bigger-110" ></i>Enregistrer</button>
              <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button></button>
       </div>
       </form>
      </div>
      </div>
  </div>