<div id="addRDVModal" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"><!-- style="padding:35px 50px;" -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">close</span></button>
          <h4 class="modal-title"><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i>&nbsp; Ajouter un RDV</h4>
        </div>
        <form id ="addRdv" role="form" action="/createRDV" method="POST">
          {{ csrf_field() }}
          <input type="hidden" id="Debut_RDV" name="Debut_RDV" value="">
          <input type="hidden" id="Fin_RDV" name="Fin_RDV"  value="" >
          <input type="hidden" id="fixe" name="fixe"  value="" >
          <div id="modalBody" class="modal-body" style="padding:40px 50px;">
             <div class="panel panel-default">
                <div class="panel-heading"><i class="ace-icon fa fa-user"></i><span>Selectionner un Patient</span></div>
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label class="control-label col-sm-3" for=""> <strong>Filtre: </strong></label>
                          <div class="col-sm-9">          
                            <select class="form-control" id="filtre" onchange="layout();">
                              <option value="Nom">Nom</option>
                              <option value="Prenom">Prenom</option>
                              <option value="IPP">IPP</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <span class="input-icon" style="margin-right: -190px;">
                        <!-- style="width:300px;" -->
                        <select class="nav-search-input" id="patient" name ="patient" autocomplete="off" width ="20%"  required>
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
              @if(Auth::user()->role_id == 2)
              <div class="panel-heading"><i class="ace-icon fa  fa-user-md bigger-110"></i><span>Selectionner un Medecin</span></div>
               <div class="panel-body">
                <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for=""> <strong>Specilité: </strong></label>
                      <div class="col-sm-9 overflow-auto">
                        <select class="form-control" placeholder="choisir la specialite" id="specialite" name="specialite" onchange="getMedecinsSpecialite($(this).val());">
                          @foreach($specialites as $specialite)
                          <option value="{{ $specialite->id}}">{{  $specialite->nom }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <span class="input-icon" style="margin-right: -190px;">
                      <select  placeholder="Selectionner... " class="" id="medecin" name ="medecin" autocomplete="off" style="width:300px;" disabled required>
                      </select>
                    </span>   
                  </div>                               
                </div>                                                 
              </div> {{-- panel-body --}}
              @endif
            </div>{{-- panel --}}
          </div>{{-- modalBody --}}
          <div class="modal-footer">
            <button class="btn btn-xs btn-success" type="submit" id ="btnSave" disabled><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>                     
            <button type="button" class="btn btn-xs btn-default" data-dismiss="modal" onclick="resetaddModIn();reset_in();"><i class="fa fa-close" aria-hidden="true"></i>&nbsp;Annuler</button>
          </div>   
        </form> 
      </div>
    </div>
  </div>