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
		                "url": '/localisation/fr_FR.json'
		  },
    });
    var i = 1;
    $("#EnregistrerActe").click(function (e) {
    	var visiteId= $('#visiteId').val();
    	// var cons = $("#cons").val();
    	// var nbj = $("#nbr_j").val();
    	alert($("#Matin").val());
      if(! isEmpty($("#cons").val()) )
	    { 
	    	var x = "<tr><td>"+i+"</td><td>"+$("#cons").val()+"</td><td>"+$("#nbr_j").val()+"</td><td><input type='checkbox' value='"+$("#Matin").val()+"' checked ='"+ $("#Matin").prop('checked')+"'>" ;
	    	//$( "#listActes" ).append(x);
	  	 	$( "#listActes" ).append( "<tr><td>"+i+"</td><td>"+$("#cons").val()+"</td><td>"+$("#nbr_j").val()+"</td><td><input type='checkbox' value='"+$("#Matin").val()+"' checked='false'></td><td><input type='checkbox' value='"+$("#Midi").val()+"' checked='"+$("#Midi").prop('checked')+"'></td><td><input type='checkbox' value='"+$("#Soir").val()+"' checked='"+$("#Soir").prop('checked')+"'></td><td>"+"</td></tr>" );
	  	 	i = i + 1;
	  	 	$('#acteModal').modal('toggle');
	   	}
	    $.ajaxSetup({
	  	  headers: {
	        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    	}
	 		});
	    e.preventDefault()
	  });
	 	$("#deleteViste").click(function(e){
		   	// if(!confirm("êtes-vous sûr d'annuler la viste?")) {
  	  	//   return false;
  	  	// }
  	  	e.preventDefault();
  	    var id = $(this).data("id");
        var token = $(this).data("token");
        var url = e.target;
        $.ajax(
        {
            url: url.href,
            type: 'GET',
            //dataType: "JSON",
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
		<h1 style="display: inline;"><strong>viste patient</strong></h1>
		<div class="pull-right"> </div>
	</div>
  <div class="content">
	  <div class= "widget-box widget-color-blue" id="widget-box-2">
		    <div class="widget-header" >
		      <h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Actes</b></font></h5>
		       	<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
								{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
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
				<button class="btn btn-info btn-sm" type="submit">
					<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
				</button>&nbsp; &nbsp; &nbsp;
			 <!--  <button class="btn btn-default deleteVisite" data-id="{{ $id }}" data-token="{{ csrf_token() }}"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button> -->
			<a href="{{ route('visite.destroy',$id) }}" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" id="deleteViste" data-id="{{ $id }}">
			   Delete
			</a>
			</div>
			</div>
   	<div id="acteModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
				<div  id="" class="modal-content custom-height-modal">
					<div class="modal-header">
			  		<button type="button" class="close" data-dismiss="modal">&times;</button>
			  		<h4 class="modal-title">Ajouter un Acte Médicale</h4>
			  		@include('patient._patientInfo')
					</div>
					<div class="modal-body">
					  <form id="addActe" method="POST" action ="/Acte/save" name="form1" id="form1">
					 		{{ csrf_field() }}
					 		<input type="hidden" name="visiteId" id ="visiteId" value="{{ $id }}">
					 		<input type="hidden" value="{{$id_hosp}}" name="idhosp">
					 		<div class="space-12"></div>
					 		<div class="row">
					 				<div class="form-group">
										<label for=""class="col-sm-3 control-label no-padding-right"><b>Consigne :</b></label>
										<div class="col-sm-9">
											<input name="cons" id="cons" class="form-control" required>
										</div>
									</div>
					 			
					 		</div>
					 		<div class="space-12"></div>
					 		<div class="row">
					 			<div class="form-group">
									<label for="" class="col-sm-3 control-label no-padding-right"><b>Nombre de jours :</b></label>
									<div class="col-sm-9">
										<input type="number" id="nbr_j" class="form-control" min="0" value= "1" />
									</div>
								</div>
					 		</div>
					 		<div class="space-12"></div>
					 		<div class="row center">
					 			<label class="checkbox-inline"><input type="checkbox" name="p[]" id="Matin" value="Matin" checked><b>Matin</b></label>
								<label class="checkbox-inline"><input type="checkbox" name="p[]" id="Midi" value="Midi"><b>Midi</b></label>
								<label class="checkbox-inline"><input type="checkbox" name="p[]" id="Soir" value="Soir"><b>Soir</b></label>
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

