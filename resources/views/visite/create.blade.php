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
    		e.preventDefault();
    		var periodes = [];
    		if(! isEmpty($("#acte").val()) || ($("#acte").val() == ''))
	    		$('#acteModal').modal('toggle');
	    	$.ajaxSetup({
	  		 headers: {
	        		'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    		}
	 			});
	 	 		$("input[name='p[]']:checked").each(function() {
   			 periodes.push($(this).attr('value'));
				});
				var formData = {
	 	  		id_visite: $('#id_visite').val(),
	 				nom:$("#acte").val(),
	 	    	type:$('#type').val(),
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
     		$('#acteModal form')[0].reset();//jQuery('#acteModal').trigger("reset");
      	$.ajax({
          		type:type,
          		url:ajaxurl,
          		data: formData,
          		dataType:'json',
          		success: function (data) {	/*JSON.parse()*/
          			if($('.dataTables_empty').length > 0)
	      				{
	        				$('.dataTables_empty').remove();
	      				}
	      				frag ="";
	      				$.each( data.acte.periodes, function( key, periode ) {
								 frag +='<span class="badge badge-success">'+periode+'</span>';
								});
	      				var acte = '<tr id="acte'+data.acte.id+'"><td hidden>'+data.acte.id_visite+'</td><td>'+data.acte.nom+'</td><td>'+data.acte.description+'</td><td>'
	      						     + data.acte.type+'</td><td>'+frag+'</td><td>'+data.acte.duree
	      						     + '</td><td>'+data.medecin.nom+' '+data.medecin.prenom+'</td><td>'+data.visite.date+'</td>';	 
	      			  		acte += '<td class ="center"><button type="button" class="btn btn-xs btn-info open-modal" value="' + data.acte.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';    
	           				acte += '<button type="button" class="btn btn-xs btn-danger delete-acte" value="' + data.acte.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></btton></td></tr>';
	         	  	if (state == "add") {
	            		$( "#listActes" ).append(acte);
	            	}else{
	            		$("#acte" + data.acte.id).replaceWith(acte);
	            	}    
          		},         
          		error: function (data){
                		console.log('Error:', data);
          		}
      	});
	  	});	////----- DELETE a acte and remove from the table -----////
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

	//end of add acte
	///////////add trait
	///////////////////////
	$("#EnregistrerTrait").click(function (e) {
		e.preventDefault();
    var periodes = [];
    if(! isEmpty($("#produit").val()) || ($("#acte").val() == 0) )
	  	$('#traitModal').modal('toggle');
	  $.ajaxSetup({
	   	headers: {
	     	'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	   	}
	 	});
	 	$("input[name='pT[]']:checked").each(function() {
   		periodes.push($(this).attr('value'));
   	});
   	var formData = {
	 	  		visite_id: $('#id_visiteT').val(),
	 				med_id:$("#produit").val(),
	 				posologie:$("#posologie").val(),
	 	    	periodes :periodes,
	 	  		duree : $('#dureeT').val()
	 	};
		var state = jQuery('#EnregistrerTrait').val();
		var trait_id = jQuery('#trait_id').val();
		var type = "POST";
		var ajaxurl = $('#addTrait').attr('action');
		if(state == "update") {
			  type = "PUT";
			  ajaxurl = '/traitement/' + trait_id;
		}
    $('#traitModal form')[0].reset();//jQuery('#traitModal').trigger("reset");
    $.ajax({
      		type:type,
      		url:ajaxurl,
      		data: formData,
      		dataType:'json',
      		success: function (data) {	// $.each( data, function( key, value ) {	//   alert( key + ": " + value );		// });
      			if($('.dataTables_empty').length > 0)
    				{
      				$('.dataTables_empty').remove();
    				}
  					frag ="";
  					$.each( data.trait.periodes, function( key, periode ) {
					 		frag +='<span class="badge badge-success">'+periode+'</span>';
						});
						var trait = '<tr id="acte'+data.trait.id+'"><td hidden>'+data.trait.visite_id+'</td><td>'+data.medicament.nom+'</td><td>'
											+ data.trait.posologie + '</td><td>'+frag+'</td><td>'+data.trait.duree+'</td><td>'+data.medecin.nom
										  +' '+data.medecin.prenom+'</td><td>'+data.visite.date+'</td>';	 
  			    trait += '<td class ="center"><button type="button" class="btn btn-xs btn-info edit-trait" value="' + data.trait.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
  			    trait += '<button type="button" class="btn btn-xs btn-danger delete-Trait" value="' + data.trait.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></btton></td></tr>';
  			    if (state == "add") {
          		$( "#listTraits" ).append(trait);
          	}else{
          		$("#trait" + data.trait.id).replaceWith(trait);
          	}
					},         
      		error: function (data){
            		console.log('Error:', data);
      		}
    });
	});
  $('body').on('click', '.edit-trait', function () {//edit traitement
			var traitID = $(this).val();
			$.get('/traitement/'+traitID+'/edit', function (data) {
				$('#trait_id').val(data.id);		
		  	$('#specialiteProd').val(data.medicament.id_specialite).change();
		  	//alert(data.med_id);
		  	//$('#produit option[value='+ data.med_id +']').prop('selected', true);
	  		
	  		$('#posologie').val(data.posologie);// JSON.parse(
		  	$.each(data.periodes, function( index, value ) {
				  $('#T' + value).prop("checked",true).change();
				});
		  	$('#dureeT').val(data.duree).change();//$('#nbr_j').val(data.duree);
				jQuery('#EnregistrerTrait').val("update");		
		  	jQuery('#traitModal').modal('show');
		  	// $("div.id_100 option:selected").prop("selected",false);
		  	// $("div.id_100 option[value=" + data.med_id + "]").prop("selected",true);
		  	$('select[name="produit"]').val('data.med_id');
		  });
		});
	////----- DELETE a Traitement and remove from the tabele -----////
  jQuery('body').on('click', '.delete-Trait', function () {
    var trait_id = $(this).val();
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
      });
    $.ajax({
        type: "DELETE",
        url: '/traitement/' + trait_id,
        success: function (data) {
         	$("#trait" + trait_id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
  });
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
		$('body').on('click', '.open-modal', function () {
				var acteID = $(this).val();
			  $.get('/acte/'+acteID+'/edit', function (data) {
			    $('#acte_id').val(data.id);			//$('#id_hosp').val(data.id_hosp);
			  	$('#acte').val(data.nom);
			  	$('#type').val(data.type).change();
			  	$('#duree').val(data.duree).change();
			  	$('#description').val(data.description);// JSON.parse(
			   	$.each(data.periodes, function( index, value ) {
  				  $('#' + value).prop("checked",true);
					});
			  	$('#nbr_j').val(data.duree);
			  	jQuery('#EnregistrerActe').val("update");		
			  	jQuery('#acteModal').modal('show');
			  });
		});
    //////////Traitement
    $('body').on('change', '#specialiteProd', function () {
    	  if($(this).val() != "0" )
        {
          $("#produit").removeAttr("disabled");
          var id_spec = $(this).val();
          getProducts(1,id_spec);
        }else
        {
          $("#produit").val(0);
          $("#produit").prop('disabled', 'disabled');
        }	
    });
  });
  </script>
@endsection
@section('main-content')
<div class="page-header" width="100%">@include('patient._patientInfo')	</div>
<div class="content">
	<form  class="form-horizontal" action="{{ route('visites.store') }}" method="POST" role="form">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{$id}}">
		<div id="prompt"></div>
		<div class="tabpanel  mb-3">
			<ul class = "nav nav-pills nav-justified list-group" role="tablist" id="menu">
				<li role= "presentation" class="active col-md-6">
					<a href="#Actes" aria-controls="Actes" role="tab" data-toggle="tab" class="btn btn-success btn-lg">
		   			<span class ="medical medical-icon-immunizations" aria-hidden="true"></span><span class="bigger-160"> Actes</span>
		  		</a>
				</li>
				<li role= "presentation" class="col-md-6">
					<a href="#Trait" aria-controls="Trait" role="tab" data-toggle="tab" class="btn btn-primary btn-lg">
		   			<span class ="medical medical-icon-health-services" aria-hidden="true"></span><span class="bigger-160">Traitements</span>
		  		</a>
				</li>
			</ul>
			<div class ="tab-content"  style = "border-style: none;" >
				<div role="tabpanel" class = "tab-pane active " id="Actes"> 
		  		<div class= "col-md-12 col-xs-12">
		  			<div class= "widget-box widget-color-green" id="widget-box-2">
		    			<div class="widget-header" >
		      			<h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Actes</b></font></h5>
		       			<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
							<div class="fa fa-plus-circle"></div>
			 				<a href="#"  data-target="#acteModal" id="btn-addActe" name="btn-add" class="btn-xs tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter un Acte" ><h4><strong>Acte Médicale</strong></h4></a>	
			 			</div>
		    			</div>
		    			<div class="widget-body" id ="ConsigneWidget">
			    			<div class="widget-main no-padding">
			      			<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="listActes">
			          		<thead class="thin-border-bottom">
			            		<tr class ="center">
					              <th class ="hidden"></th>
					            	<th scope="col" class ="center"><strong>Nom</strong></th>
												<th scope="col" class ="center">Decription</th>
												<th scope="col" class ="center"><strong>Type</strong></th>
												<th scope="col" class ="center"><strong>Périodes</strong></th>
												<th scope="col" class ="center" width="3%"><strong>Nombre de jours</strong></th>
												<th scope="col" class ="center"><strong>Médecin prescripteur</strong></th>												
												<th scope="col" class ="center"><strong>Date Visite</strong></th>												
												<th scope="col" class=" center nosort"><em class="fa fa-cog"></em></th>
			            		</tr>
			          		</thead>
			          		<tbody>
			          			 @foreach($hosp->visites as $visite)
			          			  @foreach($visite->actes as $acte )
			          			    @if(!$acte->retire)
				          			  <tr id="{{ 'acte'.$acte->id }}">
				          			    <td hidden> {{ $acte->id_visite }}</td>
				          			    <td> {{ $acte->nom }}</td>
				          			    <td> {{ $acte->description}}</td>
				          			    <td> {{ $acte->type}}</td>
				          			    <td>
				          			    	@foreach($acte->periodes as $periode){{-- json_decode( --}}
				          			    		<span class="badge badge-success"> {{ $periode }}</span>
				          			      @endforeach
				          			    </td>
				          			    <td> {{ $acte->duree }}</td>
				          			    <td> {{ $acte->visite->medecin->nom}}&nbsp; {{ $acte->visite->medecin->prenom}}</td>
				          			    <td>{{ $acte->visite->date }}</td>
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
		  		<div class= "widget-box widget-color-blue" id="widget-box-2">
		    			<div class="widget-header" >
		      			<h5 class="widget-title bigger lighter"><font color="black">
		      				<i class="ace-icon fa fa-table"></i>&nbsp;<b>Trait</b></font>
		      			</h5>
		       			<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
									<div class="fa fa-plus-circle"></div>
				 					<a href="#" data-target="#traitModal" id="btn-addTrait" name="btn-add" class="btn-xs tooltip-link" data-toggle="modal" data-toggle="tooltip" data-original-title="Ajouter un Traitement" >
				 						<h4><strong>Traitement Médical</strong></h4>
				 					</a>	
			 					</div>
		    			</div>	
		    		<div class="widget-body" id ="TraitementWidget">
		    			<div class="widget-main no-padding">
			      		<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="listTraits">
			          	<thead class="thin-border-bottom">
			           		<tr class ="center">
					            <th class ="hidden"></th>
					           	<th scope="col" class ="center"><strong>Nom Medicament</strong></th>
											<th scope="col" class ="center"><strong>Posologie</strong></th>
											<th scope="col" class ="center"><strong>Périodes</strong></th>
											<th scope="col" class ="center" width="3%"><strong>Nombre de jours</strong></th>
											<th scope="col" class ="center"><strong>Médecin prescripteur</strong></th>												
											<th scope="col" class ="center"><strong>Date Visite</strong></th>												
											<th scope="col" class=" center nosort"><em class="fa fa-cog"></em></th>
			            	</tr>
			          	</thead>
			          	<tbody>
			          	  @foreach($hosp->visites as $visite)
			          			@foreach($visite->traitements as $trait)
			          			<tr id="{{ 'trait'.$trait->id }}">
				          		  <td hidden> {{ $trait->visite_id }}</td>
				          		  <td> {{ $trait->medicament->nom }}</td>
				          		  <td> {{ $trait->posologie}}</td>
		          			    <td> 	
		          			    	@foreach($trait->periodes as $periode)
				          			 	<span class="badge badge-success"> {{ $periode }}</span>
				          			  @endforeach
				          			</td>
		          			    <td> {{ $trait->duree }}</td>
		          			    <td> {{ $trait->visite->medecin->nom}}&nbsp; {{ $trait->visite->medecin->prenom}}</td>
		          			    <td> {{ $trait->visite->date }}</td>
		          		      <td class="center nosort">
		          		      	<button type="button" class="btn btn-xs btn-info edit-trait" value="{{ $trait->id }}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
                          <button type="button" class="btn btn-xs btn-danger delete-Trait" value="{{ $trait->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
		          		      </td>	
		          		    </tr>
			          			@endforeach
			          		@endforeach
			          	</tbody>
			          </table>		
			        </div>
		    		</div>
		    	</div><!-- widget-box -->
		    	</div>
				</div><!-- tab-pane Trait-->
	  	</div><!-- tab-content -->
		</div><!-- tabpanel -->
		<div class="hr hr-dotted"></div>
		<div class="space-12"></div>
		<br>	
		<div class="row">
			<div class="center">
				<button type="submit" class="btn btn-info btn-sm" ><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
				<a href="{{ route('visite.destroy',$id) }}" class="btn btn-sm btn-danger" id="deleteViste" data-id="{{ $id }}">
			  	<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
				</a>
			</div>
		</div>	
	</form>
	<div class="row">@include('visite.ModalFoms.acteModal')</div>
	<div class="row">@include('visite.ModalFoms.TraitModal')</div>
  </div>
  @endsection