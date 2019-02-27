@extends('app')
@section('page-script')
	<script>
		 function showType(value,i){
		 	switch(value){
			              case "Assure":  	
			              	// $("ul#menuPatient li:not(.active.hidden_fields)").css('display', '');
				             $("#nomf").val($("#nom").val());
				              $("#prenomf").val($("#prenom").val());
				               $("#datenaissancef").val($("#datenaissance").val());
				               $("#lieunaissancef").val($("#lieunaissance").val());
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
				               $('#prenomf').attr('required', false);
				               $('#nsspatient').attr('required', false);    
				               $('#nsspatient').attr('disabled', true); 
				                break;         
				}			
			}
			$(function() {
			               var checkbox = $("#hommeConf");
			    	checkbox.change(function() {
		    			  $(".hidden_fields").toggle();				
			           	 })
			}); 
			$(document).ready(function () {
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
	    		});
	</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>modification Du Patient :</strong> {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
	<div class="pull-right">
		<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				 Rechercher un Patient
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
	    	<li class="hidden_fields" @if(!isset($homme_c))  style= "display:none" @endif><a data-toggle="tab" href="#Homme">
	    		<span class="bigger-130"><strong>Homme de Confiance</strong></span></a>
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
						<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" value="{{ $patient->Dat_Naissance }}" required/>
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
					<input type="text" id="lieunaissance" name="lieunaissance" placeholder="Lieu de naissance..."  autocomplete = "off" class="col-xs-12 col-sm-12" value="{{ $patient->Lieu_Naissance }}"required/>
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
				<div class="col-sm-5">
					<div class="form-group">
						<label class="control-label col-sm-3" for="adresse"><strong>Adresse :</strong></label>
						<div class="col-sm-9">
						<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse...">{{ $patient->Adresse }}</textarea>	
						</div>
					</div>
				</div>{{-- coli-sm-6 --}}
				<div class="col-sm-7">
					<div class="form-group">
						<div class="form-group">
						<label class="control-label text-nowrap col-sm-2 for="operateur1"><i class="fa fa-phone"></i><strong>Mob1:</strong></label>
						<div class="col-sm-2" style="width:80px;">
							<select name="operateur1" id="operateur1" class="form-control" required="">
					                                     @php	$operator = substr($patient->tele_mobile1,0,2) @endphp
		 						<option value="05" @if($operator == '05') selected @endif >05</option>         
							   	<option value="06" @if($operator == '06') selected @endif >06</option>
							           <option value="07" @if($operator == '07') selected @endif>07</option>
                       					</select>	
						</div>
						<input id="mobile1" name="mobile1"  maxlength =8 minlength =8  name="mobile1" type="tel" autocomplete="off" class="col-sm-2" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX"  value= "{{  substr($patient->tele_mobile1,2,10) }}" required />	
						<label class="control-label text-nowrap col-sm-2 for="mobile2"><i class="fa fa-phone"></i><strong>Mob2:</strong></label>
						<div class="col-sm-2" style="width:80px;">
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
          						<input id="mobile2" name="mobile2"  maxlength =8 minlength =8  type="tel" autocomplete="off" class="col-sm-2" value="{{  substr($patient->tele_mobile2,2,10) }}" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XX XX XX XX">
						</div>
					</div>
				</div>
			</div>{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6">
					<div class="col-sm-2">
						<label class="control-label no-padding-right pull-right" style=" padding-top: 0px;"><strong>Type :</strong></label>
					</div>
					<div class="col-sm-9">
						<label class="line-height-1 blue">
							<input id="fonc" name="type" value="Assure" type="radio" class="ace" onclick="showType('Assure',1)"  @if($patient->Type =='Assure') Checked @endif />
							<span class="lbl"> Assuré(e)</span>
						</label>&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="ayant" name="type" value="Ayant_droit" type="radio" class="ace" onclick="showType('Ayant_droit',1)" @if($patient->Type =='Ayant_droit') Checked @endif />
							<span class="lbl"> Ayant droit</span>
						</label>&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="autre" name="type" value="Autre" type="radio" class="ace" onclick="showType('Autre',1)" @if($patient->Type =='Autre') Checked @endif />
							<span class="lbl"> Autre</span>
						</label>	
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
			@if(!isset($homme_c)  && empty($homme_c)) 	
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
					<span class="lbl lighter blue"> <strong>Ajouter Homme de Confiance</strong></span>
					</div>
				</div>				
			</div>		
			@endif	
	      	</div> {{-- tab-pane --}}
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
							<input class="col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" data-date-format="yyyy-mm-dd" value="{{ $assure->Date_Naissance }}"  />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="lieunaissancef">
								<span class="text-nowrap"><strong>Lieu de naiss :</strong></span>
							</label>
							<div class="col-sm-9">
							<input type="text" id="lieunaissancef" name="lieunaissancef"class="col-xs-12 col-sm-12" value="{{ $assure->lieunaissance }}" autocomplete= "off" />
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
	           				<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label " for="grade">
								<strong>Grade :</strong>
							</label>
							<div class="col-sm-9">
							<select id="grade" name="grade" class="col-xs-12 col-sm-6"/>
							<option value="" @if(!isset($assure->Grade)  && empty($assure->Grade)) Selected @endif   >---------------------</option>
							<option value="Agent de police AP" {{ $assure->Grade === "Agent de police AP" ? "Selected":"" }} >Agent de police AP</option>
							<option value="Brigadier de police BP" {{ $assure->Grade === "Brigadier de police BP" ? "Selected":"" }}>Brigadier de police BP</option>
							<option value="Brigadier-Chef"  {{ $assure->Grade === "Brigadier-Chef" ? "Selected":"" }} >Brigadier-Chef</option>
							<option value="Inspecteur de Police" {{ $assure->Grade === "Inspecteur de Police" ? "Selected":"" }}>Inspecteur de Police</option>
							<option value="Inspecteur Principal de Police" {{ $assure->Grade === "Inspecteur Principal de Police" ? "Selected":"" }}>Inspecteur Principal de Police</option>
							<option value="Lieutenant de police" {{ $assure->Grade === "Lieutenant de police" ? "Selected":"" }}>Lieutenant de police</option>
							<option value="Commissaire de Police"  {{ $assure->Grade === "Commissaire de Police" ? "Selected":"" }}>Commissaire de Police</option>
							<option value="Commissaire Principal de Police" {{ $assure->Grade === "Commissaire Principal de Police" ? "Selected":"" }}>Commissaire Principal de Police</option>
							<option value="Commissaire Divisionnaire de Police" {{ $assure->Grade === "Commissaire Divisionnaire de Police" ? "Selected":"" }}>Commissaire Divisionnaire de Police</option>
							<option value="Contrôleur de Police" {{ $assure->Grade === "Contrôleur de Police" ? "Selected":"" }}>Contrôleur de Police</option>
							<option value="Contrôleur Général de Police" {{ $assure->Grade === "Contrôleur Général de Police" ? "Selected":"" }}>Contrôleur Général de Police</option>
							</select>
							</div>
						</div>
					</div>
				</div>{{-- row --}}
				<div class="space-12"></div>		
				<div class="row">
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
							<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12" placeholder="XXXXXXXXXXXX" value="{{ $assure->NSS }}"/>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
							</div>
							</div>
						</div>
						<br><br>
					</div>	
				</div>{{-- row --}}	
			</div>{{-- assurePart --}}
	      	</div> {{-- tab-pane  assure--}}
	      	{{-- deuxieme --}}
	      	<div id="Homme" class="tab-pane fade hidden_fields" @if(!isset($homme_c)) style= "display:none" @endif>
	      		<div class="row">
				<div class="col-sm-12">				
					<h3 class="header smaller lighter blue">
						Informations de l'homme de confiance
						&nbsp;&nbsp;&nbsp;
						 <a class="orange" href="#" id="edit_hc" ><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;&nbsp;
						 <a class="green" href="#" id="add_hc"><i class="glyphicon glyphicon-plus-sign"></i></a>
					</h3>

				</div>
			</div>	{{-- row --}}
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group ">
						<label class="col-sm-3 control-label no-padding-right" for="nom_h">
							<b>Nom :</b> 
						</label>
						<div class="col-sm-9">
							<input type="hidden" id="id_h" name="id_h"  @if(isset($homme_c)) value="{{ $homme_c->id}}" @endif/>
							<input type="hidden" id="etat_h" name="etat_h" @if(isset($homme_c)) value="actuel" @endif/>
							<input type="text" id="nom_h" name="nom_h" @if(isset($homme_c)) value="{{ $homme_c->nom }}" @endif placeholder="Nom..." class="col-xs-12 col-sm-6" readonly/>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group ">
						<label class="col-sm-3 control-label no-padding-right" for="prenom_h">
							<b>Prénom :</b>
						</label>
						<div class="col-sm-9">
						<input type="text" id="prenom_h" name="prenom_h" @if(isset($homme_c)) value="{{ $homme_c->prénom }}" @endif placeholder="Prénom..." class="col-xs-12 col-sm-6" readonly/>
						</div>
					</div>
				</div>
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group ">
						<label class="col-sm-3 control-label no-padding-right" for="datenaissance_h">
							<b class="text-nowrap">Né(e) le :</b>
						</label>
						<div class="col-sm-9">
						<input class="col-xs-12 col-sm-6 date-picker" id="datenaissance_h" name="datenaissance_h" @if(isset($homme_c)) value="{{ $homme_c->date_naiss}}" @endif type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" readonly />
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group ">
						<label class="col-sm-3 control-label no-padding-right" for="lien_par">
							<b>lien de parenté :</b>
						</label>
						<div class="col-sm-5">
							<select class="form-control" id="lien_par" name="lien_par" placeholder="date de délivrance ..." readonly>
								
								@if(isset($homme_c))
								<option  value="{{ $homme_c->lien_par }}"> {{ $homme_c->lien_par }}</option>
								@else
								<option value="">Sélectionner...</option>
								@endif
								<option value="conjoint">Conjoint(e)</option>
								<option value="père">Père</option>
								<option value="mère">Mère</option>
								<option value="frère">Frère </option>
								<option value="soeur">Soeur </option>
								<option value="membre_famille">Membre de famille </option>
								<option value="ami">Ami </option>
							</select>
						</div>
					</div>
				</div>			
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="type_piece">
							<b>Type de la pièce d'identité :</b>
						</label>
						<div class="col-sm-9">					
							<div class="radio">
								<label>
								<input id="type_piece" name="type_piece" value="CNI" type="radio" class="ace" readonly @if(isset($homme_c)) {{ $homme_c->type_piece ==="CNI" ? "Checked":"" }} @else Checked  @endif />
									<span class="lbl">carte nationale d'identité</span>
								</label>
								<label>
									<input id="type_piece" name="type_piece" value="Permis" type="radio" class="ace" readonly @if(isset($homme_c)) {{ $homme_c->type_piece ==="Permis" ? "Checked":"" }} @endif />
									<span class="lbl">Permis de Conduire</span>
								</label>
								<label>
									<input id="type_piece" name="type_piece" value="passeport" type="radio" class="ace" readonly @if(isset($homme_c)) {{ $homme_c->type_piece ==="passeport" ? "Checked":"" }} @endif />
									<span class="lbl"> Passeport</span>
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
						<label class="col-sm-3 control-label no-padding-right" for="sf">
							<b>N° de la pièce: </b>
						</label>
						<div class="col-sm-9">
						<input type="text" id="num_piece" name="num_piece" @if(isset($homme_c)) value="{{ $homme_c->num_piece }}" @endif placeholder="N° pièce..." class="col-xs-12 col-sm-6" readonly/>
					</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group ">
						<label class="col-sm-3 control-label no-padding-right" for="date_piece_id">
							<b class="text-nowrap">Délivré le :</b>
						</label>
						<div class="col-sm-9">
						<input class="col-xs-12 col-sm-6 date-picker" id="date_piece_id" name="date_piece_id" @if(isset($homme_c)) value="{{$homme_c->date_naiss}}" @endif type="text" data-date-format="yyyy-mm-dd" placeholder="date de délivrance ..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" readonly/>
						</div>
					</div>
				</div>
			</div>{{-- row --}}
			<div class="row">
				<div class="col-sm-12">
					<h3 class="header smaller lighter blue">
						Informations Contact
					</h3>
				</div>
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6">
					<div>
						<i class="fa fa-map-marker light-orange bigger-110"></i>
						<label for="adresse"><b>Adresse :</b></label>
						<textarea class="form-control" id="adresse_h" name="adresse_h" placeholder="Adresse..." readonly>@if(isset($homme_c))  {{ $homme_c->adresse }} @endif</textarea>
					</div>
				</div>
				<div class="col-sm-1">
				</div>
				<div class="col-sm-5">
					<div class="form-group col-sm-8">
						<i class="fa fa-phone"></i>
						<label for="mobile_h"><b>Tél-mob : </b></label>
						<br/>
						<input type="tel" id="mobile_h" name="mobile_h" @if(isset($homme_c)) value="{{$homme_c->mob}}" @endif placeholder="XX XX XX XX XX" autocomplete="off" maxlength="10" minlength="10"  pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"  class="col-sm-12"readonly>
						<span class="tel validity"></span>
					</div>
				</div>			
			</div>	{{-- row --}}	
	      	</div>    {{-- fin homme pane --}}
	</div> {{-- tab-content --}}
	<div class="hr hr-dotted"></div>
	<div class="row">
		<div class="center">
			<br>
			<button class="btn btn-info" type="submit">
				<i class="ace-icon fa fa-save bigger-110"></i>
				Enregistrer
			</button>&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="ace-icon fa fa-undo bigger-110"></i>
				Réinitialiser
			</button>
		</div>
	</div>	
@endsection