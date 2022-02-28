      <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  {{-- Modal --}}
       <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                       <h5 class="modal-title" id="myModalLabel">
                             <span class="glyphicon glyphicon-bell"></span>Modifier le rendez-vous du
                             <i class="ace-icon fa fa-angle-double-left" style="font-size:20px;"></i>
                             <a href="" id="lien" style="color:#FFFFFF"> <p id="patient"></p></a>
                            <i class="ace-icon fa fa-angle-double-right" style="font-size:20px;"></i>
                       </h5><hr>
                       <div class="row">
                            <div class="col-sm-6">    
                                  <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" style="color:#FFFFFF"></span>
                            </div>
                            <div class="col-sm-6"><strong>Âge:&nbsp;</strong><span id="agePatient" class="badge badge-info" ></span><small>Ans</small>
                            </div>
                      </div> 
              </div>
          <form id ="updateRdv" role="form" action="" method="POST"> 
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <input type="hidden" id="idRDV">
              <input  id="datefinrdv" name ="datefinrdv" type="hidden" />
              @if(Auth::user()->role->id == 2)
              <div class="well">
                <div class="row">
                  <div class="col-sm-12">                   
                    <label for="medecin"><i class="ace-icon fa  fa-user-md bigger-130"></i><strong>&nbsp;Medecin:</strong></label>
                    <div class="input-group">
                      <select id="medecin" name ="medecin" autocomplete="off" style="width:300px;">
                        <option value="">Selectionner....</option>
                      </select> 
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
                                      <input type="text" class="datetime" id="daterdv" name="daterdv" data-date-format="yyyy-mm-dd HH:mm" readonly   />
                                      <span class="glyphicon glyphicon-time fa-lg"></span> 
                                  </div>
                           </div>
                    </fieldset>
                  </div>
                  <div class="col-sm-6">
                    <fieldset class="scheduler-border" style="height:126px;">
                      <legend class="scheduler-border">Type rendez-vous</legend>
                        <div class="form-group">
                          <div class="form-check">
                            <br>
                            <label class="block">
                              <input type="checkbox" class="ace" id="fixe" name="fixe" />
                              <span class="lbl">Fixe </span>
                            </label>
                          </div>
                        </div>
                    </fieldset>      
                  <br>
                  </div> 
              </div>
            </div>  
            </div> {{-- modal-body --}} 
            <div class="modal-footer">
              @if(Auth::user()->role->id == 1)
              <a type="button" id="btnConsulter" class="btn btn btn-xs btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
              @endif 
              <button type="submit" id ="updateRDV" class="btn btn-primary btn-xs">
                <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer
              </button>
              @if(Auth::user()->role->id == 1)          
              <a  href="" id="btnDelete" class="btn btn-bold btn-xs btn-danger" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal">  <i class="fa fa-trash" aria-hidden="true"></i> Annuler
              </a>
              @endif
              <a  href ="#" id="printRdv" class="btn btn-success btn-xs hidden"  data-dismiss="modal"> <i class="ace-icon fa fa-print"></i>Imprimer </a> 
              <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"  id ="btnclose" onclick="reset_in();">
                <i class="fa fa-close" aria-hidden="true" ></i> Fermer
              </button>
            </div> {{-- modal-header --}}
          </form>  
        </div>{{-- modal-content --}}
      </div>
    </div>{{-- modal --}}