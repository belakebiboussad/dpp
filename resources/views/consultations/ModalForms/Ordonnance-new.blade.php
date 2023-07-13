<div class="modal fade" id="Ordonnance" role="dialog" aria-hidden="true" overflow:hidden>
  <div class="modal-dialog  modaldialog">{{-- modal-lg --}}
    <div class="modal-content ">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Ajouter une ordonnance</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-sm-6">  
            <input type="hidden" id="id_medicament" name="id_medicament" >
            <label class="control-label" for="nommedic">Nom médicament</label>
           {{--  <input id="nommedic" class="form-control" type="text"  placeholder="Médicament"/>   --}}
                  <input type="search"  class="form-control"  id="nommedic"  autocomplete="off">
                  <div id="livesearch" class="list-unstyled"></div>
         
          </div>
          <div class="form-group col-sm-2 hidden-xs">
            <label class="control-label" for="forme">Forme</label>
            <input id="forme" class="form-control" type="text"  placeholder="Forme" readonly/>   
          </div>
          <div class="form-group col-xs-4">
            <label class="control-label" for="dosage">Dosage</label><input type="text" class="form-control" id="dosage" placeholder="Dosage..." readonly>
          </div>
        </div>
        <div class="form-group col-sm-12">
          <label for="posologie_medic">Posologie</label><input type="text" class="form-control" id="posologie_medic" placeholder="Posologie...">
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
        <button type="button"  id ="drugsPrint" class="btn btn-success btn-sm"  data-dismiss="modal"><i class="ace-icon fa fa-print  bigger-110"></i>Imprimer&Enr</button>
          <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
      </div>
  </div>
</div>
<script>



  function formatState (state) {
    var html="";
    var formData = {
      _token: CSRF_TOKEN,
       search:state.text
    };
    $.ajax({
        url : '{{ route('medicament.index')}}',
        type : 'GET',
        dataType : 'json',
        data: formData,
        success : function(data){
          $.each(data, function(){
            html += "<option value='"+this.value+"'>"+this.label+"</option>";
          });
          return html;
        }
    });
  }
  $(function(){
      $('#nommedic').select2({
        allowClear: true,
        tags: "true",
        width:"100%",
        minimumResultsForSearch: Infinity,
        placeholder: 'Selectionner le médicament',
        minimumInputLength:3,
        // dropdownParent: $('#Ordonnance .modal-content'),
        dropdownParent: $(this).parent(),
        //templateResult: formatState
        ajax: {
        url: '{{ route('medicament.index')}}',
          type: "GET",
          data: function (data) {
            return {
              search: data.term // search term
            };
          },
          processResults: function (response) {
          results: $.map(response, function (item) {
           return {
              text: item.label,
              id: item.value,
              // forme:item.frm,
              // dosage:item.dsg
            }
          })
        }
      }//ajax
      });
    
  });
</script>