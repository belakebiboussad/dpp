<script type="text/javascript">
	// $(document).ready(function(){
		jQuery(function($) {
				var $form = $('#addEtab');
				var file_input = $form.find('input[type=file]');
				var upload_in_progress = false;
				file_input.ace_file_input({
					style : 'well',
					btn_choose : 'Selectionner le logo',
					btn_change: null,
					droppable: true,
					thumbnail: 'large',
					maxSize: 110000,//bytes
					allowExt: ["jpeg", "jpg", "png", "gif"],
					allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],
					before_remove: function() {
						if(upload_in_progress)
							return false;//if we are in the middle of uploading a file, don't allow resetting file input
						return true;
					},
					preview_error: function(filename , code) {}	//code = 1 means file load error//code = 2 image load error (possibly file is not an image)					//code = 3 preview failed
				});
				file_input.on('file.error.ace', function(ev, info) {
					if(info.error_count['ext'] || info.error_count['mime']) alert('Invalid file type! Please select an image!');
					if(info.error_count['size']) alert('Invalid file size! Maximum 100KB');
				});
				var ie_timeout = null;//a time for old browsers uploading via iframe
				$form.on('submit', function(e) {
					e.preventDefault();
				  var files = file_input.data('ace_input_files');
					if( !files || files.length == 0 ) return false;//no files selected
					var deferred ;
					if( "FormData" in window ) {
						formData_object = new FormData();//create empty FormData object	//serialize our form (which excludes file inputs)
						$.each($form.serializeArray(), function(i, item) {//add them one by one to our FormData 
							formData_object.append(item.name, item.value);		
						});
						$form.find('input[type=file]').each(function(){
							var field_name = $(this).attr('name');
							var files = $(this).data('ace_input_files');
							if(files && files.length > 0) {
								for(var f = 0; f < files.length; f++) {
									formData_object.append(field_name, files[f]);
								}
							}
						});
						upload_in_progress = true;
						file_input.ace_file_input('loading', true);
						deferred = $.ajax({
										    url: $form.attr('action'),
							      		type: $form.attr('method'),
												processData: false,//important
												contentType: false,//important
							  			  dataType: 'json',
							       		data: formData_object,
							   				success : function(data) {
													upload_in_progress = false;
													file_input.ace_file_input('loading', false);
												}
					  });//ajax
					}					
				});
		})
	// });
</script>
		