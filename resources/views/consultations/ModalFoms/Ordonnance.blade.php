<div class="modal fade" id="Ordonnance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modaldialog" >
    <div class="modal-content contmodal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel"><strong>Ajouter une Ordonnance</strong></h4>
      </div>
      <div class="modal-body bodyodal">
        <div class="row">
          <div class="col-sm-6">
            <table id="medc_table" class="table table-striped table-bordered table-hover" width=100%> 
              <thead>
                    <tr>
                          <th class="center"><strong>Médicament</strong></th>
                          <th class="center"><strong>Forme</strong></th>
                          <th class="center"><strong>Dosage</strong></th>
                          <th class="center"><em class="fa fa-cog"></em></th>
                    </tr>
              </thead>
            </table>
          </div>
          <div class="col-sm-6">
          <form action="">
            <div class="row">
              <div  class="col-xs-9">
                <input type="text" id="id_medicament" name="id_medicament" hidden>
                <label for="nommedic"><strong>Nom Médicament :</strong></label>
                <input id="nommedic" class="form-control" type="text"  placeholder="Médicament" readonly/>
              </div>
              <div  class="col-xs-3">
                <label for="form-field-8">
                  <strong>Forme :</strong>  
                </label>
                <input id="forme" class="form-control" type="text"  placeholder="Forme" readonly/>
              </div>
            </div>{{-- row --}}
            <div class="space-12"></div>
            <div class="row">
              <div class="col-xs-6">
                <label for="dosage">Dosage:</label>
                <input type="text" class="form-control" id="dosage" placeholder="Dosage..." readonly>
              </div>
            </div>
            <div class="space-12"></div>
            <div class="row">
              <div class="col-xs-12">
                <label for="posologie_medic">Posologie:</label>
                <input type="text" class="form-control disabledElem" id="posologie_medic" placeholder="Posologie...">
              </div>
            </div>     
            <div class="space-12"></div>
            <div class="space-12"></div>
            <div class="row">
              <div class="col-xs-12">
                    <button type="button" id="addliste" class="btn btn-primary btn-xs pull-right disabledElem" onclick="addmidifun()">
                         Ajouter a la liste&nbsp;<i class="fa fa-arrow-down" ></i>
                     </button>
              </div>
            </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 widget-container-col" id="widget-container-col-2">
            <div class="widget-box widget-color-warning" id="widget-box-2">
              <div class="widget-header">
                <h5 class="widget-title text-info lighter"><strong>Ordonnance:</strong></h5>
                <div class="widget-toolbar widget-toolbar-light no-border pull-right" >
                  <button type="button" class="btn btn-xs btn-transparent  my-right-float">
                    <i class="ace-icon fa fa-pencil green"></i>
                  </button> 
                </div> 
              </div>  {{-- widget-header --}}{{-- 138px; --}}
              <div class="widget-body">
                <div class="widget-main" style="margin-top:-0.50%;height:175px;overflow:scroll;">
                  <div class="row">
                    <table id="ordonnance" class="table  table-bordered table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th hidden>id</th>
                          <th>Médicament</th>
                          <th>Forme</th>
                          <th>Dosage</th>
                          <th>Posologie</th>
                          <th class="bleu center"><em class="fa fa-cog"></em></th>
                        </tr>
                      </thead>
                    </table>
                  </div>  {{-- row --}}
                </div>{{-- widget-main --}}
              </div>{{-- widget-body --}}
            </div>{{-- widget-box --}}
          </div>{{-- widget-container-col --}}
      </div><!-- /.row -->
      </div>
      <div class="modal-footer" style="width:100%">  
        <div style="bottom:0; padding-right:1.2%">
          <button type="button" class="btn btn-primary btn-xs" data-dismiss="modal" onclick="storeord1()"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
          <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#ord" data-dismiss="modal" onclick="createord('{{ $patient->Nom }} {{ $patient->Prenom }}','{{ $patient->Dat_Naissance }}','{{ $patient->code_barre }}',{{ $patient->getAge()}},'{{ Auth::User()->employ->Nom_Employe }} {{ Auth::User()->employ->Prenom_Employe }}')">
            <i class="ace-icon fa fa-print"></i>Imprimer
          </button>
          {{-- @include('consultations.ModalFoms.imprimerOrdonnance') --}}
         
           <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" type="reset"> <i class="ace-icon fa fa-undo bigger-110"></i> Annuler</button>
        </div>
      </div>
    </div>
  </div>
</div>
  


