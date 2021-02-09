<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  {{-- Modal --}}
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header"  style="padding:35px 50px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            <h5 class="modal-title" id="myModalLabel">
              <span class="glyphicon glyphicon-bell"></span>&nbsp;Détails le Rendez-Vous du <q><a href="" id="lien" class="white"><!-- <span id="patient"></span> --></a></q>
            </h5>
            <hr>
            <div class="row">
              <div class="col-sm-6">    
                <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="white"></span>
              </div>
              <div class="col-sm-6"><strong>Âge:&nbsp;</strong><span id="agePatient" class="white"></span> <small>Ans</small></div>
            </div>
          </div>
        <form id ="updateRdv" role="form" action="" method="POST"> 
             <div class="modal-body">
                    <input type="hidden" id="idRDV">         
                    <div class="well">      
                          <div class="row">
                                <label for="doctor"><i class="ace-icon fa  fa-user-md bigger-130"></i><strong>&nbsp;Medecin:</strong></label>
                                 <div class="input-group">
                                     <input type="text" id="doctor" name ="doctor" style="width:300px;" disabled/>
                                 </div>
                    </div>
                    </div>
                   <div class="well">
                         <div class="row">
                                <div class="col-sm-6">
                                       <fieldset class="scheduler-border">
                                             <legend class="scheduler-border">Rendez-Vous</legend>
                                              <div class="control-group">
                                                <label class="control-label input-label" for="startTime">Date :</label>
                                                <div class="controls bootstrap-timepicker">
                                                  <input type="text" class="datetime" id="daterdv" name="daterdv" data-date-format="yyyy-mm-dd HH:mm" readonly   />
                                                  <span class="glyphicon glyphicon-time fa-lg"></span> 
                                                </div>
                                              </div>
                                       </fieldset>
                                </div>
                                <div class="col-sm-6">
                                       <fieldset class="scheduler-border"   style="height:126px;">
                                             <legend class="scheduler-border">Type Rendez-Vous</legend>
                                             <div class="form-group">
                                                   <div class="form-check">
                                                    <br>
                                                    <label class="block">
                                                      <input type="checkbox" class="ace" id="fixecbx" name="fixecbx" disabled/>
                                                      <span class="lbl">Fixe </span>
                                                    </label>
                                                    </div>
                                             </div>
                                      </fieldset>      
                                       <br>
                                </div> 
                          </div>
                    </div>
              </div>  
            <div class="modal-footer">
            @if(Auth::user()->role->id == 1)
             <a  id="btnConsulter" class="btn btn btn-xs btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
            @endif 
             <a  href ="#" id="printRdv" class="btn btn-success btn-xs hidden"  data-dismiss="modal">
                <i class="ace-icon fa fa-print"></i>Imprimer
             </a>
             <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"  id ="btnclose" onclick="resetPrintModIn();">
                <i class="fa fa-close" aria-hidden="true" ></i> Fermer
             </button>
          </div>
        </form>  
    </div>  {{-- modal-content --}}
  </div> {{-- modal-dialog --}}
</div>{{-- modal --}}