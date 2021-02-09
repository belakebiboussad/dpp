<div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
   		 <div class="modal-content">
      		<div class="modal-header">
        			<h5 class="modal-title"><span class="glyphicon glyphicon-bell"></span>&nbsp;Détails du Rendez-Vous de &nbsp; <q><a href="" id="lien" class="white"></a></q></h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button><hr>
        			<div class="row">
                     	<div class="col-sm-6"> <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="white"></span></div>
                     	<div class="col-sm-6"><strong>Âge:&nbsp;</strong><span id="agePatient" class="white"></span> <small>Ans</small></div>
                </div>       
      		</div>
      		<form id ="updateRdv" role="form" method="POST"> 
      		<div class="modal-body">
          		      <input type="hidden" id="idRDV">
                      <div class="well">   
                          <div class="row">
                               <div class="col-sm-12">
                                    <div class="form-group">
                                         <label for="doctor" class="col-form-label" ><i class="ace-icon fa  fa-user-md bigger-130"></i><strong>&nbsp;Medecin:</strong></label>
                                          <div class="input-group col-sm-12"><input type="text"  class="form-control" id="doctor" name ="doctor"  disabled/> </div>  
                                     </div>
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
                                    <fieldset class="scheduler-border">
                                          <legend class="scheduler-border">Type Rendez-Vous</legend>
                                          <div class="control-group">
                                               <label class="control-label input-label" for="startTime">&nbsp;</label>
                                               <div class="controls form-check">
                                                    <label class="block"><input type="checkbox" class="ace" id="fixecbx" name="fixecbx" disabled/> <span class="lbl">Fixe </span>
                                                     </label>
                                               </div>
                                         </div>
                                      </fieldset>      
                                </div> 
                          </div>  
                     </div>
          		</div>
                <div class="modal-footer">
                @if(Auth::user()->role->id == 1)
                     <a  id="btnConsulter" class="btn btn btn-primary"><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
                @endif 
                <a  id="printRdv" class="btn btn-success hidden"  data-dismiss="modal"> <i class="ace-icon fa fa-print"></i>Imprimer</a>
               <button type="button" class="btn btn-default" data-dismiss="modal"  id ="btnclose" onclick="resetPrintModIn();">
                     <i class="fa fa-close" aria-hidden="true" ></i>&nbsp;Annuler
                </button>
                </div>
      		</form>
      	</div>
      </div>
</div>