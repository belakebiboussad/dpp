<div id="patientSelect" class="modal fade">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        </div>
        <div id="modalBody" class="modal-body" style="padding:40px 50px;">
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="ace-icon fa fa-user"></i><span>Selectionner un Patient</span></div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for=""> <strong>Filtre: </strong></label>
                      <div class="col-sm-9">          
                        <select class="form-control" id="filtre" onchange="layout();">
                          <option value="Nom">Nom</option>
                          <option value="Prenom">Prenom</option>
                          <option value="IPP">IPP</option>  <!-- <option value="Dat_Naissance">Date Naisssance</option> -->
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <span class="input-icon" style="margin-right: -190px;">
                    <select placeholder="Rechercher... " class="nav-search-input" id="patient" name ="patient" autocomplete="off" style="width:300px;" data-date-format="yyyy-mm-dd" required>
                      @if(isset($patient))
                        <option value="{{$patient->id}}" selected>{{ $patient->IPP }}-{{ $patient->Nom }}-{{ $patient->Prenom }}</option>
                      @endif
                    </select>
                    <i class="ace-icon fa fa-search nav-search-icon"></i>   
                    </span>   
                  </div>                               
                </div>                                                  
              </div> {{-- panel-body --}}
              <div class="space-12"></div>
            </div>{{-- panel --}}
          </div>{{-- modalBody --}}
          <div class="modal-footer">
            <button class="btn btn-xs btn-succes"  id =""><i class="ace-icon fa fa-check bigger-110"></i>&nbsp;Selectionner</button>                     
            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i>&nbsp;Annuler</button>
          </div>   
      </div>
    </div>
</div>