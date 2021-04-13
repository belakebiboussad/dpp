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
				<div class="error"></div>
			</div>
			<div class="modal-footer">
			<div class="controls">
				<fieldset class="reader-config-group">
				  <label>
          	<span>Type</span>
          	<select name="decoder_readers">
              <option value="code_128" selected="selected">Code 128</option>
              <option value="code_39">Code 39</option>
              <option value="code_93">Code 93</option>
          	</select>
      		</label>
    			<label>
            <span>Resolution</span>
            <select name="input-stream_constraints" class="tt-input input-sx">
              <option value="320x240">320px</option>
              <option value="640x480">640px</option>
              <option value="800x600">800px</option>
              <option selected="selected" value="1280x720">1280px</option>
              <option value="1600x960">1600px</option>
              <option value="1920x1080">1920px</option>
            </select>
          </label>
      		<label>
            <span>Camera</span>
            <select name="input-stream_constraints" id="deviceSelection" class="tt-input input-sx">
            </select>
          </label>
         	<label style="display: none">
          	<span>Zoom</span>
          	<select name="settings_zoom" class="tt-input input-sx"></select>
			    </label>
			    <label style="display: none">
			      <span>Torch</span>
			      <input type="checkbox" name="settings_torch" class="tt-input input-sx"/>
			    </label>
      	</fieldset>
      </div>    <!-- controls -->
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>