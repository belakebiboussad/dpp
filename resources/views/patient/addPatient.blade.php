@extends('app')
@section('page-script')
	<script>
		$( document ).ready(function() {
			$( ".civilite" ).change(function() {
				var civilite= $("select.civilite option").filter(":selected").val();
	  			if((civilite =="marie")|| (civilite =="veuf"))
	  				$('#Div-nomjeuneFille').removeAttr('hidden');
	  			else
	  				$('#Div-nomjeuneFille').attr('hidden','');	
			});
		});
	function showType(value){
    		switch(value){
		           case "Assure":
		                     $("#nomf").val($("#nom").val());
		                     $("#prenomf").val($("#prenom").val());
		                     $("#datenaissancef").val($("#datenaissance").val());
		                     $("#lieunaissancef").val($("#lieunaissance").val());
		                     $("input[name=sexef][value=" + $('input[name=sexe]:radio:checked').val() + "]").prop('checked', true);  
		                     $("#foncform").addClass('hide'); 
		                     $('#Type_p').attr('required', false);  
		                     addRequiredAttr();
		                      break;
		           case "Ayant_droit":
		                    $("#nomf").val("");
		                    $("#prenomf").val("");
		                    $("#foncform").removeClass('hide');
		                    $('#Type_p').attr('required', true); 
		                    addRequiredAttr();
		                
		                break;
		           case "Autre":
		                     $(".starthidden").show(250);
		                     $("#foncform").addClass('hide');
		                     $('#Type_p').attr('required', false); 
		                     $("ul#menuPatient li:not(.active) a").prop('disabled', true);
		               break;         
			}			
		}
	</script>
@endsection
@section('main-content')
<div class="container-fluid">
<div class="row">
<div class="page-header">
	<h1>Ajouter Un Patient</h1>
