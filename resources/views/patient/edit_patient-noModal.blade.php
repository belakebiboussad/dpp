@extends('app')
@section('title','modifier  le patient')
@section('page-script')
	<script>
		 function showType(value,i){
		 	switch(value){
			              case "Assure":  
			              	$("#nomf").val($("#nom").val());// $("ul#menuPatient li:not(.active.hidden_fields)").css('display', '');
				              $("#prenomf").val($("#prenom").val());
				              $("#datenaissancef").val($("#datenaissance").val());
				              $("#lieunaissancef").val($("#lieunaissance").val());
				              $("#idlieunaissancef").val($("#idlieunaissance").val());
				              $("input[name=sexef][value=" + $('input[name=sexe]:radio:checked').val() + "]").prop('checked', true);  
				              $("#foncform").addClass('hide'); 
				              $('#Type_p').attr('required', false); 
				              $('#nsspatient').attr('required', false);    
				              $('#nsspatient').attr('disabled', true);  
				              addRequiredAttr();
				              break;
			              case "Ayant_droit":
			              	if(i !=0)
			           	    	{
			           	          $("#nomf").val("");
				                   	$("#prenomf").val("");
				                    $("#datenaissancef").val("");
				                    $("#lieunaissancef").val("");		
				                    $("select#grade").prop('selectedIndex', 0);
				                    $("#matf").val("");
				                    $("#NMGSN").val("");            	
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
              			  $("ul#menuPatient li:eq(1)").css('display', 'none');//$("ul#menuPatient li:not(.active) a").prop('disabled', true);
				               $('#nomf').attr('required', false);
				               $('#prenomf').attr('required', false);  // $('#nsspatient').attr('required', false);   
				               $('#nsspatient').attr('disabled', true); 
				                break;         
				}			
		}
		$(function() {
		    var checkbox = $("#hommeConf");
		    checkbox.change(function() {
		 		if(checkbox.is(":checked"))
		    		 	 $("#hommelink").removeClass('invisible');
		    		 else
		    			  $("#hommelink").addClass('invisible');	
			})
		});
		function autocopleteCNais(commune)
		{
			var res = commune.split(",");	
			if($('#fonc').is(':checked'))
			{
				$("#idlieunaissancef").val(res[0]);
				$("#lieunaissancef").val(res[1]);		
			}		
			$("#idlieunaissance").val(res[0]);
		}
		function autocopleteCNaisAS(commune)
		{	
			$("#idlieunaissancef").val(commune);
		}
		function show(wilaya)
		{
			var res = wilaya.split(",");
			$("#idwilaya").val(res[0]);
			$("#wilaya").val(res[1]);
			$("#idcommune").val(res[2]);
		}
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
//////////////////
		function addGardeMaladeFct()
		{
			var form = $('#addGardeMalade');	var pid = $('#patientId').val();var nom = $('#nom_h').val();var prenom = $('#prenom_h').val(); var datenaiss = $('#datenaissance_h').val(); var relation = $('#lien_par').val();				
		  var typePiece = $("input[name='type_piece']:checked").val();var number = $('#num_piece').val();var datePiece = $('#date_piece_id').val();	var adresse = $('#adresse_h').val(); var mobile_h = $('#mobile_h').val();
			$.ajax({
								headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
			          type: form.attr('method'),
			          url:form.attr('action'),
			          data:{pid:pid,nom:nom,prenom:prenom,datenaiss:datenaiss,relation:relation,typePiece:typePiece,number:number,datePiece:datePiece,adresse:adresse,mobile_h:mobile_h},
			          success: function (data,status, xhr) {
			            $("#listeGardes tbody").append(data);
			            $('#gardeMalade').modal('hide');
			          },
			          error: function (data) {
			            console.log('An error occurred.');
			              
			          },
			});
		}	
		$(document).ready(function () {
		   	var bloodhoundcom = new Bloodhound({
		        		  datumTokenizer: Bloodhound.tokenizers.whitespace,
		        		  queryTokenizer: Bloodhound.tokenizers.whitespace,
		     		remote: {
							 url: '/patients/findcom?com=%QUERY%',
				 			wildcard: '%QUERY%'
						},
				});
				$('#commune').typeahead({
					hint: true,
					highlight: true,
					minLength: 1
				},{
						name: 'communenom',
						source: bloodhoundcom,
						display: function(data) {
								return data.nom_commune  //Input value to be set when you select a suggestion. 
						},
						templates: {
							empty: [
								'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucune Commune</div></div>'
							],
							header: [
								'<div class="list-group search-results-dropdown">'
							],
							suggestion: function(data) {
								return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item" onclick="show(\''+data.Id_wilaya+','+data.nom_wilaya+','+data.id_Commune+'\')">' + data.nom_commune+ '</div></div>'
							}
						}
				});
		///////////////////////////////////////////
    /////////// Autocomletecommune de l'assure
    ////////////////
		$('#lieunaissance').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'communenom',
				source: bloodhoundcom,
				display: function(data) {
					return data.nom_commune  //Input value to be set when you select a suggestion. 
				},
				templates: {
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucune Commune</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					suggestion: function(data) {
						return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item" onclick="autocopleteCNais(\''+data.id_Commune+','+data.nom_commune+'\')">' + data.nom_commune+ '</div></div>'
					}
				}	
			});
      //////////////////////
      $('#lieunaissancef').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			}, {
				name: 'communenom',
				source: bloodhoundcom,
				display: function(data) {
					return data.nom_commune  //Input value to be set when you select a suggestion. 
				},
				templates: {
					empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Aucune Commune</div></div>'
					],
					header: [
						'<div class="list-group search-results-dropdown">'
					],
					suggestion: function(data) {
						return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item" onclick="autocopleteCNaisAS(\''+data.id_Commune+'\')">' + data.nom_commune+ '</div></div>'
					}
				}	
			}); 
			////////////////////////////
	    var value =  $("input[type=radio][name='type']:checked").val();
	    showType(value,0);
	    $( ".civilite" ).change(function() {
			  	var civilite= $("select.civilite option").filter(":selected").val();
	  			if((civilite =="marie")|| (civilite =="veuf"))
	  			{
	  				$('#Div-nomjeuneFille').removeAttr('hidden');
	  			}else
	  			{		
	  				$('#Div-nomjeuneFille').attr('hidden','');	
	  			
	  			}
			});
		  $("#edit_hc").click(function(e) { 
				$('#nom_h').prop('readonly', false);
				$('#nom_h').focus();
				$('#prenom_h').attr('readonly', false);
				$('#datenaissance_h').attr('readonly', false);
				$('#lien_par').attr('readonly', false);
				$('#type_piece').attr('readonly', false);
				$('#num_piece').attr('readonly', false);
				$('#date_piece_id').attr('readonly', false);
				$('#adresse_h').attr('readonly', false);
				$('#mobile_h').attr('readonly', false);
				return false;
			});
			$("#add_hc").click(function(e) { 
			 	$('#nom_h').prop('readonly', false);
				$('#prenom_h').attr('readonly', false);
				$('#datenaissance_h').attr('readonly', false);
				$('#lien_par').attr('readonly', false);
				$('#type_piece').attr('readonly', false);
				$('#num_piece').attr('readonly', false);
				$('#date_piece_id').attr('readonly', false);
				$('#adresse_h').attr('readonly', false);
				$('#mobile_h').attr('readonly', false);
				$('#nom_h').val('');
				$('#nom_h').focus();
				//$('#id_h').val('');
				$('#prenom_h').val('');
				$('#datenaissance_h').val('');
				$('#lien_par').val('');
				$('input[name="type_piece"]').prop('checked', false);
				$('#num_piece').val('');
				$('#date_piece_id').val('');
				$('#adresse_h').val('');
				$('#mobile_h').val('');
				$('#etat_h').val('archivé');
				return false;
			});
			 $('#listeGardes').DataTable({
            colReorder: true,
            stateSave: true,
            searching:false,
            "language": {
		                    "url": '/localisation/fr_FR.json'
		      	},

        });

});
	</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>modification Du Patient :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
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
		  <li  @if($patient->Type =="Autre")  style= "display:none" @endif><a data-toggle="tab" href="#Assure" >
    			<span class="bigger-130"><strong>Assure</strong></span></a>
    	</li>
    		{{--  --}}
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
								<label class="col-sm-3 control-label" for="nom">
									<strong>Nom :</strong> 
								</label>
								<div class="col-sm-9">
									<input type="text" id="nom" name="nom" placeholder="Nom..." value="{{ $patient->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
										{!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
								</div>
							</div>
						</div>{{-- col-sm-6	 --}}
						<div class="col-sm-6">
							<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
								<label class="col-sm-3 control-label" for="prenom">
									<strong>Prénom :</strong>
								</label>
								<div class="col-sm-9">
									<input type="text" id="prenom" name="prenom" placeholder="Prénom..."value="{{ $patient->Prenom }}"class="form-control form-control-lg col-xs-12 col-sm-12" autocomplete="off" required/>
									{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
								</div>
							</div>
						</div>{{-- col-sm-6	 --}}
	      	</div>  {{-- row --}}
	      	<div class="row">
	      		<div class="col-sm-6">
							<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
								<label class="col-sm-3 control-label" for="datenaissance">
									<strong>Né(e) le :</strong>
								</label>
								<div class="col-sm-9">
									<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance" name="datenaissance" type="text" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" value="{{ $patient->Dat_Naissance }}" required/>
									{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
								<label class="col-sm-3 control-label" for="lieunaissance">
									<strong class="text-nowrap">Lieu de naissance :</strong>
								</label>
							  <div class="col-sm-9">
							    <input type="hidden" name="idlieunaissance" id="idlieunaissance" value={{ $patient->Lieu_Naissance }}>
						  	  <input type="text" id="lieunaissance" name="" placeholder="Lieu de naissance..." utocomplete = "off" class="col-xs-12 col-sm-12" value="{{ $patient->lieuNaissance->nom_commune }}" required/>
							    {!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
							  </div>
							</div>
	   			  </div>
	      	</div>  {{-- row --}}
	      	<div class="row">
	      		<div class="col-sm-6">
							<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
								<label class="col-sm-3 control-label" for="sexe">
									<strong>Sexe :</strong>
								</label>
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
								<label class="col-sm-3 control-label text-nowrap" for="gs">
									<strong>Groupe sanguin :</strong>
								</label>
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
								<label class="col-sm-3 control-label no-padding-right" for="rh">
									<strong>Rhésus :</strong>
								</label>
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
						<div class="col-sm-6" id="Div-nomjeuneFille" @if($patient->nom_jeune_fille == "") hidden @endif>	
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
							<label class="" for="adresse" ><strong>Adresse :&nbsp;</strong></label>
							<input type="text" value="{{ $patient->Adresse }}" id="adresse" name="adresse" placeholder="Adresse..."/>
						</div>
						<div class="col-sm-4" style="margin-top: -0.1%;">
							<label><strong>Commune :</strong></label>
							<input type="hidden" name="idcommune" id="idcommune" value="{{ $patient->commune_res }}"/>
							<input type="text" id="commune"  value="{{ $patient->commune->nom_commune}}"/>					
						</div>
						<div class="col-sm-4">
							   	<label><strong>Wilaya :</strong></label>
						  	 	<input type="hidden" name="idwilaya" id="idwilaya" value="{{ $patient->wilaya->immatriculation_wilaya }}"/>
						      <input type="text" id="wilaya" placeholder="wilaya..." value="{{ $patient->wilaya->nom_wilaya }}"/>	
						</div>	
				</div>{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group" style="padding-left:13%;">
							<label class="control-label text-nowrap col-sm-3 for="mobile1"><i class="fa fa-phone"></i><strong>Mob1:</strong></label>
							<div class="col-sm-3" >
								<select name="operateur1" id="operateur1" class="form-control" required="">
						                                     @php	$operator = substr($patient->tele_mobile1,0,2) @endphp
			 						<option value="05" @if($operator == '05') selected @endif >05</option>         
								   	<option value="06" @if($operator == '06') selected @endif >06</option>
								           <option value="07" @if($operator == '07') selected @endif>07</option>
	                       						</select>	
							</div>
							<input id="mobile1" name="mobile1"  maxlength =8 minlength =8  name="mobile1" type="tel" autocomplete="off" class="col-sm-4" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX"  value= "{{  substr($patient->tele_mobile1,2,10) }}" required />	
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
								<input id="fonc" name="type" value="Assure" type="radio" class="ace" onclick="showType('Assure',1)"  @if($patient->Type =='Assure') Checked @endif />
								<span class="lbl">Assuré</span>
							</label>
							<label class="line-height-1 blue">
								<input id="ayant" name="type" value="Ayant_droit" type="radio" class="ace" onclick="showType('Ayant_droit',1)" @if($patient->Type =='Ayant_droit') Checked @endif />
								<span class="lbl">Ayant droit</span>
							</label>
							<label class="line-height-1 blue">
								<input id="autre" name="type" value="Autre" type="radio" class="ace" onclick="showType('Autre',1)" @if($patient->Type =='Autre') Checked @endif />
								<span class="lbl">Autre</span>
							</label>	
						</div>
						</div>		
					</div>{{-- col-sm-6 --}}
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
								<option value="Conjoint" @if($patient->Type_p == 'Conjoint')  selected @endif>Conjoint</option>
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
								pattern="[0-9]{2}[0-9]{4}[0-9]{4}[0-9]{2}"  placeholder="XXXXXXXXXXXX" />
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
						<span class="lbl lighter blue"> <strong>Ajouter Garde Malade/Homme de Confiance</strong></span>
					</div>
				</div>				
			</div>		
			@endif	
  		</div> {{-- tab-pane Patient --}}
  		@if(isset($assure) && !empty($assure))
  		<div id="Assure" class="tab-pane fade">
  			<div id ="assurePart">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="header smaller lighter blue">
							<strong>Information L'Assuré(e)</strong>
						</h3>
					</div>	
				</div>{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="nomf">
								<strong>Nom :</strong> 
								</label>
							<div class="col-sm-9">
								<input type="text" id="nomf" name="nomf"  value="{{ $assure->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
							</div>
							<br>
							</div>
							<br>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="prenomf">
								<strong>Prénom :</strong>
							</label>
							<div class="col-sm-9">
								<input type="text" id="prenomf" name="prenomf"  value="{{ $assure->Prenom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
							</div>
							<br>
						</div>
						<br>
					</div>
				</div>{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="datenaissancef">
								<strong class="text-nowrap">Né(e) le :</strong>
							</label>
							<div class="col-sm-9">
							<input class="col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" value="{{ $assure->Date_Naissance }}"  />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="lieunaissancef">
								<span class="text-nowrap"><strong>Lieu de naiss :</strong></span>
							</label>
							<div class="col-sm-9">
							 	<input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="{{ ($patient->Type !="Autre") ? $assure->lieunaissance : '' }}  ">
								<input type="text" id="lieunaissancef" name=""class="col-xs-12 col-sm-12" value="{{ ($patient->Type !="Autre") ? $assure->lieuNaissance->nom_commune : '' }}" autocomplete= "off" />
							</div>
							<br>
						</div>
						<br>
					</div>
				</div>	{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
		        <div class="form-group">
					  	<label class="col-sm-3 control-label no-padding-right" for="sexe">
					    	<Strong>Sexe:</Strong>
					    </label>
		          <div class="col-sm-9">
					                         <div class="radio">
					                         <label>
					                          <input name="sexef" value="M" type="radio" class="ace" {{ $assure->Sexe === "M" ? "Checked" : "" }}/>
					                    		<span class="lbl"> Masculin</span>
					                          </label>
					                         <label>
					                         <input name="sexef" value="F" type="radio" class="ace" {{  $assure->Sexe=== "F" ? "checked" : "" }} />
					                         <span class="lbl"> Féminin</span>
					                         </label>
					                         </div>
		                    				</div>
		             			</div>
	           				</div>
	           				<div class="col-sm-6" id="statut">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="etatf">
							<strong>Etat :</strong>
							</label>
							<div class="col-sm-9">
							<div class="radio">
							<label hidden>
							<input name="etat" value="" type="radio" class="ace" @if(!isset($assure->Etat)  && empty($assure->Etat)) Checked @endif />
								<span class="lbl"> Autre</span>
							</label>
							<label>
								<input name="etat" value="En exercice" type="radio" class="ace" {{ $assure->Etat ==="En exercice" ? "Checked":"" }} />
								<span class="lbl"> En exercice</span>
							</label>
							<label>
								<input name="etat" value="Retraite" type="radio" class="ace" {{ $assure->Etat ==="Retraite" ? "Checked":"" }} />
								<span class="lbl"> Retraité</span>
							</label>
							<label>
								<input name="etat" value="Invalide" type="radio" class="ace" {{ $assure->Etat ==="Invalide" ? "Checked":"" }} />
									<span class="lbl"> Invalide</span>
							</label>
							<label>
								<input name="etat" value="Mise en disponibilite" type="radio" class="ace"  {{ $assure->Etat ==="Mise en disponibilite" ? "Checked":"" }} />
									<span class="lbl"> Mise en disponibilité</span>
							</label>
							</div>
							</div>
						</div>
					</div>	
				</div>{{-- row --}}
				<div class="space-12"></div>		
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label " for="grade">
								<strong>Grade :</strong>
							</label>
							<div class="col-sm-9">
							<select id="grade" name="grade" class="col-xs-12 col-sm-6"/>
							@if ((isset($assure))&& isset($assure->Grade))
								@foreach ($grades as $key=>$grade)
								<option value="{{ $grade->id }}" {{ $assure->Grade === $grade->id   ? "selected":"" }} >{{ $grade->nom }}</option>
								@endforeach
							@endif
							</select>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3" for="matf">
								<strong>Matricule :</strong>
							</label>
							<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6" value="{{ $assure->Matricule }}"  placeholder="XXXXXXXX" />
							</div>
							</div>
						</div>
					</div>
				</div>	{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3" for="NMGSN">
								<strong>NMGSN :</strong>
							</label>
							<div class="col-sm-9">
								<div class="clearfix">
									<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12" value="{{ $assure->NMGSN }}" />
								</div>
							</div>
						</div>
						<br>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3" for="nss2">
								<strong>NSS :</strong>
							</label>
							<div class="col-sm-9">
							<div class="clearfix">
							<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12" placeholder="XXXXXXXXXXXX" 
							value="{{ $assure->NSS }}" maxlength =12 minlength =12/>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
							</div>
							</div>
						</div>
						<br><br>
					</div>	
				</div>{{-- row --}}	
			</div>{{-- assurePart --}}
  		</div>{{-- tab-pane Assure --}} 
  	  @endif
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
										{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
										<div class="fa fa-plus-circle"></div>
																	<!-- {{$patient->id}} -->
										<a href="#" data-target="#gardeMalade" class="btn btn-lg tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter Garde Malade ou Homme de Confiance" >
											<b>Ajouter un Garde Malade </b>
										</a>

									</div>
								</div>
								<div class="widget-body">
									<div class="widget-main no-padding">
									  <table id="listeGardes" class="table nowrap dataTable no-footer" style="width:100%">
					            <thead>
						            <tr>
						              <th hidden></th>
						              <th>Nom</th>
						              <th>Prénom</th>
						              <th>né(e) le</th>
						              <th>Adresse</th>
						              <th>Tél</th>
						              <th>Relation</th>
						              <th>Type Pièce</th>
						              <th>N°</th>
						              <th>Date délevrance</th>
						              <th></th>
						            </tr>
					            </thead>
					          <tbody>
					          @foreach($hommes_c as $hom)
					            <tr>
					              <td hidden>{{ $hom->id }}</td>
					              <td>{{ $hom->nom }}</td>
					              <td>{{ $hom->prénom }}</td>
					              <td>{{ $hom->date_naiss }}</td>
					              <td>{{ $hom->adresse }}</td>
					              <td>{{ $hom->mob }}</td>
					              <td>{{ $hom->lien_par }}</td>
					              <td>{{ $hom->type_piece }}</td>
					              <td>{{ $hom->num_piece }}</td>
					              <td>{{ $hom->date_deliv }}</td>
					              <td class="center">
					       		<a href="{{ route('hommeConfiance.edit',$hom->id )}}" class = "btn btn-info btn-xs" data-toggle="tooltip" title="modifier"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></a>
							<a href="{{ route('hommeConfiance.destroy',$hom->id) }}" class="btn btn-danger btn-xs" data-method="DELETE" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></a>		
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
				Réinitialiser
			</button>
		</div>
	</div>
	</form>
	<div class="row">
    @include('corespondants.add')
	</div>

@endsection

