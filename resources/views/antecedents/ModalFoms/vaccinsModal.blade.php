<div id="vaccinModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
  	<div class="modal-content custom-height-modal">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title" id="vaccinTitle">Ajouter un vaccin</h4>
	    </div>
	   	<div class="modal-body">
	   			<input type="hidden" id="vac_id" value="0">
	   			<div class="row">
	      	<div class="col-sm-12"> 
	      		<label for="vid"><strong>Vaccin :</strong></label><br>
						<select id="vid" class="form-control">
								@if($specialite->vaccins !="")
									@foreach( json_decode($specialite->vaccins ,true) as $vacc)
										<option value="{{ $vacc }}">{{ App\modeles\Vaccin::FindOrFail($vacc)->nom}}</option>}
									@endforeach
								@endif 	
						</select>
					</div>
					</div>
					<div class="row">
	      	<div class="col-sm-12">
	  	    	<label for="dateVacc" class="control-label"><strong>Date :</strong></label>
						<div class="">
							<input type="date" id="dateVacc" class="form-control date-picker gdob ltnow" data-date-format="yyyy-mm-dd" autocomplete="off"/>
						</div> 
	      	</div>
	      	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info btn-sm" id ="vaccinSave" value="add">
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
	$('#vaccAdd').click(function () {
		$('#vaccinSave').val("add");
		$('#vaccinTitle').html("Ajouter un vaccin");
	});
	$("#vaccinSave").click(function (e) {
		e.preventDefault();
		var formData = {
				pid      : '{{ $patient->id }}',
				vaccinid : $('#vid').val(),
				date     : $('#dateVacc').val(),
		};
		$.ajaxSetup({
			headers: {
		   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var state = $(this).val();
		var type = "POST";
		var ajaxurl = '/vaccin/';
		if (state == "update") {
				type = "PUT";
				ajaxurl += $("#vac_id").val();
	 	}
	 	$.ajax({
			   	type: type,
			   	url: ajaxurl,
			   	data: formData,
			   	dataType: 'json',
			   	success: function (data) {
			   		var vac = '<tr id="vaccin' + data.vaccin_id + '"><td>'+ $("#vid :selected").text()
			   						+ '</td><td>' + data.date +'</td>';
			   		vac += '<td class ="center"><button class="btn btn-xs btn-info open-modalVacc" value="' + data.vaccin_id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>';
				  	vac += '<button class="btn btn-xs btn-danger delete-Vacc" value="' + data.vaccin_id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
						if (state == "add")
			 				$('#vaccsTab' +' tbody').append(vac);
			 			else
			 				$("#vaccin" + $("#vac_id").val()).replaceWith(vac);
			 		  $('#vaccinModal').modal('hide');
			 		},
					error: function (data) {
						console.log('Error:', data);
			   }
			});
	});
	$('body').on('click', '.open-modalVacc', function (event) {
		event.preventDefault();
		var vac_id = $(this).val();
		$('#vaccinTitle').html("Modifier un vaccin");
	  var formData = { vac_id : vac_id , pid : {{ $patient->id }} };
		$.get('/vaccin/' + vac_id, formData, function (data) { 
				$('#vac_id').val(data.vaccin_id);
				$('#vid').val(data.vaccin_id);
				$('#dateVacc').val(data.date);
				$('#vaccinSave').val("update");
				$('#vaccinModal').modal('show');
		});
	});
	$('body').on('click', '.delete-Vacc', function (e) {
  		event.preventDefault();
    	var vac_id = $(this).val();
  		var formData = { pid : '{{ $patient->id }}' };
  		$.ajaxSetup({
    		headers: {
     		 	'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    		}
    	});
    	$.ajax({
          type: "DELETE",
          url: '/vaccin/' + vac_id,
          data: formData,
          dataType: 'json',
          success: function (data) {
            $("#vaccin" + vac_id).remove();
            $('#vaccinSave').val("add");
          },
          error: function (data) {
             console.log('Error:', data);
          }
    	});
  });
});
</script>
