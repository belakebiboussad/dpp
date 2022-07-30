<div id="maladieContagModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
  	<div class="modal-content custom-height-modal">
      <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Ajouter une maladie Contagieuse</h4>
	    </div>
	   	<div class="modal-body">
	   			<input type="hidden" id="des_id" value="0">
	   			<div class="row">
		      	<div class="col-sm-12">
		   				<label for="vid"><strong>Maladie :</strong></label><br>
		   				<select id="maladie" class="form-control"></select>
		   			</div>
	   			</div>
	   	</div>
	   		<div class="modal-footer">
				<button type="submit" class="btn btn-info btn-sm" id ="contagDiseaseSave" value="add">
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
		$("#maladiecontag").click(function (e) {
			$.get('/maladieContagieuse/', function (data, status, xhr) {
				
				selectFill("maladie",data,"CODE_DIAG","NOM_MALADIE");
				 $('#maladieContagModal').modal('toggle');
			});
		});
		$("#contagDiseaseSave").click(function (e) {
			e.preventDefault();
			  var formData = {
					patient_id : '{{ $patient->id }}',
					maladie_id : $('#maladie').val(),
			};
			$.ajaxSetup({
					headers: {
				   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
			});
		  	var state = $(this).val();
				var type = "POST";
				var ajaxurl = '/cim10/';
				if (state == "update") {
					type = "PUT";
					ajaxurl += $("#des_id").val();
	 			}
	 			$.ajax({
			   	type: type,
			   	url: ajaxurl,
			   	data: formData,
			   	dataType: 'json',
			   	success: function (data) {
			   		var desease = '<tr id="contagDes' + data.maladie_id + '"><td>'+ $("#maladie :selected").text()+'</td>';
			  		desease += '<td class ="center"><button class="btn btn-xs btn-info open-modalcontagDes" value="' + data.maladie_id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
				  	desease += '<button class="btn btn-xs btn-danger delete-Des" value="' + data.maladie_id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
						if (state == "add")
			 				$('#conagDesTab' +' tbody').append(desease);
			 			else
			 			{
			 				$("#contagDes" + $("#des_id").val()).replaceWith(desease);
			 			}
			 			$('#maladieContagModal').modal('hide');
			   	},
			   	error: function (data) {
			   		console.log("error");
			   	}
			  })
		});
		$('body').on('click', '.open-modalcontagDes', function (event) {
				event.preventDefault();
				var des_id = $(this).val();
				var formData = { des_id : des_id , pid : {{ $patient->id }} };
				$.get('/cim10/' + des_id, formData, function (data) { 
					$('#des_id').val(data.desease.CODE_DIAG);
					selectFill("maladie",data.contagDes,"CODE_DIAG","NOM_MALADIE");
					$('#maladie').val(data.desease.CODE_DIAG);
					$('#contagDiseaseSave').val("update");
					$('#maladieContagModal').modal('show');
				});
			});
			$('body').on('click', '.delete-Des', function (event) {
  			event.preventDefault();
  			var des_id = $(this).val();
	  		var formData = { pid : '{{ $patient->id }}' };
  			$.ajaxSetup({
    			headers: {
     		 		'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    			}
    		});
    		$.ajax({
          type: "DELETE",
          url: '/cim10/' + des_id,
          data: formData,
          dataType: 'json',
          success: function (data) {
            $("#contagDes" + des_id).remove();
            $('#contagDiseaseSave').val("add");
          },
          error: function (data) {
             console.log('Error:', data);
          }
    		});
			});
	})
</script>