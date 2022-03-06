<div id="allergieModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
  	<div class="modal-content custom-height-modal">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title" id ="allTitle">Ajouter une allergie</h4>
	    </div>
	   	<div class="modal-body">
   			<input type="hidden" id="all_id" value="0">
   			<div class="row">
      		<div class="col-sm-12"> 
      			<label for="vid"><strong>Allergie :</strong></label><br>
						<select id="allid" class="form-control">
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info btn-sm" id ="allergieSave" value="add">
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
			$("#allergieAdd").click(function (e) {
				$("#allTitle").html("Ajouter une allergie");
				$("#allergieSave").val("add");
				$.get('/allergie/', function (data, status, xhr) {
					selectFill("allid",data,"id","nom");
					$('#allergieModal').modal('toggle');
				});
			});
			$("#allergieSave").click(function (e) {
					e.preventDefault();
			  	var formData = {
						patient_id : '{{ $patient->id }}',
						allergie_id : $('#allid').val(),
					};
					$.ajaxSetup({
						headers: {
					   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
		  		var state = $(this).val();
		  		var type = "POST";
					var ajaxurl = '/allergie/';
					if (state == "update") {
						type = "PUT";
						ajaxurl += $("#all_id").val();
	 				}
	 				$.ajax({
			   		type: type,
			   		url: ajaxurl,
			   		data: formData,
			   		dataType: 'json',
			   		success: function (data) {
			   			var allergie = '<tr id="allerg' + data.allergie_id +'"><td>'+ $("#allid :selected").text() +'</td>';
			  			allergie += '<td class ="center"><button type ="button" class="btn btn-xs btn-info open-modalAllergie" value="' + data.allergie_id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
				  		allergie += '<button type ="button" class="btn btn-xs btn-danger delete-All" value="' + data.allergie_id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
							if (state == "add")
			 					$('#allergTab' +' tbody').append(allergie);
			 				else
			 				{
			 					$("#allerg" +  $("#all_id").val()).replaceWith(allergie);
			 				}
			 				$('#allergieModal').modal('hide');
			   	},
			   	error: function (data) {
			   		console.log("error");
			   	}
			  })
			})	
			$('body').on('click', '.open-modalAllergie', function (event) {
				event.preventDefault();
				var allergie_id = $(this).val();
				$("#allTitle").html("Editer une allergie");
				var formData = { allergie_id : allergie_id , pid : {{ $patient->id }} };
				$.get('/allergie/' + allergie_id, formData, function (data) { 
					 	$('#all_id').val(data.alerg.pivot.allergie_id);
					 	selectFill("allid",data.alergs,"id","nom");
					  $('#allid').val(data.alerg.pivot.allergie_id	);
					  $('#allergieSave').val("update");
						$('#allergieModal').modal('show');
						
				});
			});
			$('body').on('click', '.delete-All', function (event) {
  			event.preventDefault();
  			var allergie_id = $(this).val();
	  		var formData = { pid : '{{ $patient->id }}' };
  			$.ajaxSetup({
    			headers: {
     		 		'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    			}
    		});
    		$.ajax({
          type: "DELETE",
          url: '/allergie/' + allergie_id,
          data: formData,
          dataType: 'json',
          success: function (data) {
            $("#allerg" + allergie_id).remove();
            $('#allergieSave').val("add");
          },
          error: function (data) {
             console.log('Error:', data);
          }
    		});
			});
	})
</script>
