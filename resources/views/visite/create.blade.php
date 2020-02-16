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
	   		   'language': {
	   							   "url": '/localisation/fr_FR.json',
			               
			       },
      });
      $('td.dataTables_empty').html('');
    /////////////
    //////////////////Enregistre acte
    //////////////////////////////////
    $("#EnregistrerActe").click(function (e) { 
    	if(! isEmpty($("#nom").val()) )
	    { 
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
	 		var state = jQuery('#EnregistrerActe').val();
	 		var acte_id = jQuery('#acte_id').val();
      var type = "POST";
			var ajaxurl = $('#addActe').attr('action');
	 		if (state == "update") {
	            type = "PUT";
	            ajaxurl = '/acte/' + acte_id;
	    }
	   	$.ajax({
          type:type,
          url:ajaxurl,
          data: formData,
          dataType:'json',
          success: function (data) {
        		if($('.dataTables_empty').length > 0)
      			{
        			$('.dataTables_empty').remove();
      			}
      			var acte = '<tr id="acte'+data.id+'"><td>'+data.id+'</td><td>'+data.nom+'</td><td>'+data.duree+'</td><td>'+data.description+'</td><td><span class="badge badge-success">'+JSON.parse(data.periodes)+'</span></td>' 	
           	acte    += '<td class ="center"><button type="button" class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';    
           	acte += '<button type="button" class="btn btn-xs btn-danger delete-acte" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></btton></td></tr>';
            if (state == "add") {
            		$( "#listActes" ).append(acte);
            }else{
            	$("#acte" + data.id).replaceWith(acte);
            }

           
          },         
          error: function (data){
                console.log('Error:', data);
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
            }
        });
        return false;
		});
		//edit acte
		$('body').on('click', '.open-modal', function () {
				var acteID = $(this).val();
			  $.get('/acte/'+acteID+'/edit', function (data) {
			  	$('#id_hosp').val(data.id_hosp);
			  	alert(data.id);
			  	$('#acte_id').val(data.id);		
			  	$('#nom').val(data.nom);
			  	$('#description').val(data.description);
			   	$.each( JSON.parse(data.periodes), function( index, value ) {
  				  $('#' + value).prop("checked",true);
					});
			  	$('#nbr_j').val(data.duree);
			  	jQuery('#EnregistrerActe').val("update");		
			  	jQuery('#acteModal').modal('show');
			  });
		});
		////----- DELETE a Garde and remove from the page -----////
    jQuery('body').on('click', '.delete-acte', function () {
      var acte_id = $(this).val();
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: '/acte/' + acte_id,
            success: function (data) {
              $("#acte" + acte_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
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
			{{ csrf_field() }}
			<input type="hidden" name="id" value="{{$id}}">
			<div id="prompt"></div>
			<div class="tabpanel">
				<ul class = "nav nav-pills nav-justified list-group" role="tablist" id="menu">
					<li role= "presentation" class="active col-md-6">
						<a href="#Actes" aria-controls="Actes" role="tab" data-toggle="tab" class="btn btn-success btn-lg">
			   			 <i class="fa fa-commenting" aria-hidden="true"></i><span class="bigger-160"> Actes</span>
			  		</a>
					</li>
					<li role= "presentation" class="col-md-6">
						<a href="#Trait" aria-controls="Trait" role="tab" data-toggle="tab" class="btn btn-primary btn-lg">
			   			 <i class="fa fa-commenting" aria-hidden="true"></i><span class="bigger-160">Traitements</span>
			  		</a>
					</li>
					
				</ul>
				<div class ="tab-content"  style = "border-style: none;" >
					<div role="tabpanel" class = "tab-pane active " id="Actes"> 
			  		<div class= "col-md-12 col-xs-12">
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
													<th scope="col" class ="center"><strong>Nom</strong></th>
													<th scope="col" class ="center"><strong>Nombre de jours</strong></th>
													<th scope="col" class ="center">Decription</th>
													<th scope="col" class ="center"><strong>Périodes</strong></th>
													<th scope="col" class=" center nosort"><em class="fa fa-cog"></em></th>
				            		</tr>
				          		</thead>
				          		<tbody>

  			          			 @foreach($hosp->visites as $visite)
				          			  @foreach($visite->actes as $acte )
				          			    @if(!$acte->retire)
					          			  <tr id="{{ 'acte'.$acte->id }}">
					          			    <td hidden> {{ $acte->id_visite }}</td>
					          			    <td>{{ $acte->id }}</td>
					          			    <td> {{ $acte->nom }}</td>
					          			    <td> {{ $acte->duree }}</td>
					          			    <td> {{ $acte->description}}</td>
					          			    <td>
					          			    	@foreach(json_decode($acte->periodes) as $periode)
					          			    		<span class="badge badge-success"> {{ $periode }}</span>
					          			      @endforeach
					          			    </td>
					          		      <td class="center nosort">
					          		      	<button type="button" class="btn btn-xs btn-info open-modal" value="{{$acte->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
                                <button type="button" class="btn btn-xs btn-danger delete-acte" value="{{$acte->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
					          		      </td>
					          		    </tr>
					          		    @endif
					          		    @endforeach
				          			@endforeach
				          		</tbody>
				      			</table>	
				     			</div>
				  		</div>
			  		  </div><!-- widget-box -->
			  		</div>
			  	</div><!-- Actes -->
			  	<div role="tabpanel" class = "tab-pane" id="Trait">
			  		<div class= "col-md-12 col-xs-12">
			  		traitement
			  		</div>
					</div>	
				</div><!-- tab-content -->
			</div><!-- tabpanel -->
			<div class="hr hr-dotted"></div>
			<div class="space-12"></div>
			<br>	
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
  	<div class="row">
  		@include('visite.ModalFoms.acteModal') 
  	</div>
  </div>
  @endsection