<div id="bedReservModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalBedReserv" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div  class="modal-content custom-height-modal">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 id="myModalBedReserv">Réserver un lit</h4>
      </div>
      <form id="addReservationForm" method="POST" role="form">
        <input type="hidden" id="rdv_id"><input type="hidden" class ="affect" value="0">
        <input type="hidden" class="demande_id"> 
        <input type="hidden" id="dateEntree"><input type="hidden" id="dateSortiePre" >
        <div class="modal-body">
          <div class="form-group row">
            <label for="serviceh">Service :</label>
            <select id="serviceh" class="form-control selectpicker serviceHosp"/>
              <option value="" selected>Selectionnez un service</option>
              @foreach($services as $service)
              <option value="{{ $service->id }}">{{ $service->nom }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group row">
            <label for="salle">Salle :</label>
            <select id="salle" class="form-control selectpicker salle" disabled/>
              <option value="" selected disabled>Selectionnez  une salle</option>
            </select>
          </div>
          <div class="form-group row">
            <label for="lit_id">Lit :</label>
            <select id="lit_id" name="lit_id" class="form-control selectpicker lit_id" disabled required/>
              <option value="" selected disabled>Selectionnez un lit</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <div class="center bottom">
            <button class="btn btn-info btn-sm" type="submit" id="saveReservation">
              <i class="ace-icon fa fa-save"></i>Enregistrer
            </button>&nbsp;&nbsp;
            <button class="btn btn btn-sm" type="reset" data-dismiss="modal" aria-hidden="true"><i class="ace-icon fa fa-undo"></i>Annuler</button>
          </div>
        </div>
     </form>
  </div>
  </div>
  </div>
