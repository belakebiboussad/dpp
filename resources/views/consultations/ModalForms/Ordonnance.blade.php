<div class="modal fade" id="Ordonnance" role="dialog" aria-hidden="true" overflow:hidden>
  <div class="modal-dialog  modaldialog">
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Ajouter une ordonnance</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-sm-6">  
            <input type="hidden" id="drugId" name="drugId">
            <label class="control-label" for="nommedic">Nom médicament</label>
            <input type="search" class="form-control" id="nommedic"  autocomplete="off">
            <div id="livesearch" class="list-unstyled"></div>
          </div>
          <div class="form-group col-sm-2 hidden-xs">
            <label class="control-label" for="forme">Forme</label><p class ="form-control-static" id="forme"></p>
          <p class ="form-control-static" id="forme"></p>
          </div>
          <div class="form-group col-xs-4">
            <label class="control-label" for="dosage">Dosage</label>
            <p class ="form-control-static" id="dosage"></p>
          </div>
        </div>
        <div class="form-group col-sm-12">
          <label for="posologie">Posologie</label><input type="text" class="form-control" id="posologie" placeholder="Posologie...">
        </div>
        <div class="space-12 hidden-xs"></div>
        <div class="space-12 hidden-xs"></div>     
        <div class="row">
          <div class="col-xs-12">
            <button type="button" class="btn btn-primary btn-xs pull-right" id="addDrugBtn" onclick="addmidifun()" disabled>
              Ajouter <i class="fa fa-arrow-down" ></i>
            </button>
          </div>
       </div>
       <div class="row">
          <div class="col-sm-12 col-xs-12 widget-container-col">
            <div class="widget-box widget-color-warning"> 
              <div class="widget-body">
                <table id="ordonnance" class="table table-striped"> 
                  <thead>
                    <tr>
                      <th hidden>id</th> <th class="center">Médicament</th>
                      <th class="center priority-5">Forme</th>
                      <th class="center priority-5">Dosage</th>
                      <th class="center">Posologie</th>
                      <th class="center bleu"><em class="fa fa-cog"></em></th>
                    </tr>   
                  </thead>
                  <tbody ></tbody> 
                </table>
              </div>
            </div>
          </div>
      </div><!-- /.row -->
    </div>
    <div class="modal-footer">
       <button type="button" class="btn btn-info btn-sm" onclick="storeord()" data-dismiss="modal"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
      <button type="button"  id ="drugsPrint" class="btn btn-success btn-sm"  data-dismiss="modal"><i class="ace-icon fa fa-print  bigger-110"></i>Imprimer</button>
        <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
    </div>
  </div>
</div>
<script>
  function Fill(id, name, frm, dsg)
  {
    $("#drugId").val(id);
    $("#nommedic").val(name);
    $("#forme").text(frm);$("#dosage").text(dsg);
    $("#livesearch").html('');
    if($("#posologie").prop('disabled') == true)
      $("#posologie").prop("disabled", false);
    if($("#addDrugBtn").prop('disabled') == true)
    $("#addDrugBtn").prop("disabled", false); 
 }
  $(function(){
    $("#nommedic").on("keyup", function() {
      $('#drugId').val('');
      $.ajax({
        url : '{{ route("medicament.index") }}',
        data: { "search": $('#nommedic').val()},         
        success: function(html) {
          $("#livesearch").html(html).show();
        }
      });
    });   
  });
</script>