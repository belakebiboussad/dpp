<div class="modal fade" id="Ordonnance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog  modaldialog modal-lg" >
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Ajouter une Ordonnance</strong></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6 col-xs-12">
            <table id="medc_table" class="table table-bordered table-hover" width=100%> 
              <thead>
                <tr> <th class="center"><strong>Médicament</strong></th><th class="center priority-3"><strong>Forme</strong></th>
                  <th class="center"><strong>Dosage</strong></th> <th class="center"><em class="fa fa-cog"></em></th></tr></thead>
            </table>
          </div>
          <div class="col-sm-6 col-xs-12">
             <div class="row">
             <div  class="col-sm-9 col-xs-12">
                   <input type="text" id="id_medicament" name="id_medicament" hidden>
                   <label for="nommedic"><strong>Nom Médicament :</strong></label>
                   <input id="nommedic" class="form-control" type="text"  placeholder="Médicament" readonly/>
             </div>
              <div  class="col-sm-3 hidden-xs">
                   <label for="form-field-8"> <strong>Forme :</strong> </label>  
                   <input id="forme" class="form-control" type="text"  placeholder="Forme" readonly/>
              </div>
            </div><div class="space-12 hidden-xs"></div>{{-- row --}}
            <div class="row">
              <div class="col-xs-6">
                   <label for="dosage">Dosage:</label><input type="text" class="form-control" id="dosage" placeholder="Dosage..." readonly>
              </div>
            </div><div class="space-12 hidden-xs"></div>
            <div class="row">
              <div class="col-xs-12">
                <label for="posologie_medic">Posologie:</label>
                <input type="text" class="form-control disabledElem" id="posologie_medic" placeholder="Posologie...">
              </div>
            </div><div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>     
             <div class="row">
              <div class="col-xs-12">
                    <button type="button" id="addliste" class="btn btn-primary btn-xs pull-right disabledElem" onclick="addmidifun()">
                         Ajouter&nbsp;<i class="fa fa-arrow-down" ></i>
                     </button>
              </div>
            </div>
          </div>
       </div>
       <div class="row">
          <div class="col-sm-12 col-xs-12 widget-container-col">
            <div class="widget-box widget-color-warning"> 
              <div class="widget-body"><!-- tablebody -->
                <table id="ordonnance" class="table table-striped"> 
                  <thead>
                    <tr>
                      <th hidden>id</th>
                      <th class="center">Médicament</th>
                      <th class="center priority-5">Forme</th>
                      <th class="center priority-5">Dosage</th>
                      <th class="center">Posologie</th>
                      <th class="center bleu"><em class="fa fa-cog"></em></th>
                    </tr>   
                  </thead>
                  <tbody ></tbody> 
                </table>
              </div>{{-- widget-body --}}
            </div>{{-- widget-box --}}
          </div>{{-- widget-container-col --}}
      </div><!-- /.row -->
    </div>
    <div class="modal-footer">
         <button type="button" class="btn btn-info btn-sm" data-dismiss="modal" onclick="storeord()"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
        <button type="button"  id ="drugsPrint" class="btn btn-success btn-sm"  data-dismiss="modal"><i class="ace-icon fa fa-print  bigger-110"></i>Imprimer</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
      </div>
  </div>
</div>
  


