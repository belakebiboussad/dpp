<div id="rdvHModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div  class="modal-content custom-height-modal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-clock-o 2x" aria-hidden="true"></i>&nbsp; Ajouter un Rendez-Vous</h4>
      </div>
      <form id"rdvHAddForm" method="POST"  class="form-horizontal"  action="{{  route('rdvHospi.store') }}">
        {!! csrf_field() !!}
        <input type="hidden" name="demande_id" id="demande_id"  class="demande_id">
        <input type="hidden"  class="affect" value="0">
      <div class="modal-body">
               <div class="form-group">
                        <label class="control-label" for="dateEntree">Date entrée :</label>
                        <div class="input-group">
                            <input type="text" name ="dateEntree" id="dateEntree" class="date-picker form-control"  data-date-format="yyyy-mm-dd" autocomplete ="off" required>
                            <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
                        </div>
               </div>
               <div class="form-group">
                        <label class="control-label" for="heure">Heure entrée </label>
                        <div class="input-group">
                             <input type="text" name ="heure" id ="heure" class="form-control timepicker1"  required>
                               <div class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></div>
                     </div>  
                </div>
                   <div class="form-group">
                        <label class="control-label" for="numberDays">Durée :</label>
                        <div class="input-group">
                             <input id="numberDays" min="0" max="50" value="0" class="form-control" type="number" required>
                               <span class="input-group-addon">nuit(s)</span>      
                     </div> 
                     </div>
                     <div class="form-group">
                        <label class="control-label" for="dateSortiePre">Date sortie :</label>
                        <div class="input-group">
                            <input type="text" name ="dateSortiePre" id="dateSortiePre" class="date-picker form-control"  data-date-format="yyyy-mm-dd" autocomplete ="off" onchange="updateDureePrevue()" required>
                            <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
                        </div>
                      </div> 
                       <div class="form-group">
                                <label class="control-label" for="heureSortiePrevue">Heure sortie :</label>
                                <div class="input-group">
                                     <input type="text" name ="heureSortiePrevue" id ="heureSortiePrevue" class="form-control timepicker1"  required>
                                       <div class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></div>
                             </div>  
                      </div>
                      <div class="form-group">
                        <label class="control-label">Service : </label>
                        <select class="form-control selectpicker  serviceHosp"/>
                          <option value="" selected>Selectionnez un service</option>
                          @foreach($services as $service)
                          <option value="{{ $service->id }}">{{ $service->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Salle :</label>
                        <select  class="form-control selectpicker salle"/>
                          <option value="0" selected>Selectionnez une salle</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Lit :</label>
                        <select  name="lit" class="form-control selectpicker lit_id"/>
                          <option value="" selected disabled>Selectionnez un lit</option>
                        </select>   
                      </div>
      </div> 
      <div class="modal-footer">
       <button  type="submit" class="btn btn-info btn-xs"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp; &nbsp; 
          <button class="btn btn-warning btn-xs" data-dismiss="modal"><i class="ace-icon fa fa-undo"></i>Annuler</button>
    </div>
    </form>
    </div>
    </div>
    </div>