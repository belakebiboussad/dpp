@extends('app')
@section('page-script')
<script type="text/javascript">
	$(document).ready(function() {
  	$('#listActes').DataTable({
      colReorder: true,
      stateSave: true,
      searching:false,
  	  'aoColumnDefs': [{
        'bSortable': false,
       	'aTargets': ['nosort']
   		}],
   		"language": {
   							   "url": '/localisation/fr_FR.json',
		               
		            },
    });
    var i = 1;
    $('td.dataTables_empty').html('');
    /////////////
    //////////////////Enregistre acte
    //////////////////////////////////
    $("#EnregistrerActe").click(function (e) { 
    	if(! isEmpty($("#nom").val()) )
	    { 
	    	if($('.dataTables_empty').length > 0)
      	{
        	$('.dataTables_empty').remove();
      	}
	    	var matincheck = $('#' + 'Matin').is(":checked") ?'checked':'';
	      var midicheck = $('#' + 'Midi').is(":checked") ?'checked':'';
	      var soircheck = $('#' + 'Soir').is(":checked") ?'checked':'';
	     	$( "#listActes" ).append("<tr><td>"+i+"</td><td>"+$("#nom").val()+"</td><td>"+$("#nbr_j").val()+"</td><td><input type='checkbox' value='"+$("#Matin").val()+"'"+ matincheck +"></td><td><input type='checkbox' value='"+ $("#Midi").val()+"'"+midicheck+"></td><td><input type='checkbox' value='"+$("#Soir").val()+"'"+soircheck+"></td></tr>");
	  	 	i = i + 1;
	  	 	$('#acteModal').modal('toggle');
	   	}
	    $.ajaxSetup({
	  	  headers: {
	        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    	}
	 		});
	 		e.preventDefault();
	 		var periodes = [];
	 		 $("input[name='p[]']:checked").each(function() {
   			 periodes.push($(this).attr('value'));			
			});
	 	  var formData = {
	 	  	id_visite: $('#id_visite').val(),
	 	    nom:$("#nom").val(),
	 	  	periodes :periodes,
	 	  	description:$('#description').val(),
	 	  	duree : $('#duree').val()
	 		};
	 		var url = $('#addActe').attr('action');
	 		$.ajax({
          type:'POST',
          url:url,
          data: formData, //dataType:'json',
          success: function (data) {
          	console.log(data);
          },         
          error: function (data){
                console.log('Error:', data);
                alert('error');
          }
      });
	  });
		//end of add acte
		//////////////////////////////////////
		//delete viste
	 	$("#deleteViste").click(function(e){
		   	e.preventDefault();
  	    var id = $(this).data("id");
        var token = $(this).data("token");
        var url = e.target;
        $.ajax(
        {
            url: url.href,
            type: 'GET',//dataType: "JSON",
            data: {
                "id": id,
                "_token": token,
            },
            success: function (response)
            {
             	var loc = window.location;
              window.location.replace('/hospitalisation');  
              console.log("it Work");
            }
        });
        return false;
		});
	}); 

