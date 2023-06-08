<h4 class="header lighter block blue">Sécurité sociale</h4> 
<div class="row">
  <div class="form-group col-sm-4">
    <label class="control-label col-sm-3 required" for="nss">NSS</label>
    <div class="col-sm-9">{{-- nssform --}}
<input type="text" id="nss" name="nss" class="form-control" value=" {{($patient->type_id ==6) ? '' : $assure->NSS}}" maxlength =12 minlength =12 autocomplete = "off" /> 
    </div>
    </div>
</div>
<div id="asdemogData">
  <h4 class="header lighter block blue">Informations administratives</h4>
  <div class="row">
  	<div class="form-group col-sm-6">
  		<label class="col-sm-3 col-xs-3 control-label required" for="nomf">Nom</label>
  		<div class="col-sm-9">
        <input type="text" id="nomf" name="nomf"  value="{{($patient->type_id ===1)? '': $assure->Nom}}" class="asdemogData form-control"/>
  		</div>
  	</div>
  	<div class="form-group col-sm-6">
  		<label class="col-sm-3 control-label required" for="prenomf">Prénom</label>
  		<div class="col-sm-9">
  			<input type="text" id="prenomf" name="prenomf" class="form-control asdemogData" value="{{($patient->type_id ===1)? '': $assure->Prenom}}"/>
  		</div>
  	</div>
  </div>
  <div class="row">
    <div class="form-group col-sm-6">
  		<label class="col-sm-3 col-xs-3 control-label text-nowrap" for="datenaissancef">Né(e) le</label>
  		<div class="col-sm-9">
<input class="autoCommune form-control date-picker ltnow asdemogData" id="datenaissancef" name="datenaissancef" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{($patient->type_id ===1)? '': $assure->Date_Naissance}}"/>
  		</div>
  	</div>
  	<div class="form-group col-sm-6">
  		<label class="col-sm-3 col-xs-3 control-label text-nowrap" for="lieunaissancef">Né(e) à</label>
  		<div class="col-sm-9">
  		  <input type="hidden" name="idlieunaissancef" id="idlieunaissancef" value="">
        <input type="text" id="lieunaissancef" class="autoCommune form-control asdemogData" value="{{($patient->type_id ===1)? '': $assure->lieuNaissance->nom_commune}}"/>
  		</div>
  	</div>	
  </div>
  <div class="row">
  	<div class="form-group col-sm-6">
  		<label class="col-sm-3 col-xs-3 control-label no-padding-right" for="sexe">Genre</label>
  		<div class="col-sm-9">
      <select name="sexef" id="sexef" class="form-control asdemogData">
        <option value="M" {{(($patient->type_id !=1)&&($assure->Sexe == "M"))?'selected':''}}>Masculin</option>
      <option value="F" {{(($patient->type_id !=1)&&($assure->Sexe == "F"))?'selected':''}}>Féminin</option>
    		</select>
  		</div>
    	</div>
     <div class="form-group col-sm-6">
  	   		<label class="col-sm-3 col-xs-3 control-label text-nowrap required" for="gsf">Groupe sanguin</label>
  			<div class="col-sm-2">
  			  <select class="form-control groupeSanguin asdemogData" id="gsf" name="gsf">
  				  <option value=""{{(($patient->type_id !=1)&&($assure->grp_sang==""))?'selected':''}}>---</option>
            <option value="A" {{(($patient->type_id !=1)&&(substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "A"))?'selected':''}}>A</option>
            <option value="B" {{(($patient->type_id !=1)&&(substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "B"))?'selected':''}}>B</option>
            <option value="O" {{(($patient->type_id !=1)&&(substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "O"))?'selected':''}}>O</option>
            <option value="AB" {{(($patient->type_id !=1)&&(substr($assure->grp_sang,0,strlen($assure->grp_sang)-1) == "AB"))?'selected':''}}>AB</option> 
  				</select>
  			</div>
  			<label class="col-sm-3 control-label no-padding-right required" for="rhf">Rhésus</label>
  			<div class="col-sm-2">
  				<select id="rhf" name="rhf" class="groupeSanguin asdemogData">
  			    <option value="" {{(($patient->type_id !=1)&&($assure->grp_sang==""))?'selected':''}}>---</option>
            <option value="+" {{(($patient->type_id !=1)&&(substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "+"))?'selected':''}}>+</option>
            <option value="-" {{(($patient->type_id !=1)&&(substr($assure->grp_sang,strlen($assure->grp_sang)-1,strlen($assure->grp_sang)) == "-" ))?'selected':''}}>-</option>
  				</select>
  			</div>
  	   	</div>
  </div>
  <div class="row">
		<div class="form-group col-sm-6">
			<label class="col-sm-3 control-label text-nowrap" for="SituationFamille">Civilité</label>
			<div class="col-sm-9">
				<select class="form-control civilite asdemogData" id="SituationFamille" name="SituationFamille">
					<option value="" @empty($assure->sf) selected @endempty>Sélectionner...</option>
					<option value="C" @if(isset($assure->sf) && ($assure->sf =='C')) selected @endif >Célibataire(e)</option>
					<option value="M" @if(isset($assure->sf) && ($assure->sf =='M')) selected @endif>Marié(e)</option>
					<option value="D" @if(isset($assure->sf) && ($assure->sf =="D")) selected @endif>Divorcé(e)</option>
					<option value="V" @if(isset($assure->sf) && ($assure->sf =="V")) selected @endif >Veuf(ve)</option>
				</select>
			</div>
		</div>
	</div><h4 class="header lighter block blue">Contact</h4>
  <div class="row">
		<div class="form-group col-sm-4">
		 	<label class="control-label col-sm-3 col-xs-3" for="adressef">Adresse</label>
  		<div class="col-sm-9">
  		  <input type="text" class="asdemogData form-control" id="adressef" name="adressef"
         value="{{($patient->type_id ===1)? '': $assure->adresse}}">
  		</div>
	 	</div>
	  <div class="form-group col-sm-4">
	  	<label class="col-sm-3 text-nowrap" for="communef">Commune</label>
      <input type="hidden" name="idcommunef" id="idcommunef">
      <input type="text" id="communef" placeholder="commune résidance" class="autoCommune col-xs-9 col-sm-9 asdemogData" value="{{($patient->type_id ===1)? '': $assure->commune->nom_commune}}"/>
	  </div>
	  <div class="form-group col-sm-4">
	  	<label class="col-sm-3" for="wilayaf">Wilaya</label>
	  	 <input type="hidden" name="idwilayaf" id="idwilayaf" value="{{($patient->type_id ===1)? '':$assure->wilaya_res}}">
<input type="text" value="" id="wilayaf" placeholder="wilaya résidance..." class="asdemogData col-sm-9 col-xs-9" value="{{($patient->type_id ===1)? '':$assure->wilaya->nom}}" readonly />
	  </div>
  </div>
</div>