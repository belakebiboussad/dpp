<div id="ordajax" class="modal modal fade"  role="dialog">
  <div class="modal-dialog">
      <div class="modal-content mycontent">
          <div class="modal-header">
            <span class="modal-title" id="myModalLabel"><strong>Imprimer l'Ordonnance</strong></span>
             <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body iframe-container" id="ordajaxBody">
            <iframe id="iframe-pdf" class="iframe-pdf" width="100%" height="900" frameborder="1" type="application/pdf" scrolling="yes" style="display:block;">
            </iframe>
          </div>
          <div class="modal-footer mb-0 pull-right">
            <button type="button" class="btn btn-info btn-xs" data-dismiss="modal" onclick="close()" >
              <i class="ace-icon fa fa-close bigger-110"></i>Fermer
            </button>
          </div>
      </div>
  </div>
</div> 