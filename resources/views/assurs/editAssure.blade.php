<div id ="assurePart">
	 <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Informations démographiques</h3></div></div>
	<div class="row  Asdemograph">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="nomf"><strong>Nom :</strong></label>
				<div class="col-sm-9">
					<input type="text" id="nomf" name="nomf"  value="{{ $assure->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="prenomf"><strong>Prénom :</strong></label>
				<div class="col-sm-9">
					<input type="text" id="prenomf" name="prenomf"  value="{{ $assure->Prenom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
				</div>
			</div>
		</div>
  </div>
  <div class="row Asdemograph">
		<div class="col-sm-6 " >
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="datenaissancef"><strong class="text-nowrap">Né(e) le :</strong></label>
				<div class="col-sm-9">
					<input class="autoCommune col-xs-12 col-sm-12 date-picker ltnow" id="datenaissancef" name="datenaissancef" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{ $assure->Date_Naissance }}"/>		
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="lieunaissancef"><span class="text-nowrap"><strong>Né(e) à:</strong></span></label>
				<div class="col-sm-9">
					<div class="col-sm-12">
					@if(isset($assure) && isset($assure->lieunaissance))
						<input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="{{  $assure->lieunaissance  }} ">
						<input type="text" id="lieunaissancef" name="" class="autoCommune col-xs-12 col-sm-12" value="{{ $assure->lieuNaissance->nom_commune }}" autocomplete= "off" />
					@else	
						<input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="">
						<input type="text" id="lieunaissancef" name="" class="autoCommune col-xs-12 col-sm-12" value="" autocomplete= "off" />
					@endif
				</div>
					</div>
				</div>
		</div>
	</div>
	<div class="row Asdemograph">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label no-padding-right" for="sexe"><Strong>Genre: </Strong></label>
  				<div class="col-sm-9">
	  				<select name="sexef" id="sexef" class="form-control" >
	  					<option value="M" @if($assure->Sexe == "M") selected @endif>Masculin</option>
	  					<option value="F"  @if($assure->Sexe == "F")  selected @endif>Féminin</option>
	  				</select>
  				</div>
  			</div>
       	</div>
   		<div class="col-sm-6">
     		 <div class="form-group">
	   		<label class="col-sm-3 col-xs-3 control-label text-nowrap" for="gsf"><strong>Groupe sanguin :</strong></label>
			<div class="col-sm-2">
			  <select class="form-control groupeSanguin" id="gsf" name="gsf">
					<option value=""  {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
					<option value="A"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "A" )? "selected" : ""  }}>A</option>
					<option value="B"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "B" )? "selected" : ""  }}>B</option>
					<option value="O"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "O" )? "selected" : ""  }}>O</option>
					<option value="AB"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "AB" )? "selected" : ""  }}>AB</option>	
				</select>
			</div>
			<label class="col-sm-3 control-label no-padding-right" for="rhf"><strong>Rhésus :</strong></label>
			<div class="col-sm-2">
				<select id="rhf" name="rhf" class="groupeSanguin" >
					<option value=""  {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
					<option value="+" {{  (substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "+" )? "selected" : ""  }}>+</option>
					<option value="-" {{  (substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "-" )? "selected" : ""  }}>-</option>
				</select>
			</div>
	   	</div>
    		</div>
  	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="SituationFamille"><strong class="text-nowrap">Civilité :</strong></label>
				<div class="col-sm-9">
					<select class="form-control civilite" id="SituationFamille" name="SituationFamille">
						<option value="" @empty($assure->SituationFamille) selected @endempty>Sélectionner...</option>
						<option value="C" @if(isset($assure->SituationFamille) && ($assure->SituationFamille =='C')) selected @endif >Célibataire(e)</option>
						<option value="M" @if(isset($assure->SituationFamille) && ($assure->SituationFamille =='M')) selected @endif>Marié(e)</option>
						<option value="D" @if(isset($assure->SituationFamille) && ($assure->SituationFamille =="D")) selected @endif>Divorcé(e)</option>
						<option value="V" @if(isset($assure->SituationFamille) && ($assure->SituationFamille =="V")) selected @endif >Veuf(ve)</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Contact</h3></div></div>
	<div class="row Asdemograph">
		<div class="col-sm-4">
			<div class="form-group">
			 	<label class="col-sm-4 col-xs-4" for="adressef"><Strong>Adresse: </Strong></label>
	  		<div class="col-sm-8">
	  			<input id="adressef" type="text" name="adressef" value="{{ $assure->adresse }}">
	  		</div>
	  	</div>
	  </div>
	 	<div class="col-sm-4">
	  	<label class="col-sm-4 col-xs-4 text-nowrap" for="communef"><strong>Commune:</strong></label>
	  	@if(isset($assure->commune_res))
	  	<input type="hidden" name="idcommunef" id="idcommunef" value="{{  $assure->commune_res  }}">
			<input type="text" id="communef" name="" class="autoCommune col-xs-8 col-sm-8" value="{{ $assure->commune->nom_commune }}"/>
	  	@else	
			<input type="hidden" name="idcommunef" id="idcommunef">
	 		<input type="text" value="" id="communef" placeholder="commune résidance" class="autoCommune col-xs-8 col-sm-8"/>
	 		@endif
	  </div>
	  <div class="col-sm-4">
	  	<label class="col-sm-4 col-xs-4" for="wilayaf"><strong>Wilaya:</strong></label>
	  	@if(isset($assure->wilaya_res))
	  	<input type="hidden" name="idwilayaf" id="idwilayaf" value="{{  $assure->wilaya_res  }}">
		  <input type="text" value="{{ $assure->wilaya->nom }}" id="wilayaf" class="col-sm-8 col-xs-8" readonly />	
	  	@else	
	  	<input type="hidden" name="idwilayaf" id="idwilayaf">
		  <input type="text" value="" id="wilayaf" placeholder="wilaya résidance" class="col-sm-8 col-xs-8" readonly />
		  @endif
	  </div>
  </div>
	<div class="row">
		<div class="col-sm-12"><h3 class="header smaller lighter blue">Fonction</h3>	</div>
	</div>	
  <div class="row">
    <div class="col-sm-6" id="statut">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="Position"><strong>Position :</strong></label>
				<div class="col-sm-9">
					 <select name="Position" id="Position" class="col-xs-12 col-sm-12">
						<option value="">Sélectionner...</option>
						<option value="Activité" {{ ($assure->Position=="Activité") ? "selected" : "" }}>Activité</option>
						<option value="Détachement" {{ ($assure->Position=="Détachement") ? "selected" : "" }}>Détachement</option>
						<option value="Mise en Disponibilité" {{ ($assure->Position=="Mise en Disponibilité") ? "selected" : "" }}>Mise en Disponibilité</option>
						<option value="Licencié" {{ ($assure->Position=="Licencié") ? "selected" : "" }}>Licencié</option>
						<option value="Démission" {{ ($assure->Position=="Démission") ? "selected" : "" }}>Démission</option>
						<option value="Retraite" {{ ($assure->Position=="Retraite") ? "selected" : "" }}>Retraite</option>
						<option value="Congé Longue Durée" {{ ($assure->Position=="Congé Longue Durée") ? "selected" : "" }}>Congé Longue Durée</option>
						<option value="Assurance Invaliditéé" {{ ($assure->Position=="Assurance Invaliditéé") ? "selected" : "" }}>Assurance Invaliditéé</option>
						<option value="Décédé" {{ ($assure->Position=="Décédé") ? "selected" : "" }}>Décédé</option>
						<option value="Service National" {{ ($assure->Position=="Service National") ? "selected" : "" }}>Service National</option>
						<option value="Contrat résilié" {{ ($assure->Position=="Contrat résilié") ? "selected" : "" }}>Contrat résilié</option>
						<option value="Congé Maladie" {{ ($assure->Position=="Congé Maladie") ? "selected" : "" }}>Congé Maladie</option>
						<option value="Révoqué" {{ ($assure->Position=="Révoqué") ? "selected" : "" }}>Révoqué</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-sm-6" id = "serviceFonc">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="service"><strong>Service :</strong></label>
				<div class="col-sm-9">
					<input type="text" name="service" id="service" class="col-xs-12 col-sm-12" value=" {{ $assure->Service}} ">	
				</div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label " for="grade"><strong>Grade :</strong></label>
				<div class="col-sm-9">
					<select id="grade" name="grade" class=" col-xs-12 col-sm-6"/>
					<option value="">Sélectionner...</option>
						@foreach ($grades as $key=>$grade)
						<option value="{{ $grade->id }}" {{ $assure->Grade === $grade->id   ? "selected":"" }} >{{ $grade->nom }}</option>
						@endforeach
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
					<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6" value="{{ $assure->matricule }}" maxlength="5" />	
				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="NMGSN"><strong>NMGSN :</strong>	</label>
				<div class="col-sm-9">
					<div class="clearfix">
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12" value="{{ $assure->NMGSN }}" maxlength =12 minlength =12/>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="nss"><strong>NSS :</strong></label>
				<div class="col-sm-9">
				<div class="clearfix">
				<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12"  value="{{ $assure->NSS }}" maxlength =12 minlength =12/>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
				</div>
				</div>
			</div>
		</div>	
	</div>
</div>

