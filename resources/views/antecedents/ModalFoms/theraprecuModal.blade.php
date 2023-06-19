<div id="therapModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  	<div class="modal-contents">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Thérapie recue</h4>
	</div>
	<div class="modal-body">
	  <input type="hidden" id="traitRec_id" value="0">
	  	<div class="form-group">
				<label for="examensradio"><strong>Médicaments :</strong></label><br>
				<select class="js-meds-ajax" multiple="multiple" style="width: 100%"></select>
			</div>
   		<div class="form-group">
      	<label for="transfusion"><strong>Transfusion :</strong></label><br>
				<textarea id="transfusion" class="form-control"></textarea>
			</div>
			<div class="form-group">
				<label for="serum"><strong>Injections de sérums :</strong></label><br>
					<textarea id="serum" class="form-control"></textarea>
			</div>	
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-info btn-sm" id ="theraPrecueRecueSave" value="add">
  		<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
	 	</button>
		<button type="reset" class="btn btn-default btn-sm" data-dismiss="modal">
 			<i class="ace-icon fa fa-close bigger-110"></i>Fermer
	 	</button>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$(function(){
		$(".js-meds-ajax").select2({
				placeholder: 'Selectionner le médicament...',
				minimumInputLength: 3,
				maximumSelectionLength : 7,
				tags: "true",
				allowClear: true,
				ajax: {
					url: "/drugsearch/",
					dataType: 'json',
					type: "GET",
					multiple : true,
					processResults: function (data) {
						return {
							results: $.map(data, function (item) {
								return {
									text: item.Nom_com,
									id: item.id
								}
							})
						};
					}
				}
		});
		$("#therapRecueAdd").click(function (e) {
		 	$('#therapModal').modal('toggle');// });
		});
		$("#theraPrecueRecueSave").click(function (e) {
				e.preventDefault();
			  var formData = {
						patient_id : '{{ $patient->id }}',
						medics : $('.js-meds-ajax').val(),
						transfusion : $('#transfusion').val(),
						serum : $('#serum').val(),
				};
				$.ajaxSetup({
					headers: {
				   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				var state = $(this).val();
		  	var type = "POST";
				var ajaxurl = '/traitementRecus/';
				if (state == "update") {
					type = "PUT";
					ajaxurl += $("#traitRec_id").val();
	 			}
	 			$.ajax({
			   	type: type,
			   	url: ajaxurl,
			   	data: formData,
			   	dataType: 'json',
			   	success: function(data) {
			   		var meds ="";
			   			$.each(data.medicaments,function(key,value){
							meds += value['Nom_com'] +",";
			  		})
			   	  var trait = '<tr id="trait' + data.id + '"><td>'+meds
													+'</td><td>'+data.transfusion+ '</td><td>'+data.serum+'</td>';
			  		trait += '<td class ="center"><button class="btn btn-xs btn-info open-modalTraiRecu" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
				  	trait += '<button class="btn btn-xs btn-danger delete-trait" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
						if (state == "add")
			 			{
			 				$('#therapTab' +' tbody').append(trait);
			 				$("#therapRecueAdd").addClass("hidden");
			 			}
			 			else
			 				$("#trait" + data.id).replaceWith(trait);
			 			$('#therapModal').modal('hide');
			   	}
			  });
		});
		$('body').on('click', '.open-modalTraiRecu', function (event) {
			event.preventDefault();
			var therap_id = $(this).val();
			$.get('/traitementRecus/' + therap_id, function (data) { 
				$('#traitRec_id').val(data.id);
				$('#transfusion').val(data.transfusion);
				$('.js-meds-ajax').empty();
				$.each(data.medicaments,function(key,value){
					var newOption = $("<option selected='selected'></option>").val(value.id).text(value.Nom_com);
 					$(".js-meds-ajax").append(newOption).trigger('change');
				});
				$('#serum').val(data.serum);
				$('#theraPrecueRecueSave').val("update");
				$('#therapModal').modal('show');
			});	
		});
		$('body').on('click', '.delete-trait', function (e) {
  		event.preventDefault();
    	var therap_id = $(this).val();
  		$.ajaxSetup({
    		headers: {
     		 	'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    		}
    	});
    	$.ajax({
          type: "DELETE",
          url: '/traitementRecus/' + therap_id,
          success: function (data) {
            $("#trait" + therap_id).remove();
            $("#therapRecueAdd").removeClass("hidden");
            $('#therapModal').val("add");
          },
          error: function (data) {
             console.log('Error:', data);
          }
    	});
  	});
	});
</script>
