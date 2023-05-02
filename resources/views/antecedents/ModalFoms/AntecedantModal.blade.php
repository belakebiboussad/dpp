<div id="antecedantModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
   	<div class="modal-content custom-height-modal">
		<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title" id="AntecCrudModal">Ajouter un antécédent</h4>
		</div>
		<div class="modal-body">
			<input type="hidden" id="atcd_id" value="0">
			<div id="atcdsstypehide" class="form-group">
				<label for="sstypeatcd" class="col-sm-2 control-label">Type</label>
				<div class="col-sm-10">
					<select class="form-control" id="sstypeatcdc" onchange="resetField();">
						<option value="" selected disabled>Selectionnez....</option>
						<option value="Medicaux" >Médicaux</option>
						<option value="Chirurigicaux">Chirurigicaux</option>
					</select>
				</div>
			</div>
			<div class="row form-group mt-1">
				<label for="dateatcd" class="col-sm-2 control-label">Date</label>
				<div class="col-sm-10">
					<input type="date" id="dateAntcd" class="form-control date-picker gdob ltnow" data-date-format="yyyy-mm-dd"/>
				</div>
			</div>
			<div class="form-group">
			  <label class="col-sm-2 control-label" for="codecim">Code Cim-10</label>
				<div class="col-sm-10 input-group">
					<input type="text" class="form-control" id="cim_code"/>
					<span class="input-group-addon" style=" padding: 0px 6px;"> 
						<button class="btn btn-xs CimCode" type="button" value="cim_code">
			        <i class="fa fa-search"></i>
			      </button>
		      </span>
				</div>		
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">Descriptions :</label>
				<div class="col-sm-10"><textarea class="form-control" id="description" ></textarea></div>
			</div>
    </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-info btn-sm" id ="EnregistrerAntecedant" value="add" data-atcd="Perso">
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
		$('#btn-add, #AntFamil-add').click(function () {
			$('#EnregistrerAntecedant').val("add");
			$('#modalFormData').trigger("reset");
			$('#AntecCrudModal').html("Ajouter un antécédent");
			if(this.id == "AntFamil-add")
			{
				$("#EnregistrerAntecedant").attr('data-atcd','Famille'); 
				if(! ($( "#atcdsstypehide" ).hasClass( "hidden" )))
					$( "#atcdsstypehide" ).addClass("hidden");
			}else{
				$("#EnregistrerAntecedant").attr('data-atcd','Perso'); 
				if(($( "#atcdsstypehide" ).hasClass( "hidden" )))
					$('#atcdsstypehide').removeClass("hidden");
			}
			$('#antecedantModal').modal('show');
		});
		$('body').on('click', '.open-modalFamil', function (event) {
			event.preventDefault();
			var atcd_id = $(this).val();
			$.get('/atcd/' + atcd_id, function (data) { 
				$('#atcd_id').val(data.id);
				$('#dateAntcd').val(data.date);
				$('#cim_code').val(data.cim_code);
			  $('#description').val(data.description);
			  if(! ($( "#atcdsstypehide" ).hasClass( "hidden" )))
					$( "#atcdsstypehide" ).addClass("hidden"); 
				$('#EnregistrerAntecedant').val("update");
				$("#EnregistrerAntecedant").attr('data-atcd',"Famille")	
				 $('#antecedantModal').modal('show');
			});
		});
		$('body').on('click', '.open-modal', function (event) {//EDIT
			event.preventDefault();
			var atcd_id = $(this).val();
			$.get('/atcd/' + atcd_id, function (data) { 
				$('#atcd_id').val(data.id);
			        $('#typeAntecedant').val(data.typeAntecedant).change();
				$('#sstypeatcdc').val(data.stypeatcd).change();
				if($( "#atcdsstypehide" ).hasClass( "hidden" ))
					$( "#atcdsstypehide" ).removeClass("hidden"); 
				$('#dateAntcd').val(data.date);
				$('#cim_code').val(data.cim_code);
				$('#description').val(data.description);
				$("#EnregistrerAntecedant").attr('data-atcd',"Perso");
				$('#AntecCrudModal').html("Editer un Antecedant");	
				$('#EnregistrerAntecedant').val("update");	
				$('#antecedantModal').modal('show');
		  });
		});
		$("#EnregistrerAntecedant").click(function (e) {
			e.preventDefault();
			if($("#EnregistrerAntecedant").attr('data-atcd') == "Perso")
			{
				var tabName = "antsTab";
				var formData = {
					Patient_ID_Patient   : '{{ $obj->patient->id }}',
					Antecedant           : 'Personnels',//$('#Antecedant').val()
					typeAntecedant       : '0',//$('#typeAntecedant').val(),
					stypeatcd            : $('#sstypeatcdc').val(),
					date                 : $('#dateAntcd').val(),
					cim_code						 :$('#cim_code').val(),
					description          : $("#description").val()
				};
			}else
			{
				var tabName = "antsFamTab";
				var formData = {
          _token: CSRF_TOKEN ,
					Patient_ID_Patient   : '{{ $obj->patient->id }}',
					Antecedant         : 'Familiaux',
					date               : $('#dateAntcd').val(),
					cim_code					 : $('#cim_code').val(),
					description       : $("#description").val()
				};
			}
			if(!($("#description").val() == ''))
		 	{	
				if($('.dataTables_empty').length > 0)
					$('.dataTables_empty').remove();
			  var state = $(this).val();
				var type = "POST";
				var atcd_id = $('#atcd_id').val();
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
						if(data.Antecedant == "Personnels")
						{
							var atcd = '<tr id="atcd' + data.id +'"><td>'+ data.stypeatcd +'</td><td>'+ data.date +'</td><td>'+data.cim_code+ '</td><td>' + data.description + '</td>';
					  	atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
							atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
						}else
						{
							var atcd = '<tr id="atcd' + data.id + '"><td>' + data.date + '</td><td>' +data.cim_code							  +	'</td><td>'	+ data.description + '</td>';
							atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modalFamil" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
							atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
						}
						if (state == "add") { 
							$('#' + tabName+' tbody').append(atcd);
				 		} else {
							$("#atcd" + atcd_id).replaceWith(atcd);
				  	}	
					  $('#antecedantModal').modal('hide');
				 	},
					error: function (data) {
						  console.log('Error:', data);
				   }
				});
			}          
		});
	});
</script>