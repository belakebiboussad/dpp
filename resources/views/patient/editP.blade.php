@extends('app')
@section('title','modifier  le patient')
@section('page-script')
<script>
	function showTypeEdit(value,i){
		switch(value){
      case "Assure":
 				if(i !=0)
 				{
 				 					
				}
				$("#foncform").addClass('hide');
        $('#Type_p').attr('required', false);
        $('#nsspatient').attr('disabled', true);
        addRequiredAttr();
        break;
      case "Ayant_droit":
        if(i !=0)
     	  {
          $('#nsspatient').val("");
        }
        $("#foncform").removeClass('hide');
          $('#Type_p').attr('required', true);
        $('#nsspatient').attr('disabled', false); 
        addRequiredAttr();
        break;
    	case "Autre": 
  			$(".starthidden").show(250);
  			$("#foncform").addClass('hide');
  			$('#Type_p').attr('required', false);
    			$('#nsspatient').attr('disabled', true);   
      	break;         
		}			
	}
	//averifier
	if ($("#addGardeMalade").length > 0) {
    		$("#addGardeMalade").validate({
      			rules: {
  			        mobile_h: {
	            			required: true,
	            			digits:true,
	            			minlength: 10,
	            			maxlength:10,
        			}   
   			},
   			messages: {
   				mobile_h: {
				        required: "Please enter contact number",
				        minlength: "The contact number should be 10 digits",
				        digits: "Please enter only numbers",
				        maxlength: "The contact number should be 12 digits",
   				}
   			}
   		});
    	}
	$(document).ready(function () {
    	$('input[type=radio][name=sexe]').change(function(){
		 	if($(this).val() == "M")
		 	{
		 		$('#Div-nomjeuneFille').attr('hidden','');
		 		$('#nom_jeune_fille').val();
		 	}
		 	else
		 	{
		 		var civilite= $("select.civilite option").filter(":selected").val();
		 		if((civilite =="marie") || (civilite =="veuf"))
	  			$('#Div-nomjeuneFille').removeAttr('hidden');
		 	}
		});
	  var value =  $("input[type=radio][name='type']:checked").val();
	  showTypeEdit(value,0);
	  $( ".civilite" ).change(function() {
	  	var sex =  $('input[name=sexe]:checked').val();
	  	if(sex == "F")
	 	  {
		 		var civilite= $("select.civilite option").filter(":selected").val();
		 		if((civilite =="marie")|| (civilite =="veuf"))
  					$('#Div-nomjeuneFille').removeAttr('hidden');
  				else
  					$('#Div-nomjeuneFille').attr('hidden','');	
			 }else
			 	$('#Div-nomjeuneFille').attr('hidden','');	
		});
		$('#listeGardes').DataTable({
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
       jQuery('body').on('click', '.open-modal', function () {
	        var hom_id = $(this).val();
	        $.get('/hommeConfiance/'+hom_id+'/edit', function (data) {
		        $('#patientId').val(data.id_patient); $('#hom_id').val(data.id);	$('#nom_h').val(data.nom);$('#prenom_h').val(data.prenom);
		        $('#datenaissance_h').val(data.date_naiss);  $('#lien_par').val(data.lien_par).change();		
			$('#lien_par option').each(function() {
			    	if($(this).val() == data.lien_par) 
			      		 $(this).prop("selected", true);
			});				
			$('#' + data.type_piece).prop('checked',true); $('#num_piece').val(data.num_piece);$('#date_piece_id').val(data.date_deliv);
			$('#adresse_h').val(data.adresse);$('#mobile_h').val(data.mob);jQuery('#EnregistrerGardeMalade').val("update");
		        jQuery('#gardeMalade').modal('show');
	        })
       });
	 $("#EnregistrerGardeMalade").click(function (e) {
	  	$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
		        }
		});
		e.preventDefault();
		var formData = {
					id_patient:$('#patientId').val(),
					nom:$('#nom_h').val(),
					prenom : $('#prenom_h').val(),
					date_naiss : $('#datenaissance_h').val(),
					relation:$('#relation').val(),
					lien_par : $('#lien_par').val(),
					type_piece : $("input[name='type_piece']:checked").val(),
					num_piece : $('#num_piece').val(),
					date_deliv : $('#date_piece_id').val(),
					adresse : $('#adresse_h').val(),
					mob : $('#mobile_h').val(),
					created_by: $('#userId').val()
		};
		var state = jQuery('#EnregistrerGardeMalade').val(); var type = "POST";var hom_id = jQuery('#hom_id').val();var ajaxurl = 'hommeConfiance';
		if (state == "update") {
	    type = "PUT"; ajaxurl = '/hommeConfiance/' + hom_id;
	  }
	  if (state == "add") {
	    ajaxurl ="{{ route('hommeConfiance.store') }}";
	  }
    $('#hom_id').val("");$('#nom_h').val("");$('#prenom_h').val("");$('#datenaissance_h').val("");$('#num_piece').val("");	$('#date_piece_id').val("");
    $('#adresse_h').val("");$('#mobile_h').val("");
    $.ajax({
       type: type,
       url: ajaxurl,
       data: formData,
       dataType: 'json',
       		success: function (data) {
        		if($('.dataTables_empty').length > 0)
  					{
  			  		$('.dataTables_empty').remove();
  					}
          			var homme = '<tr id="garde' + data.id + '"><td class="hidden">' + data.id_patient + '</td><td>' + data.nom + '</td><td>' + data.prenom + '</td><td>'+ data.date_naiss +'</td><td>' + data.adresse + '</td><td>'+ data.mob + '</td><td>' + data.lien_par + '</td><td>' + data.type_piece + '</td><td>' + data.num_piece + '</td><td>' +  data.date_deliv + '</td>';
     		      homme += '<td class ="center"><button type="button" class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
         			homme += '<button type="button" class="btn btn-xs btn-danger delete-garde" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
              if (state == "add") {
                 $("#listeGardes tbody").append(homme);
              } else {
                  	$("#garde" + hom_id).replaceWith(homme);	   	
                }
              jQuery('#gardeMalade').modal('hide')
          },
          error: function (data) {
            console.log('Error:', data);
          }
   	});	
	 })	////----- DELETE a Garde and remove from the page -----////
    jQuery('body').on('click', '.delete-garde', function () {
	        var hom_id = $(this).val();
	        $.ajaxSetup({
	         	headers: {
	              		  'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	            	}
	        });
	        $.ajax({
	              type: "DELETE",
	              url: '/hommeConfiance/' + hom_id,
	              success: function (data) {
	    		          $("#garde" + hom_id).remove();
	              },
	              error: function (data) {
	                     console.log('Error:', data);
	              }
	        });
    });
  $('#gardeMalade').on('hidden.bs.modal', function () {
    $('#gardeMalade form')[0].reset();
  });

});
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>modification du Patient :&nbsp;</strong>{{ $patient->getCivilite() }} {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
	<div class="pull-right">
		<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				 Chercher un Patient
		</a>
	</div>
</div>
<form class="form-horizontal" action="{{ route('patient.update',$patient ->id) }}" method="POST">
	{{ csrf_field() }}
  {{ method_field('PUT') }}
  <input type="hidden" name="assure_id" value="{{ $patient->assure->id }}">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group" id="error" aria-live="polite">
			@if (count($errors) > 0)
			      <div class="alert alert-danger">
				<ul>
				 @foreach ($errors->all() as $error)
			 	           <li>{{ $error }}</li>
				@endforeach
				</ul>
				</div>
			@endif
			</div>
		</div>
	</div>
	<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
		<li class="active"><a data-toggle="tab" href="#Patient">
	   	 	<span class="bigger-130"><strong>Patient</strong></span></a>
	  </li>
		<li  id ="hommelink" @if(count($hommes_c) == 0)  class="invisible" @endif><a data-toggle="tab" href="#Homme">
		 	<span class="bigger-130"><strong>Garde Malde/Homme de Confiance</strong></span></a>
		 </li>
	</ul>	
  <div class="tab-content">
  	<div id="Patient" class="tab-pane fade in active">
			<div class="row">
    		<div class="col-sm-12">
					<h3 class="header smaller lighter blue">Informations administratives</h3>
				</div>
    	</div>
    	<div class="row">
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label" for="nom"><strong>Nom :</strong></label>
				<div class="col-sm-9">
					<input type="text" id="nom" name="nom" placeholder="Nom..." value="{{ $patient->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha />
					{!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
				</div>
			</div>
		</div>{{-- col-sm-6	 --}}
		<div class="col-sm-6">
			<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
				<label class="col-sm-3 control-label" for="prenom"><strong>Prénom :</strong></label>
				<div class="col-sm-9">
					<input type="text" id="prenom" name="prenom" placeholder="Prénom..." value="{{ $patient->Prenom }}" class="form-control form-control-lg col-xs-12 col-sm-12" autocomplete="off" required/>
					{!! $errors->first('prenom', '<p class="alert-danger">:message</p>') !!}
				</div>
			</div>
		</div>{{-- col-sm-6	 --}}
      </div>  {{-- row --}}
      <div class="row">
      	<div class="col-sm-6">
					<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="datenaissance"><strong>Né(e) le :</strong></label>
						<div class="col-sm-9">
							<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance" name="datenaissance" type="text" placeholder="Date de naissance..." data-date-format="yyyy-mm-dd" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" value="{{ $patient->Dat_Naissance }}" required/>
							{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="lieunaissance"><strong class="text-nowrap">Né(e) à :</strong></label>
				    <div class="col-sm-9">
					    <input type="hidden" name="idlieunaissance" id="idlieunaissance" value={{ $patient->Lieu_Naissance }}>
					    <input type="text" id="lieunaissance" class="com_typeahead col-xs-12 col-sm-12" value="{{ $patient->lieuNaissance->nom_commune }}" required/>
						    {!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
				      </div>
					</div>
   			</div>
     	</div>  {{-- row --}}
     	<div class="row">
	   		<div class="col-sm-6">
				<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
					<label class="col-sm-3 control-label" for="sexe"><strong>Sexe :</strong></label>
					<div class="col-sm-9">
						<div class="radio">
							<label>
							<input name="sexe" value="M" type="radio" class="ace" {{ $patient->Sexe == "M" ? "checked" : ""}}/>
								<span class="lbl"> Masculin</span>
							</label>
							<label>
							<input name="sexe" value="F" type="radio" class="ace" {{ $patient->Sexe == "F" ? "checked" : ""}}/>
								<span class="lbl"> Féminin</span>
							</label>
						</div>
					</div>
				</div>
			</div>	{{-- col-sm-6 --}}
			<div class="col-sm-6">
				<div class="form-group">
					<label class="col-sm-3 control-label text-nowrap" for="gs"><strong>Groupe sanguin :</strong></label>
					<div class="col-sm-2">
						<select class="form-control" id="gs" name="gs">
						@if(!isset($patient->group_sang)  && empty($patient->group_sang)) 
							<option value="" selected >------</option>
							<option value="A" >A</option>
							<option value="B">B</option>
							<option value="AB" >AB</option>
							<option value="O" >O</option>
						@else 		
							<option value="" selected >------</option>
							<option value="A" @if( $patient->group_sang =="A") selected @endif>A</option>
							<option value="B" @if( $patient->group_sang =="B") selected @endif>B</option>
							<option value="AB" @if( $patient->group_sang =="AB") selected @endif>AB</option>
							<option value="O" @if( $patient->group_sang =="O") selected @endif>O</option>
						@endif
						</select>
					</div>
					<label class="col-sm-3 control-label no-padding-right" for="rh"><strong>Rhésus :</strong></label>
					<div class="col-sm-2">
					<select id="rh" name="rh">
					@if(!isset($patient->rhesus)  && empty($patient->rhesus)) 
						<option value="" selected >------</option>
						<option value="+">+</option>
						<option value="-">-</option>
					@else
						<option value="" >------</option>
						<option value="+" @if( $patient->rhesus =="+") selected @endif>+</option>
						<option value="-" @if( $patient->rhesus =="-") selected @endif>-</option>
					@endif
					</select>
					</div>
				</div>
			</div>{{-- col-sm-6 --}}
	      	</div> {{-- row --}}
		    	<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
							<label class="col-sm-3 control-label" for="sf">
								<strong class="text-nowrap">Civilité :</strong>
							</label>
							<div class="col-sm-9">
								<select class="form-control civilite" id="sf" name="sf">
									<option value="celibataire" @if( $patient->situation_familiale =='celibataire') selected @endif >Célibataire</option>
									<option value="marie" @if( $patient->situation_familiale =='marie') selected @endif>Marié</option>
									<option value="divorce" @if( $patient->situation_familiale =="divorce") selected @endif >Divorcé</option>
									<option value="veuf" @if( $patient->situation_familiale =="veuf") selected @endif  >Veuf</option>
								</select>
							</div>
							</div>
						</div>
						<div class="col-sm-6 " id="Div-nomjeuneFille"  @if($patient->Sexe == "M") hidden @endif>	
							<label class="col-sm-3 control-label" for="nom_jeune_fille">
								<strong class="text-nowrap">Nom jeune fille:</strong>
							</label>
							<div class="col-sm-9">
								<input type="text" id="nom_jeune_fille" name="nom_jeune_fille" placeholder="Nom jeune fille..." value="{{ $patient->nom_jeune_fille }}" autocomplete = "off" class="col-xs-12 col-sm-12"/>
								 {!! $errors->first('nom_jeune_fille', '<small class="alert-danger">:message</small>') !!}
							</div>		
						</div>
						{{-- /nom de jeune fille --}}
			  	</div>	{{-- row --}}
				  <div class="row">
						<div class="col-sm-12">
						<h3 class="header smaller lighter blue">Contact</h3>
						</div>
			  	</div>	{{-- row --}}
			  	<div class="space-12"></div>	
			  	<div class="row">
						<div class="col-sm-4" style="padding-left:7%">
							<label class="col-sm-3" for="adresse" ><strong>Adresse :&nbsp;</strong></label>
							<input type="text" value="{{ $patient->Adresse }}" id="adresse" name="adresse" placeholder="Adresse..." class="col-sm-9"/>
						</div>
						<div class="col-sm-4" style="margin-top: -0.1%;">
							<label class="col-sm-3" for="commune"><strong>Commune :</strong></label>
							<input type="hidden" name="idcommune" id="idcommune" value="{{ $patient->commune_res }}"/>
							<input type="text" id="commune"  value="{{ $patient->commune->nom_commune}}" class="com_typeahead col-sm-9"/>					
						</div>
						<div class="col-sm-4">
							<label class="col-sm-3"><strong>Wilaya :</strong></label>
						  <input type="hidden" name="idwilaya" id="idwilaya" value="{{ $patient->wilaya->immatriculation_wilaya }}"/>
						  <input type="text" id="wilaya" placeholder="wilaya..." value="{{ $patient->wilaya->nom_wilaya }}" class="col-sm-9"/>	
						</div>	
				</div>{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group" style="padding-left:13%;">
							<label class="control-label text-nowrap col-sm-3" for="mobile1"><i class="fa fa-phone"></i><strong>Mob1:</strong></label>
							<div class="col-sm-3" >
								<select name="operateur1" id="operateur1" class="form-control" required="">
						      @php	$operator = substr($patient->tele_mobile1,0,2) @endphp
			 						<option value="05" @if($operator == '05') selected @endif>05</option>         
								 	<option value="06" @if($operator == '06') selected @endif>06</option>
								  <option value="07" @if($operator == '07') selected @endif>07</option>
	               </select>	
							</div>
							<input id="mobile1" name="mobile1"  maxlength =8 minlength =8 type="tel" autocomplete="off" class="col-sm-4" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX" value= "{{  substr($patient->tele_mobile1,2,10) }}" required />	
						</div>
							
					</div>	 
					<div class="col-sm-4">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="mobile2"><i class="fa fa-phone"></i><strong class="text-nowrap">Mob2 :</strong>
							</label>
							<div class="col-sm-4">
								<select name="operateur2" id="operateur2" class="form-control">
								@if(!isset($patient->tele_mobile2)  && empty($patient->tele_mobile2))		
								  <option value="" selected >XX</option>
								  <option value="05" >05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									@else
									@php  $operator2 = substr($patient->tele_mobile2,0,2) @endphp
									<option value="" >XX</option>
									 <option value="05" @if($operator2 == '05') selected @endif>05</option>
									 <option value="06" @if($operator2 == '06') selected @endif>06</option>
									 <option value="07" @if($operator2 == '07') selected @endif>07</option>
								@endif				
		            </select>
							</div>
							<input id="mobile2" name="mobile2"  maxlength =8 minlength =8  type="tel" autocomplete="off" class="col-sm-4" value="{{  substr($patient->tele_mobile2,2,10) }}" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XX XX XX XX">
						</div>
					</div>		
					<div class="col-sm-4">
						<div class="form-group">
						<div class="col-sm-2">
							<label class="control-label no-padding-right pull-right no-wrap" style=" padding-top: 0px;"><strong>Type :</strong></label>
						</div>
						<div class="col-sm-10">
							<label class="line-height-1 blue">
								<input id="fonc" name="type" value="Assure" type="radio" class="ace" onclick="showTypeEdit('Assure',1)"  @if($patient->Type =='Assure') Checked @endif />
								<span class="lbl">Assuré</span>
							</label>
							<label class="line-height-1 blue">
								<input id="ayant" name="type" value="Ayant_droit" type="radio" class="ace" onclick="showTypeEdit('Ayant_droit',1)" @if($patient->Type =='Ayant_droit') Checked @endif />
								<span class="lbl">Ayant droit</span>
							</label>
							<label class="line-height-1 blue">
								<input id="autre" name="type" value="Autre" type="radio" class="ace" onclick="showTypeEdit('Autre',1)" @if($patient->Type =='Autre') Checked @endif />
								<span class="lbl">Autre</span>
							</label>	
						</div>
						</div>		
					</div>{{-- col-sm-4 --}}
				</div>	{{-- row --}}
				<div class="space-12"></div>
				<div class="row" id="foncform">
					<div class="col-sm-6">
						<div class="form-group">
						 <label class="col-sm-3 control-label" for="Type_p">
							<strong>Type :</strong>
						</label>
						<div class="col-sm-9">
				  			<select class="form-control col-xs-12 col-sm-6" id="Type_p" name="Type_p" >
								<option value="">------</option>
								<option value="Ascendant" @if($patient->Type_p == 'Ascendant')  selected @endif>Ascendant</option>
								<option value="Descendant" @if($patient->Type_p == 'Descendant')  selected @endif>Descendant</option>
								<option value="Conjoint(e)" @if($patient->Type_p == 'Conjoint(e)')  selected @endif>Conjoint(e)</option>
							</select>
						</div>	
						</div>					
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							 <label class="col-sm-4 control-label" for="nsspatient">
								<strong>NSS (patient):</strong>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control col-xs-12 col-sm-6" id="nsspatient" name="nsspatient" value="{{ $patient->NSS }}"
								pattern="[0-9]{2}[0-9]{4}[0-9]{4}[0-9]{2}"  placeholder="XXXXXXXXXXXX" maxlength =12 minlength =12 />
							</div>
						</div>			
					 </div>	
				</div>{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6 starthidden">
					<label for="description"><strong>Autre information :</strong></label>
					<textarea class="form-control" id="description" name="description" placeholder="Description" >{{ $patient->description }}</textarea>
				</div>
			</div>
			@if(count($hommes_c) == 0) 	
			<div class="row">
		      		<div class="col-sm-12">
					<h3 class="header smaller lighter blue">Homme de Confiance</h3>
				</div>
		    </div>
		    <div class="row">
		     		<div class="col-sm-1"></div>		
				<div class="col-sm-11">
					<div class="form-group padding-left">
						<input  type="checkbox" id="hommeConf" value="1"  class="ace input-lg"/>
						<span class="lbl lighter blue"> <strong>Ajouter un Correspondant</strong></span>
					</div>
				</div>				
			</div>		
		@endif	
  	</div> {{-- tab-pane Patient --}}
  		{{-- @if(!isset($hommes_c)) style= "display:none" @endif --}}
  	<div id="Homme" class="tab-pane fade hidden_fields">
					<div class="row">
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
							<div class="widget-box widget-color-blue" id="widget-box-2">
								<div class="widget-header">
									<h5 class="widget-title bigger lighter">
										<i class="ace-icon fa fa-table"></i>Gardes Malades/Hommes de Confiance
									</h5>
									<div class="widget-toolbar widget-toolbar-light no-border">
										<div class="fa fa-plus-circle"></div>{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
											<a href="#" data-target="#gardeMalade" class="btn-xs tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter Garde Malade ou Homme de Confiance" >
												<strong>Ajouter un Garde Malade</strong>
											</a>
									</div>
								</div>
								<div class="widget-body">
									<div class="widget-main no-padding">
									  <table id="listeGardes" class="table nowrap dataTable no-footer" style="width:100%">
					            <thead>
						            <tr>
						              <th hidden></th>
						              <th class ="center"><strong>Nom</strong> </th>
						              <th class ="center"><strong>Prénom</strong></th>
						              <th class ="center"><strong>né(e) le</strong></th>
						              <th class ="center"><strong>Adresse</strong></th>
						              <th class ="center"><strong>Tél</strong></th>
						              <th class ="center"><strong>Relation</strong></th>
						              <th class ="center"><strong>Type Pièce</strong></th>
						              <th class ="center"><strong>N°</strong></th>
						              <th class ="center"><strong>date délevrance</strong></th>
						              <th class="nsort"><em class="fa fa-cog"></em></th>
						            </tr>
					            </thead>
					          <tbody>
					          @foreach($hommes_c as $hom)
					            <tr id="{{ 'garde'.$hom->id }}">
					              <td hidden>{{ $hom->id_patient }}</td>
					              <td>{{ $hom->nom }}</td>
					              <td>{{ $hom->prenom }}</td>
					              <td>{{ $hom->date_naiss }}</td>
					              <td>{{ $hom->adresse }}</td>
					              <td>{{ $hom->mob }}</td>
					              <td>{{ $hom->lien_par }}</td>
					              <td>{{ $hom->type_piece }}</td>
					              <td>{{ $hom->num_piece }}</td>
					              <td>{{ $hom->date_deliv }}</td>
					              <td class="center nosort">
					       					  <button type="button" class="btn btn-xs btn-info open-modal" value="{{$hom->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
                            <button type="button" class="btn btn-xs btn-danger delete-garde" value="{{$hom->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
					          		</td>
					            </tr>
					          @endforeach
					          </tbody>
					         </table>
					        </div>  <!-- widget-main --> 
			         </div> <!-- widget-body -->
		        </div>     <!-- widget-box	 -->
		       </div> <!-- widget-container  -->
					</div>
  		</div>{{-- tab-pane Homme --}}
  	</div> {{-- tab-content --}}
	<div class="hr hr-dotted"></div>
	<div class="row">
		<div class="center">
			<br>
			<button class="btn btn-info btn-sm" type="submit">
				<i class="ace-icon fa fa-save bigger-110"></i>
				Enregistrer
			</button>&nbsp; &nbsp; &nbsp;
			<button class="btn btn-default btn-sm" type="reset">
				<i class="ace-icon fa fa-undo bigger-110"></i>
				Annuler
			</button>
		</div>
	</div>
	</form>
	<div class="row">
    @include('patient.add_gardeMalade')
	</div>

@endsection

