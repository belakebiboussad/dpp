<div id="antecedantModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="AntecCrudModal">Ajouter un antécédent</h4>
    </div>
    <div class="modal-body">
      <form id="modalFormAnt" class="form-horizontal" method="post">
      <input type="hidden" id="atcd_id" value="0">
      <div id="atcdsstypehide" class="row form-group">
        <label for="sstypeatcd" class="col-sm-2 control-label">Type</label>
        <div class="col-sm-10">
          <select class="form-control" id="sstypeatcdc">
            <option value="" selected disabled>Selectionnez....</option>
            <option value="Medicaux" >Médicaux</option>
            <option value="Chirurigicaux">Chirurigicaux</option>
          </select>
        </div>
      </div>
      <div class="row form-group">
        <label for="dateatcd" class="col-sm-2 control-label">Date</label>
        <div class="col-sm-10">
          <input type="date" id="dateAntcd" class="form-control date-picker gdob ltnow" data-date-format="yyyy-mm-dd"/>
        </div>
      </div>
      <div class="form-group">  
        <label class="col-sm-2 control-label" for="codecim">Code(CIM10)</label>
        <div class="input-group">
          <input type="text" class="form-control search-query" placeholder="Saisir le code CIM" id="cim_code">
          <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-sm CimCode" value="cim_code"><span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
            </button>
          </span>
        </div>
      </div>
      <div class="row form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
          <textarea class="form-control" id="description" ></textarea>
        </div>
      </div>
    </form>
    </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-primary btn-sm" id ="EnregistrerAntecedant" value="add" data-atcd="Perso">
        <i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
      </button>
      <button type="reset" class="btn btn-warning btn-sm" data-dismiss="modal">
        <i class="ace-icon fa fa-undo bigger-110"></i>Annuler
      </button>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $(function(){
    $('#btn-add, #AntFamil-add').click(function () {
      $('#EnregistrerAntecedant').val("add");
      $('#modalFormData').trigger("reset");
      $('#AntecCrudModal').html("Ajouter un antécédent");
      if(this.id == "AntFamil-add")
      {
        $("#EnregistrerAntecedant").attr('data-atcd','Famille'); 
        if(! ($( "#atcdsstypehide" ).hasClass( "hidden" )))
          $( "#atcdsstypehide" ).addClass("hidden");
      }else{
        $("#EnregistrerAntecedant").attr('data-atcd','Perso'); 
        if(($( "#atcdsstypehide" ).hasClass( "hidden" )))
          $('#atcdsstypehide').removeClass("hidden");
      }
      $('#antecedantModal').modal('show');
    });
  })
</script>
