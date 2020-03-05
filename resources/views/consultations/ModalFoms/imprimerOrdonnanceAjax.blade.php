  <!-- Modal -->
  <div  id="ordajax" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="model-header center">
          <h4>Vouslez Vous Imprimer?</h4>
        </div>
        <div class="modal-body">
         <iframe id="iframe-pdf" class="ifrCls" frameborder="0" height="0">
         </iframe>
        </div>
        <div class="modal-footer">
          <button  onclick="$('#iframe-pdf').get(0).contentWindow.print();" class="btn btn-success btn-print" data-dismiss="modal">
             <i class="ace-icon fa fa-print"></i>Imprimer
          </button>
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="ace-icon fa fa-close"></i>Fermer
          </button>
        </div>
      </div>
    </div>
  </div>
