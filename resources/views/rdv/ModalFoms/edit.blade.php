  <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      <h4 class="modal-title">Modifier le rendez-vous du <q><a href="#" id="lien" class="white"></a></q></h4>
    </div>
      <div class="modal-body">
      <form id ="updateRdv" role="form" action="" method="POST"> 
      <input type="hidden" id="idRDV">
      <input id="daterdv" type="hidden" /><input id="datefinrdv" type="hidden" />
      <input type="hidden" id="medecinRequired" name="medecinRequired" value="">
      <div class="row">
       <div class="col-sm-12">
         @if(Auth::user()->is(15))
          <div class="panel panel-default">
          <div class="panel-heading"><span>Selectionner une spécialité</span></div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-form-label blue" for="specialite">Spécialité</label>  
              <select class="form-control specialite" id="specialite">
                <option value="" selected disabled> Selectionner...</option>
                @foreach($specialites as $specialite)
                <option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
                 @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="panel panel-default hidden docPanel">
          <div class="panel-heading">
          <i class="ace-icon fa  fa-user-md"></i><span> Selectionner une médecin</span></div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-form-label blue">Médecin</label>  
                <select class="form-control" id="employ_id">
                  <option value="" selected="selected">Selectionner...</option>
                </select>
            </div>
          </div>
        </div>
        @endif
        <div class="panel panel-default">
          <div class="panel-heading"><i class="ace-icon fa fa-user"></i> Patient</div>
          <div class="panel-body">
            <div class="form-group col-sm-4">
              <label class="blue">patient</label>
               <input type="text" id="nomPatient" readonly>
            </div>        
            <div class="form-group col-sm-4">
          <div class="input-group">
            <span class="input-group-addon fa fa-phone"></span>
          <input type="text" id="patient_tel"  class="form-control" readonly/>
          </div>
        </div>
            <div class="form-group col-sm-4">
              <input type="number" id="agePatient" readonly><small> Ans</small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <fieldset class="scheduler-border">
              <legend>Date</legend>
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
              <legend class="scheduler-border">Type</legend>
              <div class="control-group">
                <div class="controls form-check">
                  <label class="block"><input type="checkbox" class="ace" id="fixe" {{ (Auth::user()->is(15)) ? 'disabled' : '' }} /> <span class="lbl">Fixe</span></label>
                </div>
             </div>
            </fieldset>
          </div> 
        </div>
        </div>  
      </div>
    </div> {{-- modal-body --}} 
    <div class="modal-footer">
      @if(Auth::user()->isIn([1,13,14]))
        <a id="btnConsulter" class="btn btn btn-xs btn-success" href="#" >  <i class="fa fa-stethoscope" aria-hidden="true"></i> Consulter</a>
      @endif 
      <button type="button" id ="updateRDV" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer</button>      
        <button  type="button" id="btnDelete" class="btn btn-bold btn-xs btn-danger" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal"> <i class="fa fa-trash" aria-hidden="true"></i> Supprimer</button>
        <a id="printRdv" class="btn btn-success btn-xs hidden"  aria-hidden="true" target="_blank"> <i class="ace-icon fa fa-print"></i>Imprimer</a>
       <button type="button" class="btn btn-xs btn-warning" data-dismiss="modal"  id ="btnclose" onclick="reset_in();"><i class="fa fa-undo" aria-hidden="true" ></i> Annuler</button>
    </div>
  </form>  
  </div>{{-- modal-content --}}
</div>
</div>{{-- modal --}}