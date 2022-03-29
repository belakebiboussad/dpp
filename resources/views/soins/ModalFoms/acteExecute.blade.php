<div id="acteExecute" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Faire l'acte :</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label class="inline"><input type="checkbox" class="ace" id="fait" checked/><span class="lbl">Fait</span></label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="priorite"><strong>Observation :</strong></label>
            <textarea id="obs" colspan="12" class="form-control hidden"></textarea>
          </div>
        </div>  
      </div>
    </div><!-- modalbody -->
    <div class="modal-footer">
      <button  type="button" class="btn btn-success send" ><i class="ace-icon fa fa-check bigger-120"></i>Valider</button>
      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-120"></i>Annuler</button>
    </div> 
  </div>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $("#fait").change(function() {
        if ($(this).is(':checked')) 
          $("#obs").addClass("hidden");
        else
          $("#obs").removeClass("hidden");
    })
    $(".send").click(function(){
      //runActe
      e.preventDefault();
      var formData = {
        pid       : '{{ $patient->id }}',
        month       : $('#month').val(),
      };
      var state = $(this).val();
      var type = "POST";
      var ajaxurl = '/acte';
    })
  });
 </script> 