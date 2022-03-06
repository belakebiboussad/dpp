<div id="antecedantPhysioModal" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title" id="AntecPhysCrudModal">Ajouter un antécédent</h4>
		</div>
		<div class="modal-body">
				<input type="hidden" id="atcdPhys_id" value="0"><!-- <input type="hidden" id="typeAntecedantPhys" value="Physiologiques"> -->
				<div id="PhysiologieANTC"  class="form-group">
					<label for="habitudeAlim" class="col-sm-2 control-label">Habitudes Alimentaires:</label>
					<div class="col-sm-10">
						<input type="text" id="habitudeAlim" class="form-control"/><br>
						<label><input type="checkbox" class="ace" id="tabac"/>	<span class="lbl" >&nbsp; &nbsp;tabac</span></label>&nbsp; &nbsp; &nbsp;
				    <label><input type="checkbox" class="ace" id="ethylisme"/><span class="lbl">&nbsp; &nbsp;ethylisme</span></label>
				  </div>
				</div>
				<div class="form-group">
					<label for="dateatcd" class="col-sm-2 control-label" >Date :</label>
					<div class="col-sm-10">
						<input type="date" id="dateAntcdPhys" class="form-control date-picker gdob ltnow" data-date-format="yyyy-mm-dd" autocomplete="off"/>
					</div>
				</div>
				<div class="form-group">
		    	<label class="col-sm-2 control-label" for="codecim"><strong>Code Cim-10 :</strong></label>
					<div class="col-sm-10 input-group">
						<input type="text" class="form-control" id="phys_cim_code"/><span class="input-group-addon" style=" padding: 0px 6px;">
						<button class="btn btn-xs CimCode" type="button" value="phys_cim_code"><i class="fa fa-search"></i></button>
					  </span>
				  </div>		
				</div>
				<div class="form-group">
					<label for="description" class="col-sm-2 control-label">Description :</label>
					<div class="col-sm-10"><textarea class="form-control" id="descriptionPhys"></textarea></div>
				</div>
			</div><!-- modal-body -->
			<div class="modal-footer">
				<button type="button" class="btn btn-info btn-sm" id ="EnregistrerAntecedantPhys" value="add" data-atcd="Perso">
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
		$('#btn-addAntPhys').click(function () {
			$('#EnregistrerAntecedantPhys').val("add");
			//$('#modalFormDataPhysio').trigger("reset");
			$('#AntecPhysCrudModal').html("Ajouter un antécédent");
			$('#antecedantPhysioModal').modal('show');
	});	
	$('body').on('click', '.Phys-open-modal', function (event) {
		event.preventDefault();
		var atcd_id = $(this).val();
		$.get('/atcd/' + atcd_id, function (data) { 
			$('#atcdPhys_id').val(data.id);
			$('#dateAntcdPhys').val(data.date);
			$('#habitudeAlim').val(data.habitudeAlim);
			if(data.tabac)
				$('#tabac').prop('checked', true);
			if(data.ethylisme)
				$('#ethylisme').prop('checked', true);
			$('#phys_cim_code').val(data.cim_code);
		  $('#descriptionPhys').val(data.description);
			$('#EnregistrerAntecedantPhys').val("update");
			$('#antecedantPhysioModal').modal('show');
		});
	});
	$("#EnregistrerAntecedantPhys").click(function (e) {
			var habitudeAlim = null; var tabac=null ; var ethylisme = null;
			e.preventDefault();
			var formData = {
				Patient_ID_Patient   : '{{ $patient->id }}',
				Antecedant           : 'Personnels',//$('#Antecedant').val()
				typeAntecedant       : '1',//$('#typeAntecedant').val(),
				date                 : $('#dateAntcdPhys').val(),
				cim_code						 : $('#phys_cim_code').val(),
				description         : $("#descriptionPhys").val(),
				habitudeAlim 				 : $('#habitudeAlim').val()
			};
			formData.tabac = $("#tabac").is(":checked") ? 1:0;
	    formData.ethylisme = $("#ethylisme").is(":checked") ? 1:0;
			if($('.dataTables_empty').length > 0)
				$('.dataTables_empty').remove();
			$.ajaxSetup({
				headers: {
						  'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				}
			});
			var state = $(this).val();
			var type = "POST";
			var atcd_id = $('#atcdPhys_id').val();
			var ajaxurl = '/atcd';
			if (state == "update") {
				type = "PUT";
				ajaxurl = '/atcd/' + atcd_id;
		  } 
			$.ajax({
				  type: type,
				  url: ajaxurl,
				  data: formData,
				  dataType: 'json',
				  success: function (data) {
							var tabac = data.tabac != 0 ? 'Oui' : 'Non';
							var ethylisme = data.ethylisme !=0 ? 'Oui' : 'Non';
							var atcd = '<tr id="atcd' + data.id + '"><td>' + data.date+'</td><td>' + data.cim_code + '</td><td>' + tabac + '</td><td>'+ ethylisme	+ '</td><td>'+ data.habitudeAlim + '</td><td>'+data.description +'</td>';
							atcd += '<td class ="center"><button class="btn btn-xs btn-info Phys-open-modal" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
							atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
							if (state == "add")
								$('#antsPhysTab tbody').append(atcd);
						 	else 
								$("#atcd" + atcd_id).replaceWith(atcd);
							$('#antecedantPhysioModal').modal('hide');
				  },
					error: function (data) {
						console.log('Error:', data);
					}
			});
		});
	})
</script>