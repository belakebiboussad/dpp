<div id="condModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content custom-height-modal">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title" id="stateCrudModal">Information sur l'Etat de la Naissance</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="cond_id" value="0">
					@if(isset($months))
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Mois :</label>
						<div class="col-sm-9">
							<select id="month">
							@foreach($months as $month)
								<option value="{{ $month }}" {{  ($exmonth->contains($month))? 'disabled' : '' }}  >{{ $month }}</option>
							@endforeach
							</select>
						</div>
					</div>
					@endif
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Score APGAR :</label>
						<div class="col-sm-9">
							<input type="text" id="apgar" name="apgar" class="irs-hidden-input col-sm-12 apgar" tabindex="-1" value="" readonly="">
						</div>
					</div>
					<div class="form-group" id ="crayAttribute">
						<label for="" class="col-sm-3 control-label">Nombre de Cris :</label>
						<div class="col-sm-9">
							<input type="text" id="shoutnbr" class="irs-hidden-input col-sm-12 shoutnbr" tabindex="-1" value="" readonly="">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Poids :</label>
						<div class="col-sm-9">
							<input type="text" id="bbWeight" class="irs-hidden-input col-sm-12 poids" tabindex="-1" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Taille :</label>
						<div class="col-sm-9">
							<input type="text" id="bbHeight" class="irs-hidden-input col-sm-12 taille" tabindex="-1" value="" readonly="">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Périmètre crânien :</label>
						<div class="col-sm-9">
							<input type="text" id="pcran" class="irs-hidden-input col-sm-12 pcran" tabindex="-1">
						</div>
					</div>
					<div class="form-group" id ="placentaAttribute">
						<label for="" class="col-sm-3 control-label" >Placenta :</label>
						<div class="col-sm-9"><textarea id="placenta" class="form-control"></textarea></div>
					</div>
			</div><!-- body -->
				<div class="modal-footer">
			<button type="button" class="btn btn-info btn-sm" id ="stateSave" value="add">
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
	function showhide(elem){
		if($(elem).val() != "1")
		{
			$("#crayAttribute").addClass("hidden");
			$("#placentaAttribute").addClass("hidden");
		}else
		{
			if($( "#crayAttribute" ).hasClass( "hidden" ))
				$("#crayAttribute").removeClass("hidden");
			if($( "#placentaAttribute" ).hasClass( "hidden" ))
				$("#placentaAttribute").removeClass("hidden");
		}
	}
	$(function(){
		var elem = document.getElementById("month");
		showhide(elem);
		$("#condAdd").click(function (e) {
			$("#stateSave").val("add");
			$('#stateCrudModal').html('Information sur l\'Etat de la Naissance');
		});
		$('#month').change(function() {
			showhide(this);
		});
    $(".pcran").ionRangeSlider({ min:25,max:65,step:0.1,from:25,grid: true,grid_num: 20, postfix:" cm",skin: "big" });

		$("#stateSave").click(function (e) {
			e.preventDefault();
		  var formData = {
        data: { _token: CSRF_TOKEN },
				pid    	  : '{{ $patient->id }}',
				month       : $('#month').val(),
				apgar : $("#apgar").val(),
				shoutnbr   : $("#shoutnbr").val(),
				bbWeight        : $("#bbWeight").val(),
				bbHeight        : $("#bbHeight").val(),
				pcran        : $("#pcran").val(),
				placenta        : $("#placenta").val(),
			};
			var state = $(this).val();
			var type = "POST";
			var ajaxurl = '/birthCond';
			if (state == "update") {
				type = "PUT";
				ajaxurl = '/birthCond/' + $("#cond_id").val();
			}
			$.ajax({
			    type: type,
			    url: ajaxurl,
			    data: formData,
			    dataType: 'json',
			    success: function (data) {
			    	var shoutnbr=(data.obj.month == 0) ? data.obj.shoutnbr : "/";
			    	var placenta =(data.obj.month == 0) ? data.obj.placenta : "";
			   		var cond = '<tr id="bcond' + data.obj.id + '"><td>'+ data.obj.month + '</td><td>' +
			   		data.obj.apgar +'</td><td>'+ shoutnbr +'</td><td>' + data.obj.bbWeight + '</td><td>' +
			   		data.obj.bbHeight + '</td><td>'+ data.obj.pcran +'</td><td>' + placenta + '</td>' ;
				  	cond += '<td class ="center"><button class="btn btn-xs btn-info open-modalBCond" value="' + data.obj.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>&nbsp;';
				  	cond += '<button class="btn btn-xs btn-danger delete-BCond" value="' + data.obj.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';
						if (state == "add")
						{
							$('#bcondTab' +' tbody').append(cond);
							if(data.count > 2)
			 					$("#condAdd").addClass("hidden");
						}else
			 				$("#bcond" + data.obj.id).replaceWith(cond);
			 			$("#month option:selected").attr("disabled", true);
			 			$('#month option:not([disabled]):first').attr('selected', 'selected');
			 			$('#condModal').modal('hide');
			    }
			});
		});
		$('body').on('click', '.delete-BCond', function (e) {
	    event.preventDefault();
	    var cond_id = $(this).val();
	    $.ajax({
	          type: "DELETE",
	          url: '/birthCond/' + cond_id,
            data: { _token: CSRF_TOKEN },
	          success: function (data) {
	            $("#bcond" + cond_id).remove();
	           	if($( "#condAdd" ).hasClass( "hidden" ))
	            	$("#condAdd").removeClass("hidden");
	            $('#month option[value="' + data.month + '"]').attr('disabled', false);
	            $('#stateSave').val("add");
	      	  },
	          error: function (data) {
	             console.log('Error:', data);
	          }
	    });
  	});
  	$('#condModal').on('shown.bs.modal', function (e) {
  		if($("#stateSave").val() == "add")
  		{
  			$("#month option:selected").each(function () {
      		  $(this).removeAttr('selected'); 
      	});
  			$(elem).removeAttr("disabled");
  		  var value =$('#month option:not([disabled]):first').val();
  			$('#month option[value="' + value + '"]').attr('selected', 'selected');
  		}else
  			$("#month option:selected").attr("disabled", false);
  		showhide(elem);
  	});
  	$('body').on('click', '.open-modalBCond', function (event) {
			event.preventDefault();
			var cond_id = $(this).val();
			$.get('/birthCond/' + cond_id, function (data) { 
				$('#cond_id').val(data.id);
			  $('#stateCrudModal').text('Modifier l\'etat de la Naissance');
			  $('#month').val(data.month);
			  $('#month').attr('disabled','disabled');
			  let apg = $("#apgar").data("ionRangeSlider");
			  apg.update({
	   	    from: data.apgar
	      });
	      let shou = $("#shoutnbr").data("ionRangeSlider");
			  shou.update({
	   	    from: data.shoutnbr
	      });
	      let weight = $("#bbWeight").data("ionRangeSlider");
			  weight.update({
	   	    from: data.bbWeight
	      });
	      let height = $("#bbHeight").data("ionRangeSlider");
			  height.update({
	   	    from: data.bbHeight
	      });
	      let perim = $("#pcran").data("ionRangeSlider");
			  perim.update({
	   	    from: data.pcran
	      });
	      if(data.month == 1)
	      	$('#placenta').val(data.placenta);
	      $('#stateSave').val("update");
			  $('#condModal').modal('show');
			});
		});
	})	
</script>