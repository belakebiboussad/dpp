<div id ="assurePart">
	 <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Informations démographiques</h3></div></div>
	<div class="row  Asdemograph">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="nomf"><strong>Nom :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input type="text" id="nomf" name="nomf"  value="{{ $assure->Nom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@else
						<input type="text" id="nomf" name="nomf"  value="" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@endif	
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="prenomf"><strong>Prénom :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input type="text" id="prenomf" name="prenomf"  value="{{ $assure->Prenom }}" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@else
							<input type="text" id="prenomf" name="prenomf"  value="" class="col-xs-12 col-sm-12" autocomplete= "off" required alpha/>
					@endif
				</div>
			</div>
		</div>
  </div>
  <div class="row Asdemograph">
		<div class="col-sm-6 " >
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="datenaissancef"><strong class="text-nowrap">Né(e) le :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
						<input class="autoCommune col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{ $assure->Date_Naissance }}"/>
					@else	
						<input class="autoCommune col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value=""/>
					@endif
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 col-xs-3 control-label" for="lieunaissancef"><span class="text-nowrap"><strong>Né(e) à:</strong></span></label>
				<div class="col-sm-9">
					<div class="col-sm-9">
					{{-- @if(isset($assure) && (isset($assure->lieuNaissance))) --}}
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
  				 @if(isset($assure) && !empty($assure))
	  				<select name="sexef" id="sexef" class="form-control" >
	  					<option value="M" @if($assure->Sexe == "M") @endif>Masculin</option>
	  					<option value="F"  @if($assure->Sexe == "F") @endif>Féminin</option>
	  				</select>
	  			@else
	  					<select name="sexef" id="sexef" class="form-control" >
	  					<option value="M" >Masculin</option>
	  					<option value="F"  selected>Féminin</option>
	  				</select>
	  			@endif
  				</div>
  			</div>
       	</div>
   		<div class="col-sm-6">
     		 <div class="form-group">
	   		<label class="col-sm-3 col-xs-3 control-label text-nowrap" for="gsf"><strong>Groupe sanguin :</strong></label>
			<div class="col-sm-2">
				@if(isset($assure) && !empty($assure))
					<select class="form-control" id="gsf" name="gsf">
						<option value=""  {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
						<option value="A"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "A" )? "selected" : ""  }}>A</option>
						<option value="B"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "B" )? "selected" : ""  }}>B</option>
						<option value="O"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "O" )? "selected" : ""  }}>O</option>
						<option value="AB"  {{  (substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "AB" )? "selected" : ""  }}>AB</option>	
					</select>
				@else 
					<select class="form-control" id="gsf" name="gsf">
						<option value="">------</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="O">O</option>
						<option value="AB">AB</option>
					</select>
				@endif
			</div>
			<label class="col-sm-3 control-label no-padding-right" for="rhf"><strong>Rhésus:</strong></label>
			<div class="col-sm-2">
			@if(isset($assure) && !empty($assure))
				<select id="rhf" name="rhf">
					<option value=""  {{ ($assure->grp_sang=="")? "selected" : "" }} >------</option>
					<option value="+" {{  (substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "+" )? "selected" : ""  }}>+</option>
					<option value="-" {{  (substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "-" )? "selected" : ""  }}>-</option>
				</select>
			@else
				<select id="rhf" name="rhf">
					<option value="">------</option>
					<option value="+"  >+</option>
					<option value="-">-</option>
				</select> 
			@endif
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
						<option value="célibataire" @if( $assure->SituationFamille =='célibataire') selected @endif >Célibataire(e)</option>
						<option value="marié" @if( $assure->SituationFamille =='marié') selected @endif>Marié(e)</option>
						<option value="divorcé" @if( $assure->SituationFamille =="divorcé") selected @endif>Divorcé(e)</option>
						<option value="veuf" @if( $assure->SituationFamille =="veuf") selected @endif >Veuf(ve)</option>
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
	  			@if(isset($assure) && !empty($assure))
	  				<input type="text" id="adressef" name="adressef"  class="col-xs-12 col-sm-12" value= "{{ $assure->adresse }}" />
	  			  @else 
	  			  <input type="text" id="adressef" name="adressef"  placeholder="Adresse..."  class="col-xs-12 col-sm-12" />  
	  			  @endif
	  			</div>
	  	</div>
	  </div>
	  <div class="col-sm-4">
	  	<label class="col-sm-4 col-xs-4 text-nowrap" for="communef"><strong>Commune:</strong></label>
	  	@if(isset($assure->commune) && !empty($assure->commune))
	  	<input type="hidden" name="idcommunef" id="idcommunef" value="{{  $assure->commune_res  }}">
			<input type="text" id="communef" name="" class="autoCommune col-xs-8 col-sm-8" value="{{ $assure->commune->nom_commune }}"/>
	  	@else	
			<input type="hidden" name="idcommunef" id="idcommunef">
	 		<input type="text" value="" id="communef" placeholder="commune résidance" class="autoCommune col-xs-8 col-sm-8"/>
	 		@endif
	  </div>
	  <div class="col-sm-4">
	  	<label class="col-sm-4 col-xs-4" for="wilayaf"><strong>Wilaya:</strong></label>
	  	@if(isset($assure->wilaya) && !empty($assure->wilaya))
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
					 @if(isset($assure) && !empty($assure))
					 <select name="Position" id="Position" class="col-xs-12 col-sm-12">
						<option value="">Sélectionner...</option>
						<option value="Activité" {{ ($assure->Position=="Activité") ? "selected" : "" }}>Activité</option>
						<option value="Retraité" {{ ($assure->Position=="Retraité") ? "selected" : "" }}>Retraite</option>
						<option value="Congé Maladie" {{ ($assure->Position=="Congé Maladie") ? "selected" : "" }}>Congé Maladie</option>
						<option value="Révoqué" {{ ($assure->Position=="Révoqué") ? "selected" : "" }}>Révoqué</option>
					</select>
					@else	
					<select name="Position" id="Position" class="col-xs-12 col-sm-12">
						<option value="">Sélectionner...</option>
						<option value="Activité">Activité</option>
						<option value="Retraité" selected>Retraite</option>
						<option value="Congé Maladie" >Congé Maladie</option>
						<option value="Révoqué" >Révoqué</option>
					</select>
					 @endif
				</div>
			</div>
		</div>
		<div class="col-sm-6" id = "serviceFonc">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="service"><strong>Service :</strong></label>
				<div class="col-sm-9">
					@if(isset($assure) && !empty($assure))
					<input type="text" name="service" id="service" class="col-xs-12 col-sm-12" value=" {{ $assure->Service}} ">
					@else
					<input type="text" name="service" id="service" class="col-xs-12 col-sm-12" placeholder="Service du Fonctionnaire">
					@endif 
				</div>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="col-sm-3 control-label " for="grade"><strong>Grade :</strong></label>
				<div class="col-sm-9">
				@if(isset($assure) && !empty($assure))
					<select id="grade" name="grade" class=" col-xs-12 col-sm-6"/>
					<option value="">Sélectionner...</option>
					{{-- @if ( isset($assure->Grade)) --}}
						@foreach ($grades as $key=>$grade)
						<option value="{{ $grade->id }}" {{ $assure->Grade === $grade->id   ? "selected":"" }} >{{ $grade->nom }}</option>
						@endforeach
					{{-- @endif --}}
					</select>
				@else
					<select id="grade" name="grade" class="col-xs-12 col-sm-6"/>
					@foreach ($grades as $key=>$grade)
						<option value="{{ $grade->id }}" >{{ $grade->nom }}</option>
					@endforeach
					</select>
				@endif	
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
				@if(isset($assure) && !empty($assure))
					<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6" value="{{ $assure->matricule }}" maxlength="5" />
				@else
					<input type="text" id="matf" name="matf" class="col-xs-12 col-sm-6"  placeholder="saisir le matricule..." maxlength="5" />
				@endif	
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
					@if(isset($assure) && !empty($assure))
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12" value="{{ $assure->NMGSN }}" maxlength =12 minlength =12/>
					@else
						<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12"  placeholder="saisir le numéro mutuelle..." maxlength =12 minlength =12/>
					@endif	
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3" for="nss"><strong>NSS :</strong></label>
				<div class="col-sm-9">
				<div class="clearfix">
				@if(isset($assure) && !empty($assure))
				<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12"  value="{{ $assure->NSS }}" maxlength =12 minlength =12/>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2}$" --}}
				@else
				<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12" placeholder="XXXXXXXXXXXX"  maxlength =12 minlength =12/>
				@endif	
				</div>
				</div>
			</div>
		</div>	
	</div>
</div>

