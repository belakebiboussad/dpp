<div id="accouchementModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
	<div class="modal-content custom-height-modal">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" id="accCrudModal">Information sur l'Accouchement</h4>
		</div>
		<div class="modal-body">
			<form id="modalFormAcc" class="form-horizontal">
				<input type="hidden" id="acc_id" value="0">
				<div class="form-group">
					<label class="col-sm-3 control-label" >Lieu :</label>
					<div class="col-sm-9">
						<input type="text" id="lieu" class="form-control"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Presentation :</label>
					<div class="col-sm-9">
						<input type="text" id="presentation" class="form-control"/>
					</div>
				</div>
			<div class="form-group">
				<label  class="col-sm-3 control-label">Durée Ouverture de l'Oeuf :</label>
				<div class="col-sm-9">
					<input class="col-xs-5 col-sm-5" id="eggopenduration" type="number" placeholder="Durée Ouverture de l'Oeuf" min="0" max="24" value="0" required />
					</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Durée du Travail :</label>
				<div class="col-sm-9">
					<input class="col-xs-5 col-sm-5" id="workduration" type="number" placeholder="Durée du Travail" min="0" max="24" value="0" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Durée du l'Expulsion :</label>
				<div class="col-sm-9">
					<input class="col-xs-5 col-sm-5" id="expulsduration" type="number" placeholder="Durée du l'Expulsion" min="0" max="50" value="0" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" >Incidents :</label>
				<div class="col-sm-9">
					<textarea id="incident" class="form-control"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Type :</label>
				<div class="col-sm-9">
          <select id="type" class="form-control">
            @foreach(App\modeles\Accouchement::TYPES  as  $key=>$value)
            <option value="{{ $key}}" >{{ $value }}</option>
            @endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-info btn-sm" id ="accouchSave" value="add">
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
		$('body').on('click', '.delete-acc', function (e) {
  		event.preventDefault();
    	var acc_id = $(this).val();
  		$.ajaxSetup({
    		headers: {
     		 	'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    		}
    	});
    	$.ajax({
          type: "DELETE",
          url: '/accouch/' + acc_id,
          success: function (data) {
            $("#acc" + acc_id).remove();
            $("#accAdd").removeClass("hidden");
            $('#accouchSave').val("add");
          },
          error: function (data) {
             console.log('Error:', data);
          }
    	});
  	});
		$("#accouchSave").click(function (e) {
	 		e.preventDefault();//terme  :  $('#terme').val(),motif  :  $('#motiftype').val(),
	 		var formData = {
				etablisement :  $('#lieu').val(),
				presentation :  $('#presentation').val(),
				eggopenduration :  $('#eggopenduration').val(),
				workduration :  $('#workduration').val(),
				expulsduration :  $('#expulsduration').val(),
				incident 		 :  $('#incident').val(),
				type 		 		 :  $('#type').val(),
				pid    	  	 : '{{ $patient->id }}'
			};
			$.ajaxSetup({
				headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var state = $(this).val();
			var type = "POST";
			var ajaxurl = '/accouch';
			if (state == "update") {
				type = "PUT";
				ajaxurl = '/accouch/' + $("#acc_id").val();
	 		}
	 		$.ajax({
			   	type: type,
			   	url: ajaxurl,
			   	data: formData,
			   	dataType: 'json',
			   	success: function (data) {
		  	   		var acc = '<tr id="acc' + data.id + '"><td>'+ data.etablisement + '</td><td>' +data.presentation +'</td><td>'+ data.eggopenduration +'</td><td>'
							  + data.workduration +'</td><td>' + data.expulsduration +'</td><td>'
							  + data.Type +'</td><td>' + data.incident +'</td>';
						acc += '<td class ="center"><button class="btn btn-xs btn-info open-modalacc" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true" ></i></button>&nbsp;';
				  	acc += '<button class="btn btn-xs btn-danger delete-acc" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
			 			if (state == "add")
			 			{
			 				$('#accouchTab' +' tbody').append(acc);
			 				$("#accAdd").addClass("hidden");
			 			}
						else
			 				$("#acc" + data.id).replaceWith(acc);
			 			  $('#accouchementModal').modal('hide');
                                },
					error: function (data) {
						console.log('Error:', data);
			   }
			});
		});
		$('body').on('click', '.open-modalacc', function (event) {
			event.preventDefault();
			var acc_id = $(this).val();
  	  $.get('/accouch/' + acc_id, function (data) { 
        $('#acc_id').val(data.id);
				$('#lieu').val(data.etablisement);
				$('#terme').val(data.terme);
				$('#presentation').val(data.presentation);
				$('#eggopenduration').val(data.eggopenduration);
				$('#workduration').val(data.workduration);
				$('#expulsduration').val(data.expulsduration);
				$('#incident').val(data.incident);
			  $('#type').val(data.typeId).change();
				$('#motiftype').val(data.motif);
				$('#accouchSave').val("update");
				$('#accouchementModal').modal('show');
      });	
		});
	})
</script>