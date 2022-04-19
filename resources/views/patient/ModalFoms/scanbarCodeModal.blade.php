<div class="modal" id="livestream_scanner">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Barcode Scanner</h4>
      </div>
      <div class="modal-body" style="position: static">
        <div id="interactive" class="viewport"></div>
        <div class="error" id ="errorMsg"></div>
      </div>
      <div class="modal-footer">
      <div class="controls">
      <fieldset class="reader-config-group">
        <label class="hidden-xs">
          <span>Camera</span>
          <select name="input-stream_constraints" id="deviceSelection" class="">
          </select>
        </label>
        </fieldset>
      </div>
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>