<div class="modal fade" id="showfullCalModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
   	<div class="modal-content">
      <div class="modal-header">  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            <h4 class="modal-title">Détails du rendez-vous du &nbsp; <q><a href="" id="lien" class="white"></a></q></h4>
      </div>
      <form id ="updateRdv" role="form" > 
        <div class="modal-body">
          <input type="hidden" id="idRDV">
          <input type="hidden" id ="civiliteCode">
          <input type="hidden" id ="specialiteId">
          <div class="row">
            <div class="col-sm-6"><i class="fa fa-phone" aria-hidden="true"></i>
              <strong>&nbsp;Téléphone :</strong><span id="patient_tel" ></span>
            </div>
            <div class="col-sm-6"><strong>&nbsp;Âge :</strong> <span id="agePatient"></span><small>Ans</small></div>
          </div><div class="space-12"></div>
           <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label  class="col-form-label" ><strong>&nbsp;Spécialité:</strong></label>
                  <select class="form-control" id="specialite" disabled> -->
                    @foreach($specialites as $specialite)
                      <option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
                    @endforeach -->
                  </select>
                </div>
              </div>
            </div>
              <div class="row">
                 <div class="col-sm-6">
                 <fieldset class="scheduler-border">
                       <legend class="scheduler-border">Rendez-vous</legend>
                      <div class="control-group">
                            <label class="control-label input-label" for="startTime">Date :</label>
                            <div class="controls bootstrap-timepicker">
                                <input type="hidden" name="" id="daterdvHidden">
                                <input type="text" class="datetime" id="daterdv" name="daterdv" data-date-format="yyyy-mm-dd HH:mm" readonly   />
                                <span class="glyphicon glyphicon-time fa-lg"></span> 
                            </div>
                       </div>
                 </fieldset>
                  </div>
                   <div class="col-sm-6">
                        <fieldset class="scheduler-border">
                              <legend class="scheduler-border">Type rendez-vous</legend>
                              <div class="control-group">
                                   <label class="control-label input-label">&nbsp;</label>
                                   <div class="controls form-check">
                                   <label class="block"><input type="checkbox" class="ace" id="fixecbx" disabled/><span class="lbl">Fixe </span></label> 
                                   </div>
                             </div>
                          </fieldset>      
                    </div> 
              </div>  
        </div>
        <div class="modal-footer">
        @if(Auth::user()->role->id == 1)
             <a  id="btnConsulter" class="btn btn btn-primary"><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
        @endif 
        <a  id="printRdv" class="btn btn-success"  data-dismiss="modal"> <i class="ace-icon fa fa-print"></i>Imprimer</a>
        <a  id="printTck" class="btn btn-info hiden"  data-dismiss="modal"> <i class="ace-icon fa fa-print"></i>Imprimer Ticker</a>
        <button type="button" class="btn btn-default" data-dismiss="modal"  id ="btnclose" >
             <i class="fa fa-close" aria-hidden="true" ></i>&nbsp;Annuler
        </button>
        </div>
	</form>
      	</div>
      </div>
</div>