</script>
@endsection
@section('main-content')
	<div class="page-header" width="100%">
  	@include('patient._patientInfo')
	</div>
  <div class="page-header">
		<h1 style="display: inline;"><strong>Ajouter un visite</strong></h1>
		<div class="pull-right"> </div>
	</div>
  <div class="content">
	  <form  class="form-horizontal" action="{{ route('visites.store') }}" method="POST" role="form">
		  <div class= "widget-box widget-color-blue" id="widget-box-2">
			    <div class="widget-header" >
			      <h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Actes</b></font></h5>
			       	<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
								<div class="fa fa-plus-circle"></div>
				 				<a href="#"  data-target="#acteModal" id="btn-add" name="btn-add" class="btn-xs tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter un Acte" >
				 					<h4><strong>Acte Médicale</strong></h4>
				 				</a>
				 			</div>
			    </div>
			    <div class="widget-body" id ="ConsigneWidget">
				    <div class="widget-main no-padding">
				      <table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="listActes">
				          <thead class="thin-border-bottom">
				            <tr class ="center">
				              <th class ="hidden"></th>
				            	<th scope="col" class ="center"></th>
											<th scope="col" class ="center"><strong>Acte</strong></th>
											<th scope="col" class ="center"><strong>Nombre de jours</strong></th>
											<th scope="col" class ="center"><strong>Matin</strong></th>
											<th scope="col" class ="center"><strong>Midi</strong></th>
											<th scope="col" class ="center"><strong>Soir</strong></th>
											<th scope="col" class=" center nosort"><em class="fa fa-cog"></em></th>
				            </tr>
				          </thead>
				      </table>	
				     </div>
				  </div>
		  </div>
  		<div class="hr hr-dotted"></div>
			<div class="row">
				<div class="center">
					<button type="submit" class="btn btn-info btn-sm" >
						<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
					</button>&nbsp; &nbsp; &nbsp;
					<a href="{{ route('visite.destroy',$id) }}" class="btn btn-sm btn-danger" id="deleteViste" data-id="{{ $id }}">
				  	<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
				</a>
				</div>
			</div>
		</form>








   	<div id="acteModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<div  id="" class="modal-content custom-height-modal">
					<div class="modal-header">
			  		<button type="button" class="close" data-dismiss="modal">&times;</button>
			  		<h4 class="modal-title">Ajouter un Acte Médicale</h4>
			  		@include('patient._patientInfo')
					</div>
					<div class="modal-body">
					<!-- /Acte/save -->
					  <form id="addActe" method="POST" action ="/saveActe" name="form1" id="form1">
					 		{{ csrf_field() }}
					 		<input type="hidden" name="visiteId" id ="visiteId" value="{{ $id }}">
					 		{{-- <input type="hidden" value="{{$id_hosp}}" name="idhosp"> --}}
					 		<div class="space-12"></div>
					 		<div class="row">
					 				<div class="form-group">
										<label for=""class="col-sm-3 control-label no-padding-right"><b>Acte	 :</b></label>
										<div class="col-sm-7">
											<input name="cons" id="cons" class="form-control" required>
										</div>
									</div>
					 			
					 		</div>
					 		<div class="space-12"></div>
							<div class="row">
					 		  <div class="col-sm-3">
					 		    <label for="" class="control-label no-padding-right"><b>Periodes:</b></label>
					 			</div>
						 		<div class="col-sm-3">
						 			<label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Matin" value="Matin" checked><b>Matin</b></label>
						 		</div>	
						 		<div class="col-sm-3">	
									<label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Midi" value="Midi"><b>Midi</b></label>
								</div>
								<div class="col-sm-3">
									<label class="checkbox-inline ace"><input type="checkbox" name="p[]" id="Soir" value="Soir"><b>Soir</b></label>
								</div>
							</div>
					 		<div class="space-12"></div>
					 		<div class="row">
					 			<div class="col-sm-3">
					 		    <label for="" class="control-label no-padding-right"><b>description :</b></label>
					 			</div>
					 			<div class="col-sm-7">
									<input type="text" id="description" name="description" class="form-control col-sm-6" placeholder = "applcation de l'acte" />
								</div>
					 		</div>
					 		<div class="space-12"></div>
					 		<div class="row">
					 		  <div class="col-sm-3">
					 		    <label for="" class="control-label no-padding-right"><b>Pendant :</b></label>
					 			</div>
								<div class="col-sm-7">
									<input type="number" id="nbr_j" class="form-control col-sm-6" min="0" value= "1" />
								</div>	
								<div class="col-sm-2">
									<label class="" for="col-sm-3">jour</label>
								</div>	
							</div>
					 
					 		<div class="space-12"></div>
					 		<hr>
					 		<div class="row" align="right">
					 			<button type="submit" id="EnregistrerActe" class="btn btn-primary btn-xs" value ="add">
             			<i class="ace-icon  fa fa-plus-circle fa-lg bigger-110"></i>&nbsp;&nbsp;Ajouter
             		</button>
             		<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
        					<i class="ace-icon fa fa-close bigger-110"></i>Fermer
        				</button>
					 		</div>
					  </form>
					</div>
				</div>
			</div>
		</div>


  </div>
@endsection

