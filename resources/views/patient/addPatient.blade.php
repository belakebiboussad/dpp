<div class="row"><div class="col-sm-12"><h4 class="header  lighter blue">Informations démographiques</h4></div></div>
<div class="row demograph">
	<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="nom">Nom :<span class="red">*</span></label>
		<div class="col-sm-9">
			<input type="text" id="nom" name="nom" placeholder="Nom..." class="col-xs-12 col-sm-12"  value="{{ old('nom') }}" alpha/>
				{!! $errors->first('nom', '<small class="alert-danger">:message</small>') !!}
		</div>
	</div>	
	<div class="form-group {{ $errors->has('prenom') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="prenom">Prénom :<span class="red">*</span></label>
		<div class="col-sm-9">
			<input type="text" id="prenom" name="prenom" placeholder="Prénom..." class="col-xs-12 col-sm-12" value="{{ old('prenom') }}" />
			{!! $errors->first('prenom', '<p class="alert-danger">:message</p>') !!}
		</div>
	</div>
</div><div class="spce-12"></div>
<div class="row demograph">
	<div class="form-group {{ $errors->has('datenaissance') ? 'has-error' : '' }} col-sm-6">
		<div id ="dateExact">
                     <label class="col-sm-3 control-label" for="datenaissance">Né(e) le :</label>
                      <div class="col-sm-8">
                            <input class="col-xs-12 col-sm-12 date-picker ltnow" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD"/>{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
                      </div>
              </div>
              <div id ="datePresume"  class="hidden">
                      <label class="col-sm-3 control-label">Age :</strong></label>
                      <div class="radio col-sm-8">
                       <label><input name="presume" class=" ace" type="radio" value="1" checked ><span class="lbl"> Mineur</span></label>
                      <label> <input name="presume" class=" ace" type="radio" value="2" > <span class="lbl">17< age< 65 </span></label>
                       <label><input name="presume" class=" ace" type="radio" value="3"><span class="lbl">age >= 65  </span></label>
                       </div>
              </div>
              <div class="col-sm-1">
              <input  type="checkbox" id="unkDate"  class="ace input-xs"/><span class="lbl lighter red"> <strong>Inc</strong></span>
              </div>
	</div>
        <div class="form-group {{ $errors->has('lieunaissance') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="lieunaissance">Né(e) à :</label>
		<div class="col-sm-9">
		  	<input type="hidden" name="idlieunaissance" id="idlieunaissance">
				<input type="text" id = "lieunaissance" class="autoCommune col-sm-12" placeholder="Lieu de naissance..." autocomplete ="on"/>		
		 		{!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
		</div>
	</div>
</div>
<div class="row demograph">
	<div class="form-group {{ $errors->has('sexe') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="sexe">Genre :<span class="red">*</span></label>
		<div class="col-sm-9">
			<div class="radio">
				<label><input name="sexe" value="M" type="radio" class="ace" checked /><span class="lbl"> Masculin</span></label>
				<label><input name="sexe" value="F" type="radio" class="ace" /><span class="lbl"> Féminin</span></label>
			</div>
		</div>	
	</div>
	<div class="form-group col-sm-6">
		<label class="col-sm-3 control-label text-nowrap" for="gs">Groupe sanguin :</label>
		<div class="col-sm-3">
			<select class="form-control groupeSanguin" id="gs" name="gs">
				<option value="">------</option>
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="O">O</option>
				<option value="AB">AB</option>
			</select>
		</div>
		<label class="col-sm-3 control-label" for="rh">Rhésus :</label>
		<div class="col-sm-3">
			<select id="rh" name="rh" class="rhesus col-sm-12 col-xs-12" disabled>
				<option value="">------</option>
				<option value="+">+</option>
				<option value="-">-</option>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6">
		<label class="col-sm-3 control-label " for="sf">Civilité :</label>
		<div class="col-sm-9">
			<select class="form-control civilite" id="sf" name="sf">
				<option value="">------</option>
				<option value="C">Célibataire(e)</option>
				<option value="M">Marié(e)</option>
				<option value="D">Divorcé(e)</option>
				<option value="V">Veuf(veuve)</option>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-6" id="Div-nomjeuneFille" hidden>
		<label class="col-sm-3 control-label text-nowrap" for="nom_jeune_fille">Nom  jeune fille:</label>
		<div class="col-sm-9">
			<input type="text" id="nom_jeune_fille" name="nom_jeune_fille" placeholder="Nom jeune fille..." autocomplete = "off" class="col-xs-12 col-sm-12" value="{{ old('nom_jeune_fille') }}" />
			 {!! $errors->first('nom_jeune_fille', '<small class="alert-danger">:message</small>') !!}
		</div>
	</div>
</div>
<div class="row"><div class="col-sm-12"><h4 class="header  lighter blue">Contact</h4></div></div>
<div  class="row demograph">
	<div class="form-group col-sm-4">
		<label class="control-label col-sm-4 col-xs-4" for="adresse">Adresse:</label>
		<input type="text" id="adresse" name="adresse" placeholder="Adresse..." class="col-sm-8"/>
	</div> 
	<div class="form-group col-sm-4">
		<label class="control-label col-sm-4 col-xs-4" for="commune">Commune:</label>
		<input type="hidden" name="idcommune" id="idcommune">
	 	<input type="text" value="" id="commune" placeholder="commune résidance" class="autoCommune col-sm-8 col-xs-8"/>
	</div>
	<div class="form-group col-sm-4">
		<label class="control-label col-sm-4 col-xs-4">Wilaya :</label>
		<input type="hidden" name="idwilaya" id="idwilaya">
		<input type="text" value="" id="wilaya" placeholder="wilaya résidance" class=" text-nowrap col-sm-8" readonly />
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-3">
		<label class="control-label col-sm-4" for="mobile1">Mob1:</label>
              <input type="tel" name="mobile1" class="mobile col-sm-8" pattern="0[0-9][0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
	</div>
	<div class="form-group col-sm-3">
			<label class="control-label col-sm-4 col-xs-4" for="mobile2">Mob2:</label>
		  <input type="tel" name="mobile2" class="mobile col-sm-8" pattern="0[0-9][0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
	</div>
	<div class="form-group col-sm-3">
		<label class="control-label col-sm-4 col-xs-4" for="type">Type :<span style="color: red">*</span></label>
		<div class="col-sm-8 col-xs-8">
			<select class="form-control" id="type" name="type" onchange="showTypeAdd(this.value,1);">
				<option value="" disabled selected>------</option>
				<option value="0">Assure</option>
				<option value="1">Conjoint(e)</option>
				<option value="2">Pere</option>
				<option value="3">Mere</option>
				<option value="4">Enfant</option>
				<option value="5">Dérogation</option>
				<option value="6">Autre</option>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-3" id="foncform">
		<label class="control-label col-sm-4 col-xs-4" for="nsspatient">NSS:</label>
		<input type="text" id="nsspatient" name="nsspatient" placeholder="XXXXXXXXXXXX" class="col-xs-12 col-sm-6 nssform" maxlength =12 minlength =12/>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-6 starthidden">
		<label class="control-label col-sm-3" for="description">Autre information :</label>
		<div class="col-sm-8 col-xs-8">
			<textarea class="form-control" id="description" rows="1" name="description" placeholder="Description du la dérogation"></textarea>
		</div>	
	</div>
</div>	