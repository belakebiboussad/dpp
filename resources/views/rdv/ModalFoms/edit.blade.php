  <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  {{-- Modal --}}
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      <h4 class="modal-title">Modifier le rendez-vous du&nbsp; <q><a href="" id="lien" class="white"></a></q></h4>
    </div>
    <form id ="updateRdv" role="form" action="" method="POST"> 
      <div class="modal-body">
      <input type="hidden" id="idRDV"><input  id="daterdv" type="hidden" />
       <input  id="datefinrdv" type="hidden" />
       <div class="well">   
              <div class="row">
              <div class="col-sm-6">
                 <div class="form-group">
                 <label for="patient_tel" class="col-form-label" ><i class="fa fa-phone" aria-hidden="true"></i><strong>&nbsp;Téléphone :</strong></label>
                  <div class="input-group col-sm-12"><input type="text"  class="form-control" id="patient_tel"  disabled/> </div>  
                </div>
              </div>
              <div class="col-sm-6">
                  <div class="form-group">
                <label for="agePatient" class="col-form-label" ><strong>&nbsp;Âge :</strong></label>
                <div class="input-group col-sm-12"><input type="text"  class="form-control" id="agePatient" disabled/> </div>  
                </div>
              </div>
            </div>
          </div>
      @if(Auth::user()->role->id == 2)
       <div class="well">
         <div class="row">
             <div class="col-sm-12">                   
                  <label for="specialite"><i class="ace-icon fa  fa-user-md bigger-130"></i><strong>&nbsp;Spécialité:</strong></label>
                  <div class="input-group col-sm-12">
                        <select  class="form-control" id="specialite"></select>
                   </div> 
              </div>
         </div>
       </div>
      @endif
      <div class="well">
        <div class="row">
          <div class="col-sm-6">
            <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Rendez-Vous</legend>
                   <div class="control-group">
                        <label class="control-label input-label" for="startTime">Date :</label>
                        <div class="controls bootstrap-timepicker">
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
                <label class="control-label input-label">&nbsp;</label>
                <div class="controls form-check">
                     <label class="block"><input type="checkbox" class="ace" id="fixe" {{ (Auth::user()->role_id == 2) ? 'disabled' : '' }} /> <span class="lbl">Fixe </span></label>
                </div>
             </div>
            </fieldset>
           </div> 
        </div>
      </div>  
    </div> {{-- modal-body --}} 
    <div class="modal-footer">
       @if(Auth::user()->role->id == 1)
        <a  id="btnConsulter" class="btn btn btn-xs btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
        @endif 
        <button type="button" id ="updateRDV" class="btn btn-primary btn-xs"><i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer
        </button>      
        <button  type="button" id="btnDelete" class="btn btn-bold btn-xs btn-danger" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal"> <i class="fa fa-trash" aria-hidden="true"></i> Annuler</button>
                          <a id="printRdv" class="btn btn-success btn-xs hidden"  data-dismiss="modal"> <i class="ace-icon fa fa-print"></i>Imprimer</a>
       <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"  id ="btnclose" onclick="reset_in();">
           <i class="fa fa-close" aria-hidden="true" ></i> Fermer
        </button>
    </div>
  </form>  
  </div>{{-- modal-content --}}
</div>
</div>{{-- modal --}}