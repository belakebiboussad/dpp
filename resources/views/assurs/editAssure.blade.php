<h4 class="header lighter block blue">Sécurité sociale</h4> 
<div class="row">
  <div class="form-group col-sm-4">
    <label class="control-label col-sm-3 required" for="nss">NSS</label>
    <div class="col-sm-9">
<input type="text" id="nss" name="nss" class="form-control nssform" value=" {{($patient->type_id ==6) ? '' : $assure->NSS}}" maxlength=12 minlength =12 autocomplete = "off" /> 
    </div>
    </div>
</div>
<div id="asdemogData">
  <h4 class="header lighter block blue">Informations administratives</h4>
  <div class="row">
  	<div class="form-group col-sm-6">
  		<label class="col-sm-3 col-xs-3 control-label required" for="nomf">Nom</label>
  		<div class="col-sm-9">
<input type="text" id="nomf" name="nomf"  value="{{(in_array($patient->type_id,[1,6]))? '': $assure->Nom}}" class="asdemogData form-control"/>
  		</div>
  	</div>
  	<div class="form-group col-sm-6">
  		<label class="col-sm-3 control-label required" for="prenomf">Prénom</label>
  		<div class="col-sm-9">
  			<input type="text" id="prenomf" name="prenomf" class="form-control asdemogData" value="{{(in_array($patient->type_id,[1,6]))? '': $assure->Prenom}}"/>
  		</div>
  	</div>
  </div>
  <div class="row">
    <div class="form-group col-sm-6">
  		<label class="col-sm-3 col-xs-3 control-label text-nowrap" for="dobf">Né(e) le</label>
  		<div class="col-sm-9">
        <input class="form-control date-picker ltnow asdemogData" id="dobf" name="dobf" type="text" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" value="{{(in_array($patient->type_id,[2,3,4,5])&&(!is_null($assure->dob)) )? $assure->dob->format('Y-m-d'):''}}"/>
  		</div>
  	</div>
  	<div class="form-group col-sm-6">
  		<label class="col-sm-3 col-xs-3 control-label text-nowrap">Né(e) à</label>
  		<div class="col-sm-9">
      <select name="pobf" id="pobf" class="form-control autoCommune">
      <option value="{{(in_array($patient->type_id,[1,6]))? '': $assure->pob }}" selected="selected">{{((in_array($patient->type_id,[2,3,4,5]))&&(!(is_null($assure->pob))))? $assure->POB->name:'' }}</option>     
      </select>
  		</div>
  	</div>	
  </div>
  <div class="row">
  	<div class="form-group col-sm-6">
  		<label class="col-sm-3 col-xs-3 control-label no-padding-right" for="sexef">Genre</label>
  		<div class="col-sm-9">
      <select name="sexef" id="sexef" class="form-control asdemogData">
        <option value="M" {{(!(in_array($patient->type_id,[1,6]))&&($assure->Sexe == "M"))?'selected':''}}>Masculin</option>
      <option value="F" {{((!(in_array($patient->type_id,[1,6])))&&($assure->Sexe == "F"))?'selected':''}}>Féminin</option>
    		</select>
  		</div>
    	</div>
     <div class="form-group col-sm-6">
  	   		<label class="col-sm-3 col-xs-3 control-label text-nowrap" for="gsf">Groupe sanguin</label>
  			<div class="col-sm-2">
  			  <select class="form-control groupeSanguin asdemogData" id="gsf" name="gsf">
  				  <option value=""{{((!(in_array($patient->type_id,[1,6])))&&($assure->gs==""))?'selected':''}}>---</option>
            <option value="A" {{((!(in_array($patient->type_id,[1,6])))&&(substr($assure->gs,0,strlen($assure->gs)-1) == "A"))?'selected':''}}>A</option>
            <option value="B" {{((!(in_array($patient->type_id,[1,6])))&&(substr($assure->gs,0,strlen($assure->gs)-1) == "B"))?'selected':''}}>B</option>
            <option value="O" {{((!(in_array($patient->type_id,[1,6])))&&(substr($assure->gs,0,strlen($assure->gs)-1) == "O"))?'selected':''}}>O</option>
            <option value="AB" {{((!(in_array($patient->type_id,[1,6])))&&(substr($assure->gs,0,strlen($assure->gs)-1) == "AB"))?'selected':''}}>AB</option> 
  				</select>
  			</div>
  			<label class="col-sm-3 control-label no-padding-right" for="rhf">Rhésus</label>
  			<div class="col-sm-2">
  				<select id="rhf" name="rhf" class="groupeSanguin asdemogData">
  			    <option value="" {{((!(in_array($patient->type_id,[1,6])))&&($assure->gs==""))?'selected':''}}>---</option>
            <option value="+" {{((!(in_array($patient->type_id,[1,6])))&&(substr($assure->gs,strlen($assure->gs)-1,strlen($assure->gs)) == "+"))?'selected':''}}>+</option>
            <option value="-" {{((!(in_array($patient->type_id,[1,6])))&&(substr($assure->gs,strlen($assure->gs)-1,strlen($assure->gs)) == "-" ))?'selected':''}}>-</option>
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
         value="{{(in_array($patient->type_id,[1,6]))? '': $assure->adresse}}">
  		</div>
	 	</div>

    <div class="form-group col-sm-4">
	  	<label class="col-sm-3 text-nowrap" for="communef">Commune</label>
      <div class="col-sm-9 col-xs-9">
      <select name="idcommunef" id="idcommunef" class="form-control autoCommune">
      <option value="{{(in_array($patient->type_id,[1,6]))? '': $assure->commune_res }}" selected="selected">{{((in_array($patient->type_id,[2,3,4,5]))&&(!(is_null($assure->commune_res))))? $assure->commune->name:'' }}</option>     
      </select>
    </div>
	  </div>
	  <div class="form-group col-sm-4">
	    <label class="col-sm-3" for="wilayaf">Wilaya</label>
      <div class="col-sm-9 col-xs-9">
      <input type="text" id="wilayaf" placeholder="wilaya résidance..." class="asdemogData form-control" value="{{((in_array($patient->type_id,[2,3,4,5])) &&(!is_null($assure->commune_res)))? $assure->commune->daira->wilaya->nom: ''}}" readonly />
    </div>
	  </div>
  </div>
</div>