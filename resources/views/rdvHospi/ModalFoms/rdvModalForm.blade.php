<div id="rdvHModal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div  class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-clock-o 2x" aria-hidden="true"></i> Ajouter un Rendez-Vous</h4>
      </div>
      <form id="rdvHAddForm" method="POST" action="{{ route('rdvHospi.store') }}">
        {!! csrf_field() !!}
        <input type="hidden" name="demande_id" id="demande_id"  class="demande_id">
        <input type="hidden"  class="affect" value="0">  
        <div class="modal-body">
         <div class="form-group">
            <label class="col-form-label" for="dateEntree">Date entrée</label>
            <div class="input-group">
              <input type="text" name ="dateEntree" class="date-picker form-control date"  data-date-format="yyyy-mm-dd" required><span class="input-group-addon fa fa-calendar"></span> 
            </div>
          </div>
          <div class="form-group">
            <label class="col-form-label" for="heure">Heure entrée</label>
            <div class="input-group">
              <input type="text" name ="heure" id ="heure" class="form-control timepicker1"  required>
              <span class="input-group-addon fa fa-clock-o"></span>
            </div>  
          </div>
          <div class="form-group">
            <label class="col-form-label" for="numberDays">Durée</label>
            <div class="input-group">
              <input min="0" max="50" value="0" class="form-control numberDays" type="number" required>
               <span class="input-group-addon">nuit(s)</span>      
            </div> 
          </div>
          <div class="form-group">
            <label class="col-form-label" for="dateSortiePre">Date sortie</label>
            <div class="input-group">
              <input type="text" name ="dateSortiePre" class="date-picker form-control date_end"  data-date-format="yyyy-mm-dd" required>
              <span class="input-group-addon fa fa-calendar"></span>  
            </div>
          </div>
          <div class="form-group">
            <label class="col-form-label" for="heureSortiePrevue">Heure sortie</label>
            <div class="input-group">
              <input type="text" name ="heureSortiePrevue" id ="heureSortiePrevue" class="form-control timepicker1"  required>
              <span class="input-group-addon fa fa-clock-o"></span>
           </div>  
          </div>
          <div class="form-group">
            <label class="col-form-label">Service</label>
            <select class="form-control selectpicker  serviceHosp"/>
              <option value="" selected>Selectionnez un service</option>
              @foreach($services as $service)
              <option value="{{ $service->id }}">{{ $service->nom }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label">Salle</label>
            <select  class="form-control selectpicker salle" disabled/>
              <option value="" selected>Selectionnez une salle</option>
            </select>
          </div>
          <div class="form-group">
            <label class="col-form-label" disabled>Lit</label>
            <select  name="lit" class="form-control selectpicker lit_id" disabled />
              <option value="" selected disabled>Selectionnez un lit</option>
            </select>   
          </div> 
        </div>
        <div class="modal-footer">
        <button  type="submit" class="btn btn-info btn-xs"><i class="ace-icon fa fa-save"></i>Enregistrer</button> 
        <button class="btn btn-warning btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
      </div>
      </form>
    </div>
  </div>
</div>
