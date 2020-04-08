  <div class="row"  style="margin-top:-2%; margin-left:-2%;">
       <div class="col-md-12">
              <div class="panel panel-default">
                      <div class="panel-heading">
                             <div class="left"> <strong>Liste des Rendez-Vous</strong></div>
                      </div>
                      <div class="panel-body">
                              <div  class="calendar1"></div>
                      </div>
                      <div class="panel-footer">
                               <span class="badge" style="background-color:#87CEFA">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px">&nbsp;RDV fixe</span>
                                 <span class="badge" style="background-color:#378006">&nbsp;&nbsp;&nbsp;</span><span style="font-size:8px">&nbsp;RDV à fixer</span> 
                      </div>
                </div>
    </div>
  </div>





  <div class="row">
    <div class="modal fade" id="fullCalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  {{-- Modal --}}
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

    
        <div class="modal-header"  style="padding:35px 50px;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
              <h5 class="modal-title" id="myModalLabel">
                      <span class="glyphicon glyphicon-bell"></span>
                      Modifier le Rendez-Vous du <q><a href="" id="lien"><span id="patient" class="blue"> </span></a></q>
              </h5>
              <hr>
               <div class="row">
                      <div class="col-sm-6">    
                           <i class="fa fa-phone" aria-hidden="true"></i><strong>Téléphone:&nbsp;</strong><span id="patient_tel" class="blue"></span>
                      </div>
                      <div class="col-sm-6">
                               <strong>Âge:&nbsp;</strong>     {{-- <span id="agePatient" class="blue"></span><small>Ans</small> --}}
                                <span id="agePatient" class="badge badge-info" ></span><small>Ans</small>
                      </div>
             </div>
        </div>



        <div class="modal-body">
        <form id ="updateRdv" role="form" action="" method="POST">      {{-- {{route('rdv.update',5)}} /rdv/5--}}
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <input type="hidden" id="idRDV">
               <input  id="datefinrdv" name ="datefinrdv" type="hidden" />
             @if(Auth::user()->role->id == 2)
             <div class="well">
                   <div class="row">
                          <label for="medecin"><i class="ace-icon fa  fa-user-md bigger-130"></i><strong>&nbsp;Medecin:</strong></label>
                          <div class="input-group">
                                 <select  placeholder="Selectionner... " class="" id="medecin" name ="medecin" autocomplete="off" style="width:300px;">
                                       <option value="">Selectionner....</option>
                                </select> 
                          </div> 
                    </div>
             </div>
             @endif
             <div class="space-12"></div>
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
                       @if(Auth::user()->role_id == 1)
                      <div class="col-sm-6">
                              <fieldset class="scheduler-border"   style="height:126px;" >  {{-- 126 --}}
                                     <legend class="scheduler-border">Type Rendez-Vous</legend>
                                     <div class="form-group">
                                            <div class="form-check">
                                                   <br>
                                                     <label class="block">
                                                           <input type="checkbox" class="ace" id ="fixe" name ="fixe"/>
                                                           <span class="lbl"> Fixe </span>
                                                    </label>
                                          </div>
                                    </div>
                             </fieldset>      
                             <br>
                       </div> 
                      @endif       
               </div>
               </div>    <!-- </form>   -->  
      </div>   
      <div class="modal-footer">
           @if(Auth::user()->role->id == 1)
              <a type="button" id="btnConsulter" class="btn btn btn-sm btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
          @endif 
           <button type="submit" id ="updateRDV" class="btn btn-primary btn-sm  hidden">
                <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer
           </button>
            @if(Auth::user()->role->id == 1)          
                <a  href="" id="btnDelete" class="btn btn-bold btn-sm btn-danger" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal">
                  <i class="fa fa-trash" aria-hidden="true"></i> Annuler
                </a>
            @endif
               <a  href ="#" id="printRdv" class="btn btn-success btn-sm hidden"  data-dismiss="modal">
                      <i class="ace-icon fa fa-print"></i>Imprimer
               </a> 
               <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"  id ="btnclose" onclick="hideButton();">
                    <i class="fa fa-close" aria-hidden="true" ></i> Fermer
               </button>
      </div>
      </form>  
    </div>
  </div>
</div>{{-- modal --}}
</div>
</div>