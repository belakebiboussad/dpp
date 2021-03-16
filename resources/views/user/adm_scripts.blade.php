<script>
	$(document).ready(function(){
		// file-input
		$('#logo').on('click', function(){
					var modal = 
					'<div class="modal fade">\
					  <div class="modal-dialog">\
					   <div class="modal-content">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">changer Logo</h4>\
						</div>\
						\
						<form class="no-margin">\
						 <div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input"/></div>\
						 </div>\
						\
						 <div class="modal-footer center">\
							<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i>Enregistrer</button>\
							<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i>Annuler</button>\
						 </div>\
						</form>\
					  </div>\
					 </div>\
					</div>';
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
					var working = false;
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);

					file.ace_file_input({
						style:'well',//welldefault
						btn_choose:'Click pour choisir un Nouveau Logo',
						no_file: 'Click to choose or drag & drop',
						no_icon:'ace-icon fa fa-picture-o',
						thumbnail:'large',//large//small
						droppable: true,
						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'],
					});
					file.on('file.error.ace', function(ev, info) {
						if(info.error_count['ext'] || info.error_count['mime']) alert('Invalid file type! Please select an image!');
						if(info.error_count['size']) alert('Invalid file size! Maximum 100KB');
						file.ace_file_input('reset_input');
					});
					form.on('submit', function(e) {
						e.preventDefault();
						if(!file.data('ace_input_files')) return false;
					  file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");
						var thumb = file.next().find('img').data('thumb');
						if(thumb) $('#logo').get(0).src = thumb;
						modal.modal("hide");
			
					});	
				});
	})
</script>