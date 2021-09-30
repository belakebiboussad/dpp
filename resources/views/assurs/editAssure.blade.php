<div class="row"><div class="col-sm-12"><h5 class="header smaller lighter blue"><strong>Informations démographiques</strong></h5></div></div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="nomf"><strong>Nom :<span style="color: red">*</span></strong></label>
				<div class="col-sm-9">
					@if(isset($assure))
						<input type="text" id="nomf" name="nomf"  value="{{ $assure->Nom }}" class="asdemogData col-xs-12 col-sm-12" alpha/>
					@else
						<input type="text" id="nomf" name="nomf"  value="" class="asdemogData col-xs-12 col-sm-12" autocomplete= "off" alpha/>
					@endif	
				</div>
			</div>
	</div>
	<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="prenomf"><strong>Prénom :<span style="color: red">*</span></strong></label>
				<div class="col-sm-9">
					@if(isset($assure))
					<input type="text" id="prenomf" name="prenomf"  value="{{ $assure->Prenom }}" class="col-xs-12 col-sm-12 asdemogData" alpha/>
					@else
					<input type="text" id="prenomf" name="prenomf" class="col-xs-12 col-sm-12 asdemogData" autocomplete= "off" alpha/>
					@endif
				</div>
			</div>
	</div>
</div><div class="space-12"></div>
<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="datenaissancef"><strong class="text-nowrap">Né(e) le :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure))
					<input class="autoCommune col-xs-12 col-sm-12 date-picker ltnow asdemogData" id="datenaissancef" name="datenaissancef" type="text" data-date-format="yyyy-mm-dd" value="{{ $assure->Date_Naissance }}"/>		
					@else
					<input class="autoCommune col-xs-12 col-sm-12 date-picker ltnow asdemogData" id="datenaissancef" name="datenaissancef" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd"/>
					@endif
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="lieunaissancef"><span class="text-nowrap"><strong>Né(e) à:</strong></span></label>
				<div class="col-sm-9">
					@if(isset($assure) && isset($assure->lieunaissance))
						<input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="{{  $assure->lieunaissance  }} ">
						<input type="text" id="lieunaissancef" class="autoCommune form-control col-xs-12 col-sm-12 asdemogData" value="{{ $assure->lieuNaissance->nom_commune }}"/>
					@else	
						<input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="">
						<input type="text" id="lieunaissancef" class="autoCommune col-xs-12 col-sm-12 asdemogData" value=""/>
					@endif
				</div>
				</div>
		</div>
	</div><div class="space-12"></div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label no-padding-right" for="sexe"><Strong>Genre: </Strong></label>
  				<div class="col-sm-9">
	  				<select name="sexef" id="sexef" class="form-control asdemogData">
	  					@if(isset($assure))
	  					<option value="M" @if($assure->Sexe == "M" ) selected @endif>Masculin</option>
	  					<option value="F"  @if($assure->Sexe == "F")  selected @endif>Féminin</option>
	  					@else
	  					<option value="M" selected>Masculin</option>
	  					<option value="F">Féminin</option>
	  					@endif
	  				</select>
  				</div>
  			</div>
       	</div>
   		<div class="col-sm-6">
     		 <div class="form-group">
	   		<label class="col-sm-3 col-xs-3 control-label text-nowrap" for="gsf"><strong>Groupe sanguin :<span style="color: red">*</span></strong></label>
			<div class="col-sm-2">
			  <select class="form-control groupeSanguin asdemogData" id="gsf" name="gsf">
					@if(isset($assure))
					<option value=""  {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
					<option value="A"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "A" )? "selected" : ""  }}>A</option>
					<option value="B"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "B" )? "selected" : ""  }}>B</option>
					<option value="O"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "O" )? "selected" : ""  }}>O</option>
					<option value="AB"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "AB" )? "selected" : ""  }}>AB</option>	
					@else
						<option value="">------</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="O">O</option>
						<option value="AB" >AB</option>	
					@endif
				</select>
			</div>
			<label class="col-sm-3 control-label no-padding-right" for="rhf"><strong>Rhésus :<span style="color: red">*</span></strong></label>
			<div class="col-sm-2">
				<select id="rhf" name="rhf" class="groupeSanguin asdemogData">
					@if(isset($assure))
					<option value=""  {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
					<option value="+" {{  (substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "+" )? "selected" : ""  }}>+</option>
					<option value="-" {{  (substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "-" )? "selected" : ""  }}>-</option>
					@else
					<option value="">------</option>
					<option value="+">+</option>
					<option value="-">-</option>
					@endif
				</select>
			</div>
	   	</div>
    		</div>
  </div><div class="space-12"></div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="SituationFamille"><strong class="text-nowrap">Civilité :</strong></label>
				<div class="col-sm-9">
					<select class="form-control civilite asdemogData" id="SituationFamille" name="SituationFamille">
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
	<div class="row"><div class="col-sm-12"><h5 class="header smaller lighter blue"><strong>Contact</strong></h5></div></div>
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
			 	<label class="control-label col-sm-3 col-xs-3" for="adressef"><Strong>Adresse: </Strong></label>
	  		<div class="col-sm-9">
	  			@if(isset($assure))
	  			<input  type="text" class="asdemogData col-xs-12 col-sm-12" id="adressef" name="adressef" value="{{ $assure->adresse }}">
	  			@else
	  			<input type="text" class="asdemogData col-xs-12 col-sm-12" id="adressef" name="adressef">
	  			@endif
	  		</div>
	  	</div>
	  </div>
	 	<div class="col-sm-4">
	  	<label class="col-sm-3 col-xs-3 text-nowrap" for="communef"><strong>Commune:</strong></label>
	  	@if(isset($assure->commune_res))
	  	<input type="hidden" name="idcommunef" id="idcommunef" value="{{  $assure->commune_res  }}">
			<input type="text" id="communef" class="autoCommune asdemogData col-xs-9 col-sm-9" value="{{ $assure->commune->nom_commune }}"/>
	  	@else	
			<input type="hidden" name="idcommunef" id="idcommunef">
	 		<input type="text" id="communef" placeholder="commune résidance" class="autoCommune col-xs-9 col-sm-9 asdemogData"/>
	 		@endif
	  </div>
	  <div class="col-sm-4">
	  	<label class="col-sm-3 col-xs-3" for="wilayaf"><strong>Wilaya:</strong></label>
	  	@if(isset($assure->wilaya_res))
	  	<input type="hidden" name="idwilayaf" id="idwilayaf" value="{{  $assure->wilaya_res  }}">
		  <input type="text" value="{{ $assure->wilaya->nom }}" id="wilayaf" class="asdemogData col-sm-9 col-xs-9" readonly />	
	  	@else	
	  	<input type="hidden" name="idwilayaf" id="idwilayaf">
		  <input type="text" value="" id="wilayaf" placeholder="wilaya résidance..." class="asdemogData col-sm-9 col-xs-9" readonly />
		  @endif
	  </div>
  </div>
	<div class="row">
		<div class="col-sm-12"><h5 class="header smaller lighter blue"><strong>Fonction</strong></h5>	</div>
	</div>	
	 <div class="row">
	 	<div class="col-sm-4">
			<div class="form-group">
				<label class="col-sm-3 control-label " for="grade"><strong>Grade :</strong></label>
				<div class="col-sm-9">
					<select id="grade" name="grade" class=" col-xs-12 col-sm-12 asProfData"/>
					<option value="">Sélectionner...</option>
						@foreach ($grades as $key=>$grade)
						<option value="{{ $grade->id }}" {{((isset($assure)) && ($assure->Grade === $grade->id)) ? "selected":"" }} >{{ $grade->nom }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
    <div class="col-sm-4" id="statut">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="Position"><strong>Position :<span style="color: red">*</span></strong></label>
					<div class="col-sm-9">
					 <select name="Position" id="Position" class="col-xs-12 col-sm-12 asProfData">
						<option value="">Sélectionner...</option>
						<option value="Activité" {{ (isset($assure)) && ($assure->Position=="Activité") ? "selected" : "" }}>Activité</option>
						<option value="Détachement" {{ (isset($assure)) && ($assure->Position=="Détachement") ? "selected" : "" }}>Détachement</option>
						<option value="Mise en Disponibilité" {{ (isset($assure)) &&($assure->Position=="Mise en Disponibilité") ? "selected" : "" }}>Mise en Disponibilité</option>
						<option value="Licencié" {{ (isset($assure)) && ($assure->Position=="Licencié") ? "selected" : "" }}>Licencié</option>
						<option value="Démission" {{ (isset($assure)) && ($assure->Position=="Démission") ? "selected" : "" }}>Démission</option>
						<option value="Retraite" {{(isset($assure)) && ($assure->Position=="Retraite") ? "selected" : "" }}>Retraite</option>
						<option value="Congé Longue Durée" {{(isset($assure)) && ($assure->Position=="Congé Longue Durée") ? "selected" : "" }}>Congé Longue Durée</option>
						<option value="Assurance Invaliditéé" {{(isset($assure)) && ($assure->Position=="Assurance Invaliditéé") ? "selected" : "" }}>Assurance Invaliditéé</option>
						<option value="Décédé" {{ (isset($assure)) && ($assure->Position=="Décédé") ? "selected" : "" }}>Décédé</option>
						<option value="Service National" {{(isset($assure)) && ($assure->Position=="Service National") ? "selected" : "" }}>Service National</option>
						<option value="Contrat résilié" {{ (isset($assure)) &&($assure->Position=="Contrat résilié") ? "selected" : "" }}>Contrat résilié</option>
						<option value="Congé Maladie" {{ (isset($assure)) &&($assure->Position=="Congé Maladie") ? "selected" : "" }}>Congé Maladie</option>
						<option value="Révoqué" {{ (isset($assure)) && ($assure->Position=="Révoqué") ? "selected" : "" }}>Révoqué</option>	
					</select>
				</div>
			</div>
		</div>
		<div class="col-sm-4" id ="serviceFonc">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="service"><strong>Service :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure))
					<input type="text" name="service" id="service" class="col-xs-12 col-sm-12 asProfData" value=" {{ $assure->Service}} ">	
					@else
					<input type="text" name="service" id="service" class="col-xs-12 col-sm-12 asProfData">		
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="matf">
					<strong>Matricule :</strong>
				</label>
				<div class="col-sm-9">
				<div class="clearfix">
						@if(isset($assure))
						<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-12 asProfData" value="{{ $assure->matricule }}" maxlength="5" />	
						@else
						<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-12 asProfData" maxlength="5" />	
						@endif
				</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="nss"><strong>NSS :<span style="color: red">*</span></strong></label>
				<div class="col-sm-9">
				<div class="clearfix">
					@if(!in_array($patient->Type,[5,6]))
					  <input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12 asProfData" value="{{ $assure->NSS }}" maxlength =12 minlength =12 autocomplete = "off" />
					@else
					  <input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12 asProfData" value="" maxlength =12 minlength =12 autocomplete = "off" />
					@endif
				 {{--  pattern="^\[0-9]{12}$"pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
				</div>
			</div>
		</div>
	</div>	
		<div class="col-sm-4">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="NMGSN"><strong>NMGSN :</strong>	</label>
				<div class="col-sm-9">
					<div class="clearfix">
					@if(isset($assure))
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12 asProfData" value="{{ $assure->NMGSN }}" maxlength =12 minlength =12/>
					@else
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12 asProfData" maxlength =12 minlength =12/>
					@endif
					</div>
				</div>
			</div>
		</div>
	</div>