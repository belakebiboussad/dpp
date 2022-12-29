<div id="motherModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
	<div class="modal-content custom-height-modal">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" id="mothCrudModal">Ajouter les Informations de la Mére</h4>
		</div>
		<div class="modal-body">
			<input type="hidden" id="id" value="0">
			<div class="form-group">
				<label for="" class="col-sm-3 control-label" >Date de Naissance :</label>
				<div class="col-sm-9">
						<input type="date" id="dob" class="form-control date-picker gdob ltnow" data-date-format="yyyy-mm-dd"/>
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Poids habituel :</label>
				<div class="col-sm-9">
					<input type="text" id="motWeight" name="motWeight" class="irs-hidden-input col-sm-12 poids" tabindex="-1" readonly="">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-sm-3 control-label">Taille :</label>
				<div class="col-sm-9">
					<input type="text" id="motHeight" name="motHeight" class="irs-hidden-input col-sm-12 taille" tabindex="-1">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label text-nowrap" for="gs">Groupe sanguin :</label>
				<div class="col-sm-3">
					<select class="form-control groupeSanguin" id="gs" name="gs">
						<option value="">Selectionner...</option>
						<option value="A">A</option><option value="B">B</option>
						<option value="O">O</option><option value="AB">AB</option>
					</select>
				</div>
				<label class="col-sm-3 control-label no-padding-right" for="rh">Rhésus:</label>
				<div class="col-sm-3">
					<select id="rh" name="rh" class="rhesus form-control" disabled>
						<option value="">------</option>
						<option value="+">+</option>	<option value="-">-</option>
					</select>
				</div>
			</div>
		</div><!-- body -->
		<div class="modal-footer">
			<button type="button" class="btn btn-info btn-sm" id ="motherSave" value="add">
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
		$("#motherSave").click(function (e) {
	 		e.preventDefault();
	 		var formData = {
					pid    	  : '{{ $patient->id }}',
					dob       : $('#dob').val(),
					motWeight : $("#motWeight").val(),
					motHeight   : $("#motHeight").val(),
					gs        : $("#gs").val(),
					rh        : $("#rh").val(),
			};
			$.ajaxSetup({
				headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var state = $(this).val();
			var type = "POST";
			var ajaxurl = '/mother';
			if (state == "update") {
				type = "PUT";
				ajaxurl = '/mother/' + $("#id").val();
		  }
	 		$.ajax({
			   type: type,
			   url: ajaxurl,
			   data: formData,
			   dataType: 'json',
			   success: function (data) {
					var mother = '<tr id="mother' + data.id + '"><td>'+ data.age + '</td><td>' + data.motWeight +'</td><td>'+data.motHeight+'</td><td>'+data.gs+data.rh+'</td>';
				  mother += '<td class ="center"><button class="btn btn-xs btn-info open-modalmoth" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
				  mother += '<button class="btn btn-xs btn-danger delete-mother" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
					if (state == "add")
						$('#motherTab' +' tbody').append(mother);
			 		else
			 			$("#mother" + data.id).replaceWith(mother);
			  	$("#motherAdd").addClass("hidden");
					$('#motherModal').modal('hide');//resetMothModal();
			 	},
				error: function (data) {
					console.log('Error:', data);
			  }
			});
		});
		$('body').on('click', '.delete-mother', function (e) {
	    event.preventDefault();
	    var mother_id = $(this).val();
	    $.ajaxSetup({
	    	headers: {
	      	'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    	}
	    });
	    $.ajax({
	          type: "DELETE",
	          url: '/mother/' + mother_id,
	          success: function (data) {
	            $("#mother" + mother_id).remove();
	            $("#motherAdd").removeClass("hidden");
	            $('#motherSave').val("add");//resetMothModal();
	          },
	          error: function (data) {
	             console.log('Error:', data);
	          }
	    });
  	});
		$('body').on('click', '.open-modalmoth', function (event) {
			event.preventDefault();
			var moth_id = $(this).val();
	  	$.get('/mother/' + moth_id, function (data) { 
				$('#id').val(data.id);
			  $('#mothCrudModal').text('Modifier les informations de la Mére')
			  $('#dob').val(data.dob);
			  let weiht = $("#motWeight").data("ionRangeSlider");
			  weiht.update({
	   	    from: data.motWeight
	      });
	      let height = $("#motHeight").data("ionRangeSlider");
			  height.update({
	   	    from: data.motHeight
	      });
				$('#gs').val(data.gs).change();
				$('#rh').val(data.rh).change();
				$('#motherSave').val("update");
	      $('#motherModal').modal('show');
			});
		});
	});
</script>