</div>
<form class="form-horizontal" id = "addPAtient" action="{{ route('patient.store') }}" method="POST" role="form" autocomplete="off" onsubmit="return checkFormAddPAtient(this);">
	  {{ csrf_field() }}
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
    		<li><a data-toggle="tab" href="#Assure">
    			<span class="bigger-130"><strong>Assure</strong></span></a>
    		</li>
    		<li><a data-toggle="tab" href="#Homme_C">
    			<span class="bigger-130"><b>Homme de confiance</b></span></a>
    		</li>

  	</ul>
	<div class="tab-content">
	 	<div id="Patient" class="tab-pane fade in active">
	      		<div class="row">
	      			<div class="col-sm-6">
					<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="nom">
							<strong>Nom :</strong> 
						</label>
						<div class="col-sm-9">
							<input type="text" id="nom" name="nom" placeholder="Nom..." class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
								{!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="prenom">
							<strong>Prénom :</strong>
						</label>
						<div class="col-sm-9">
							<input type="text" id="prenom" name="prenom" placeholder="Prénom..." class="form-control form-control-lg col-xs-12 col-sm-12" autocomplete="off" required/>
							{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>
		      	</div> {{-- row --}}
		      	<div class="row">
		      		<div class="col-sm-6">
					<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="datenaissance">
							<strong>Né(e) le :</strong>
						</label>
						<div class="col-sm-9">
							<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required/>
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
					<input type="text" id="lieunaissance" name="lieunaissance" placeholder="Lieu de naissance..."  autocomplete = "off" class="col-xs-12 col-sm-12" required/>
					 {!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
					</div>
					</div>
				</div>
		      	</div>{{-- row --}}
		      	<div class="row">
				<div class="col-sm-6">
					<div class="form-group {{ $errors->has('sexe') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="sexe">
							<strong>Sexe :</strong>
						</label>
						<div class="col-sm-9">
							<div class="radio">
							<label>
							<input name="sexe" value="M" type="radio" class="ace" checked />
								<span class="lbl"> Masculin</span>
							</label>
							<label>
							<input name="sexe" value="F" type="radio" class="ace" />
								<span class="lbl"> Féminin</span>
							</label>
							</div>
						</div>	
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label text-nowrap" for="gs">
							<strong>Groupe sanguin :</strong>
						</label>
						<div class="col-sm-2">
							<select class="form-control" id="gs" name="gs">
								<option value="">------</option>
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="AB">AB</option>
								<option value="O">O</option>
							</select>
						</div>
						<label class="col-sm-3 control-label no-padding-right" for="rh">
							<strong>Rhésus :</strong>
						</label>
						<div class="col-sm-2">
							<select id="rh" name="rh">
								<option value="">------</option>
								<option value="+">+</option>
								<option value="-">-</option>
							</select>
						</div>
					</div>	
				</div>
			</div>{{-- row --}}
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
					<label class="col-sm-3 control-label" for="sf">
						<strong class="text-nowrap">Cevilite :</strong>
					</label>
					<div class="col-sm-9">
						<select class="form-control civilite" id="sf" name="sf">
							<option value="">------</option>
							<option value="celibataire">Célibataire(e)</option>
							<option value="marie">Marié(e)</option>
							<option value="divorce">Divorcé(e)</option>
							<option value="veuf">Veuf(veuve)</option>
						</select>
					</div>
					</div>
				</div>
				<div class="col-sm-6" id="Div-nomjeuneFille" hidden>
					<label class="col-sm-3 control-label" for="nom">
						<strong class="text-nowrap">Nom  jeune fille:</strong>
					</label>
					<div class="col-sm-9">
					<input type="text" id="nom_jeune_fille" name="nom_jeune_fille" placeholder="Nom jeune fille..."  autocomplete = "off" class="col-xs-12 col-sm-12" />
					 {!! $errors->first('nom_jeune_fille', '<small class="alert-danger">:message</small>') !!}
					</div>
				</div>{{-- col-sm-6 --}}
				{{-- /nom de jeune fille --}}
			</div>	{{-- row --}}
			<div class="row">
				<div class="col-sm-12">
				<h3 class="header smaller lighter blue">Contact</h3>
				</div>
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-sm-3" for="adresse"><strong>Adresse :</strong></label>
						<div class="col-sm-9">
						<textarea class="form-control" id="adresse" name="adresse" placeholder="Adresse..."></textarea>	
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<div class="form-group">
						<label class="control-label text-nowrap col-sm-2 for="mobile1"><i class="fa fa-phone"></i><strong>Mob1 :</strong></label>
						<div class="col-sm-2">
							<select name="operateur1" id="operateur1" class="form-control" required="">
							           <option value="">XX</option>
							         	<option value="05">05</option>         
							   	<option value="06">06</option>
							           <option value="07">07</option>
                       					</select>	
						</div>
						<input id="mobile1" name="mobile1"  maxlength =8 minlength =8  name="mobile1" type="tel" autocomplete="off" class="col-sm-2" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX" required />	
						<label class="control-label text-nowrap col-sm-2 for="mobile2"><i class="fa fa-phone"></i><strong>Mob2 :</strong></label>

						<div class="col-sm-2">
				        			<select name="operateur2" id="operateur2" class="form-control">
						           	<option value="">XX</option>
						         		<option value="05">05</option>         
						   		<option value="06">06</option>
						          		 <option value="07">07</option>
                       					</select>
          						</div>
          						<input id="mobile2" name="mobile2"  maxlength =8 minlength =8  type="tel" autocomplete="off" class="col-sm-2" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XXXXXXXX">
						</div>
					</div>
				</div>
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				 <div class="form-group">
					<div class="col-sm-1">
						<label class="control-label no-padding-right pull-right" style=" padding-top: 0px;"><strong>Type :</strong></label>
					</div>
					<div class="col-sm-9">
						<label class="line-height-1 blue">
							<input id="fonc" name="type" value="Assure" type="radio" class="ace" onclick="showType('Assure')" />
							<span class="lbl"> Assuré(e)</span>
						</label>&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="ayant" name="type" value="Ayant_droit" type="radio" class="ace" onclick="showType('Ayant_droit')" Checked/>
							<span class="lbl"> Ayant droit</span>
						</label>&nbsp;&nbsp;&nbsp;
						<label class="line-height-1 blue">
							<input id="autre" name="type" value="Autre" type="radio" class="ace" onclick="showType('Autre')"/>
							<span class="lbl"> Autre</span>
						</label>	
					</div>
				</div>
			</div>	{{-- row --}}
			<div class="row" id="foncform">
				<div class="col-sm-6">
				<div class="form-group">
					 <label class="col-sm-3 control-label" for="Type_p">
					<strong>Type :</strong>
					</label>
					<div class="col-sm-9">
					<select class="form-control col-xs-12 col-sm-6" id="Type_p" name="Type_p" required>
						<option value="">------</option>
						<option value="Ascendant">Ascendant</option>
						<option value="Descendant">Descendant</option>
						<option value="Conjoint">Conjoint</option>
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
						<input type="text" class="form-control col-xs-12 col-sm-6" id="nsspatient" name="nsspatient"
						pattern="^\[0-9]{2}+' '+\[0-9]{4} +' '+\[0-9]{4}+' '+[0-9]{2}$"  placeholder="XXXXXXXXXXXX" maxlength =12 minlength =12 />
					</div>
				</div>			
			 	</div> 	
			</div> 	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-6 starthidden">
					<label for="description"><strong>Autre information :</strong></label>
					<textarea class="form-control" id="description" name="description" placeholder="Description du la dérogation" ></textarea>
				</div>
			</div>
		</div> 	{{-- tab-pane --}}
		<div id="Assure" class="tab-pane ">
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
							<input type="text" id="nomf" name="nomf" placeholder="Nom..." class="col-xs-12 col-sm-12" />
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
							<input type="text" id="prenomf" name="prenomf" placeholder="Prénom..." class="col-xs-12 col-sm-12" />
						</div>
						<br>
						</div>
						<br>
					</div>
				</div>
				{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="datenaissancef">
								<strong class="text-nowrap">Né(e) le :</strong>
							</label>
							<div class="col-sm-9">
							<input class="col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
						<label class="col-sm-3 control-label" for="lieunaissancef">
							<span class="text-nowrap"><strong>Lieu de naiss :</strong></span>
						</label>
						<div class="col-sm-9">
						<input type="text" id="lieunaissancef" name="lieunaissancef" placeholder="Lieu de naissance..." class="col-xs-12 col-sm-12" autocomplete= "off" />
						</div>
						<br>
						</div>
						<br>
					</div>
				</div>	{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
					<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label " for="gradef">
							<strong>Grade :</strong>
						</label>
						<div class="col-sm-9">
							<select id="gradef" name="gradef" class="col-xs-12 col-sm-12"/>
								<option value="">Sélectionner...</option>
								<option value="Agent de police AP">Agent de police AP</option>
								<option value="Brigadier de police BP">Brigadier de police BP</option>
								<option value="Brigadier-Chef">Brigadier-Chef</option>
								<option value="Inspecteur de Police">Inspecteur de Police</option>
								<option value="Inspecteur Principal de Police">Inspecteur Principal de Police</option>
								<option value="Lieutenant de police">Lieutenant de police</option>
								<option value="Commissaire de Police">Commissaire de Police</option>
								<option value="Commissaire Principal de Police">Commissaire Principal de Police</option>
								<option value="Commissaire Divisionnaire de Police">Commissaire Divisionnaire de Police</option>
								<option value="Contrôleur de Police">Contrôleur de Police</option>
								<option value="Contrôleur Général de Police">Contrôleur Général de Police</option>
							</select>
						</div>
					</div>
					</div>
					{{-- debut nmgsn	 --}}
					<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="NMGSN">
							<strong>NMGSN :</strong>
						</label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12" placeholder="numéro mutuel" />
							</div>
						</div>
					</div>
					<br>
					</div>
					{{-- fin nmgdn --}}
				</div>	{{-- row --}}
				<div class="row">
					<div class="col-sm-6" id="statut">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="etatf">
						<strong>Etat :</strong>
						</label>
						<div class="col-sm-9">
						<div class="radio">
						<label>
							<input name="etatf" value="En exercice" type="radio" class="ace" checked/>
							<span class="lbl"> En exercice</span>
						</label>
						<label>
							<input name="etatf" value="Retraité" type="radio" class="ace" />
							<span class="lbl"> Retraité</span>
						</label>
						<label>
							<input name="etatf" value="Invalide" type="radio" class="ace" />
							<span class="lbl"> Invalide</span>
						</label>
						<label>
							<input name="etatf" value="Mise en disponibilité" type="radio" class="ace" />
							<span class="lbl"> Mise en disponibilité</span>
						</label>
						</div>
						</div>
					</div>
					</div>	
					<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="nss2">
							<strong>NSS :</strong>
						</label>
						<div class="col-sm-9">
						<div class="clearfix">
						<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12" placeholder="XXXXXXXXXXXX" maxlength =12 minlength =12/>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
						</div>
						</div>
					</div>
						<br><br>
					</div>
				</div>	{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="matf">
							<strong>Matricule :</strong>
						</label>
						<div class="col-sm-9">
						<div class="clearfix">
							<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6" placeholder="Matricule..." />
						</div>
						</div>
					</div>
					</div>
					<div class="col-sm-6">
						<br><br>
					</div>
				</div>	{{-- row --}}
			</div>{{-- assurePart	 --}}
		</div>	{{-- tab-pane --}}
		{{-- homme C	 --}}
		<div id="Homme_C" class="tab-pane">
		   	<div id ="homme_cPart">
				<div class="row">
					<div class="col-sm-12">
						<h3 class="header smaller lighter blue">
							<b>Information de l'Homme de confiance</b>
						</h3>
					</div>	
				</div>{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="nomA">
							<b>Nom :</b> 
							</label>
						<div class="col-sm-9">
							<input type="text" id="nomA" name="nom_homme_c" placeholder="Nom..." class="col-xs-12 col-sm-12" />
						</div>
						<br>
						</div>
						<br>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="prenomA">
							<b>Prénom :</b>
						</label>
						<div class="col-sm-9">
							<input type="text" id="prenomA" name="prenom_homme_c" placeholder="Prénom..." class="col-xs-12 col-sm-12" />
						</div>
						<br>
						</div>
						<br>
					</div>
				</div>
				{{-- row --}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="datenaissanceA">
								<b class="text-nowrap">Né(e) le :</b>
							</label>
							<div class="col-sm-9">
							<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance_h_c" name="datenaissance_h_c" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." />
							</div>
						</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label " for="lien">
							<b>Lien de parenté :</b>
						</label>
						<div class="col-sm-9">
							<select id="lien" name="lien" class="col-xs-12 col-sm-12"/>
								<option value="">Sélectionner...</option>
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
					<div class="col-sm-6">
					<div class="form-group">
						<label class="col-sm-3 control-label " for="type_piece_id">
							<b>Type de la piece d'identité:</b>
						</label>
						<div class="col-sm-9">
							<select id="type_piece_id" name="type_piece_id" class="col-xs-12 col-sm-12"/>
								<option value="">Sélectionner...</option>
								<option value="CNI">Carte d'identité nationale</option>
								<option value="Permis">Permis de Conduire</option>
								<option value="Passeport">Passeport </option>
							</select>
						</div>
					</div>
					</div>
					
					<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="npiece_id">
							<b>N° de la pièce :</b>
						</label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" id="npiece_id" name="npiece_id" class="col-xs-12 col-sm-12" placeholder="N° de la pièce d'identité..." />
							</div>
						</div>
					</div>
					<br>
					</div>					
				</div>	
				<div class="row">
					<div class="col-sm-6">
					<div class="form-group">
						<label class="control-label col-xs-12 col-sm-3" for="date_piece_id">
							<b>Délivré le :</b>
						</label>
						<div class="col-sm-9">
							<input class="col-xs-12 col-sm-12 date-picker" id="date_piece_id" name="date_piece_id" type="text" data-date-format="yyyy-mm-dd" placeholder="Délivré le..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />
							
						</div>
					</div>
					</div>
					<div class="col-sm-6">
						<br><br>
					</div>
				</div>	{{-- row --}}
				<div class="space-12"></div>
				<div class="row">
				<div class="col-sm-12">
					<h3 class="header smaller lighter blue">
						<b>Contact</b>
					</h3>
				</div>
			</div>	{{-- row --}}
			<div class="space-12"></div>
			<div class="row">
				<div class="col-sm-5">
					<div class="form-group">
						<label class="control-label col-sm-3" for="adresseA"><b>Adresse :</b></label>
						<div class="col-sm-9">
						<textarea class="form-control" id="adresseA" name="adresseA" placeholder="Adresse..."></textarea>	
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<div class="form-group">
						<label class="control-label text-nowrap col-sm-2 for="mobileA"><i class="fa fa-phone"></i><b>Mob :</b></label>
						<div class="col-sm-2">
							<select name="operateur_h" id="operateur_h" class="form-control" >
							           <option value="">XX</option>
							         	<option value="05">05</option>         
							   	<option value="06">06</option>
							           <option value="07">07</option>
                       					</select>	
						</div>
						<input id="mobileA" name="mobile_homme_c"  maxlength =8 minlength =8  name="mobileA" type="tel" autocomplete="off" class="col-sm-2" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX"  />
						</div>
					</div>
				</div>
			</div>	{{-- row --}}	
			</div>{{-- homme_cPart	 --}}
		</div>	{{-- tab-pane --}}
		{{--fin homme--}}
		</div>{{-- tab_content --}}
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
	</form>
</div>{{-- row --}}
</div>{{-- container-fluid --}}
@endsection