  <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      <h4 class="modal-title">Modifier le rendez-vous du&nbsp;<q><a href="" id="lien" class="white"></a></q></h4>
    </div>
      <div class="modal-body">
      <form id ="updateRdv" role="form" action="" method="POST"> 
      <input type="hidden" id="idRDV"><input  id="daterdv" type="hidden" /><input id="datefinrdv" type="hidden" />
      
      <div class="row">
        <div class="col-sm-6"><i class="fa fa-phone" aria-hidden="true"></i>
          <strong>&nbsp;Téléphone :</strong><span id="patient_tel" ></span>
        </div>
        <div class="col-sm-6"><strong>&nbsp;Âge :</strong><span id="agePatient"></span><small>Ans</small></div>
      </div><div class="space-12"></div>
      @if(Auth::user()->role->id == 2)
        <div class="panel panel-default">
        <div class="panel-heading">&nbsp;<span>Selectionner une spécialité</span></div>
        <div class="panel-body">
          <div class="form-group">
            <label class="col-form-label" for=""><strong>Spécialité :</strong></label>  
            <select class="form-control specialite" id="specialite">
              <option value="" selected disabled> Selectionner...</option>
              @foreach($specialites as $specialite)
              <option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
               @endforeach
            </select>
          </div>
        </div>
      </div>
      @isset($appointDoc)
      <div class="panel panel-default">
        <div class="panel-heading">
        <i class="ace-icon fa  fa-user-md bigger-110"></i>&nbsp;<span>Selectionner une médecin</span></div>
        <div class="panel-body">
          <div class="form-group">
            <label class="col-form-label"><strong>Médecin :</strong></label>  
              <select class="form-control" id="employ_id" disabled>
                <option value="" selected="selected">Selectionner...</option>
              </select>
          </div>
        </div>
      </div>
      @endisset
      @endif
      <div class="panel panel-default">
        <div class="panel-heading">&nbsp;<span>Patient</span></div>
        <div class="panel-body">
          <div class="form-group">
            <label class="col-form-label" for=""><strong>patient :</strong></label> 
            <input id="nomPatient" class="form-control" value="" readonly /> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <fieldset class="scheduler-border">
            <legend>Date rendez-Vous</legend>
            <div class="control-group">
              <div class="controls">
                <input type="text" class="datetime" id="meetingdate" data-date-format="yyyy-mm-dd" readonly/>
                <span class="glyphicon glyphicon-time fa-lg"></span> 
              </div>
            </div>
          </fieldset>
        </div>
        <div class="col-sm-6">
          <fieldset class="scheduler-border">
            <legend class="scheduler-border">Type rendez-vous</legend>
            <div class="control-group">
              <div class="controls form-check">
                <label class="block"><input type="checkbox" class="ace" id="fixe" {{ (Auth::user()->role_id == 2) ? 'disabled' : '' }} /> <span class="lbl">Fixe </span></label>
              </div>
           </div>
          </fieldset>
        </div> 
      </div>
    </div> {{-- modal-body --}} 
    <div class="modal-footer">
       @if(in_array(Auth::user()->role_id,[1,13,14]))
              <a  id="btnConsulter" class="btn btn btn-xs btn-primary" href="#" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
        @endif 
        <button type="button" id ="updateRDV" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer</button>      
        <button  type="button" id="btnDelete" class="btn btn-bold btn-xs btn-danger" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal"> <i class="fa fa-trash" aria-hidden="true"></i> Annuler</button>
        <a id="printRdv" class="btn btn-success btn-xs hidden"  data-dismiss="modal"> <i class="ace-icon fa fa-print"></i>Imprimer</a>
       <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"  id ="btnclose" onclick="reset_in();">
           <i class="fa fa-close" aria-hidden="true" ></i> Fermer</button>
    </div>
  </form>  
  </div>{{-- modal-content --}}
</div>
</div>{{-- modal --}}