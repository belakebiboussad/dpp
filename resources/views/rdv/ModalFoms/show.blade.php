<div class="modal fade" id="showfullCalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h5 class="modal-title" id="exampleModalLabel">Rendez-Vous <q><a href="" id="lien" class="white"></a></q></h5>
            </div>
            <form id ="updateRdv" role="form" >  
            <div class="modal-body">
              <input type="hidden" id="idRDV"><input type="hidden" id ="civiliteCode">
              <input type="hidden" id ="specialiteId">
              <div class="row">
                <label class="col-sm-4 form-control-label text-right justify-content-start">Patient :</label>
                <div class="col-sm-8">
                  <input id="nomPatient" class="form-control" readonly />
                </div>
              </div><div class="space-12"></div>
              <div class="row">
                <label class="col-sm-4 form-control-label text-right justify-content-start">Âge :</label>
                <div class="input-group col-sm-8 ml-2"> 
                  <input id="agePatient" type="text" class="form-control ml-1" readonly>
                    <span class="input-group-addon"><small>(Ans)</small></span>
                </div>
              </div><div class="space-12"></div>
               <div class="row">
                <label class="col-sm-4 form-control-label text-right justify-content-start"><i class="fa fa-phone"></i>&nbsp;Téléphone :</label>
                <div class="col-sm-8">
                  <input id="patient_tel" class="form-control" readonly />
                </div>
              </div><div class="space-12"></div>
               <div class="row">
                <label class="col-sm-4 form-control-label text-right justify-content-start">Spécialité :</label>
                <div class="col-sm-8">
                  <input id="specialiteName" class="form-control" readonly />
                </div>
              </div><div class="space-12"></div>
              @isset($appointDoc)
              <div class="row">
                <label class="col-sm-4 form-control-label text-right justify-content-start">Médecin :</label>
                <div class="col-sm-8">
                  <input id="medecinName" class="form-control" readonly />
                </div>
              </div><div class="space-12"></div>
              @endisset
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
              @if(in_array(Auth::user()->role->id,[1,13,14]))
               <a  id="btnConsulter" class="btn btn-primary btn-xs"><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
              @endif 
              <a id="printRdv" class="btn btn-xs btn-success"  data-dismiss="modal">
                <i class="ace-icon fa fa-print"></i>Imprimer
              </a>
              <a id="printTck" class="btn btn-info btn-xs hidden"  data-dismiss="modal"><i class="ace-icon fa fa-print"></i>Imprimer Ticker</a>
              <button type="button" class="btn  btn-default btn-xs" data-dismiss="modal" id ="btnclose" >
                   <i class="fa fa-close" aria-hidden="true" ></i>&nbsp;Annuler
              </button>
            </div>
            </form>
        </div>
    </div>
</div>