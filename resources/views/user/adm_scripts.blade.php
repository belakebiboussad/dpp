<script>
	$(document).ready(function(){
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
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
						 </div>\
						\
						 <div class="modal-footer center">\
							<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i>Envoyer</button>\
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
						style:'default',//well
						btn_choose:'Click pour choisir un Nouveau Logo',
						btn_change:null,
						no_icon:'ace-icon fa fa-picture-o',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						allowExt: ['jpg', 'jpeg', 'png', 'gif'],
						allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
					});
					var ie_timeout = null;//a time for old browsers uploading via iframe
					form.on('submit', function(){
					  if(!file.data('ace_input_files')) return false;
						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");
						 /*
						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();
							modal.modal("hide");
							var thumb = file.next().find('img').data('thumb');
							if(thumb) $('#logo').get(0).src = thumb;
							working = false;
						});
						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));
						return false;
					   */
					  formData_object = new FormData();//create empty FormData object
						//serialize our form (which excludes file inputs)
						$.each($form.serializeArray(), function(i, item) {
							alert(item.name);
							//add them one by one to our FormData 
							//formData_object.append(item.name, item.value);							
						});
					});		
				});
	})
</script>