<div class="row"><div class="col-sm-12"><h4 class="header smaller lighter blue"><strong>Informations démographiques</strong></h4></div></div>
<div class="row demograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="nom"><strong>Nom :<span style="color: red">*</span></strong></label>
			<div class="col-sm-9">
				<input type="text" id="nom" name="nom" placeholder="Nom..." class="col-xs-12 col-sm-12" autocomplete= "off" value="{{Input::old('nom')}}" alpha/>
					{!! $errors->first('nom', '<small class="alert-danger">:message</small>') !!}
			</div>
		</div>
	</div>	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('prenom') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="prenom"><strong>Prénom :<span style="color: red">*</span></strong></label>
			<div class="col-sm-9">
				<input type="text" id="prenom" name="prenom" placeholder="Prénom..." class="col-xs-18 col-sm-12" value="{{Input::old('prenom')}}" autocomplete="off"/>
				{!! $errors->first('prenom', '<p class="alert-danger">:message</p>') !!}
			</div>
		</div>
	</div>
</div>
<div class="spce-12"></div>
<div class="row demograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('datenaissance') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="datenaissance"><strong>Né(e) le :</strong></label>
			<div class="col-sm-9">
				<input class="col-xs-12 col-sm-12 date-picker ltnow" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" autocomplete="off"/>{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('lieunaissance') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="lieunaissance"><strong class="text-nowrap">Né(e) à :</strong></label>
			<div class="col-sm-9">
			  	<input type="hidden" name="idlieunaissance" id="idlieunaissance">
					<input type="text" id = "lieunaissance" class="autoCommune col-sm-12" placeholder="Lieu de naissance..." autocomplete ="on"/>		
			 		{!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
			</div>
		</div>
	</div>
</div>
<div class="row demograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('sexe') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="sexe"><strong>Genre :<span style="color: red">*</span></strong></label>
			<div class="col-sm-9">
				<div class="radio">
					<label><input name="sexe" value="M" type="radio" class="ace" checked /><span class="lbl"> Masculin</span></label>
					<label><input name="sexe" value="F" type="radio" class="ace" /><span class="lbl"> Féminin</span></label>
				</div>
			</div>	
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="col-sm-3 control-label text-nowrap" for="gs"><strong>Groupe sanguin :</strong></label>
			<div class="col-sm-3">
				<select class="form-control groupeSanguin" id="gs" name="gs">
					<option value="">------</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="O">O</option>
					<option value="AB">AB</option>
				</select>
			</div>
			<label class="col-sm-3 control-label no-padding-right" for="rh"><strong>Rhésus:</strong></label>
			<div class="col-sm-3">
				<select id="rh" name="rh" class="rhesus col-sm-12 col-xs-12" disabled>
					<option value="">------</option>
					<option value="+">+</option>
					<option value="-">-</option>
				</select>
			</div>
		</div>	
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="sf"><strong class="text-nowrap">Civilité :</strong></label>
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
	</div>
	<div class="col-sm-6" id="Div-nomjeuneFille" hidden>
		<label class="col-sm-3 control-label" for="nom_jeune_fille"><strong class="text-nowrap">Nom  jeune fille:</strong></label>
		<div class="col-sm-9">
			<input type="text" id="nom_jeune_fille" name="nom_jeune_fille" placeholder="Nom jeune fille..."  autocomplete = "off" class="col-xs-12 col-sm-12" />
			 {!! $errors->first('nom_jeune_fille', '<small class="alert-danger">:message</small>') !!}
		</div>
	</div>
</div>
<div class="row"><div class="col-sm-12"><h4 class="header smaller lighter blue"><strong>Contact</strong></h4></div></div>
<div class="space-12 hidden-xs"></div>		
<div  class="row demograph">
	<div class="col-sm-4">
		<label class="control-label col-sm-4 col-xs-4" for="adresse" ><strong>Adresse:</strong></label>
		<input type="text" value="" id="adresse" name="adresse" placeholder="Adresse..." class="col-sm-8"/>
	</div> 
	<div class="col-sm-4">
		<label class="control-label col-sm-4 col-xs-4" for="commune"><strong>Commune:</strong></label>
		<input type="hidden" name="idcommune" id="idcommune">
	 	<input type="text" value="" id="commune" placeholder="commune résidance" class="autoCommune col-sm-8 col-xs-8"/>
	</div>
	<div class="col-sm-4">
		<label class="control-label col-sm-4 col-xs-4"><strong>Wilaya :</strong></label>
		<input type="hidden" name="idwilaya" id="idwilaya">
		<input type="text" value="" id="wilaya" placeholder="wilaya résidance" class=" text-nowrap col-sm-8" readonly />
	</div>
</div>
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-3 col-xs-3">
		<div class="form-group">
			<label class="control-label col-sm-4 col-xs-4" for="operateur1" ><strong>Mob1:</strong></label>
			<div class="col-sm-3">
				<select name="operateur1" id="operateur1" class="form-control">
			    <option value="">XX</option>         
		 			<option value="05">05</option>         
					<option value="06">06</option>
					<option value="07" >07</option>
        </select>
      </div>
      <input type="tel" name="mobile1" id="mobile1" maxlength =8 minlength =8 class="mobileform col-sm-5" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
		</div>
	</div>
	<div class="col-sm-3  col-xs-3">
		<div class="form-group">
			<label class="control-label col-sm-4 col-xs-4" for="mobile2" ><strong>Mob2:</strong></label>
			<div class="col-sm-3">
				<select name="operateur2" id="operateur2" class="form-control">
					<option value="">XX</option>         
		 				<option value="05">05</option>         
					  <option value="06">06</option>
					  <option value="07">07</option>
        </select>
      </div>
      <input type="tel" name="mobile2" id="mobile2" maxlength =8 minlength =8 class="mobileform col-sm-5" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}">
		</div>
	</div>
	<div class="col-sm-3 col-xs-3">
		<div class="form-group">
			<label class="control-label col-sm-4 col-xs-4" for="type" ><strong>Type :<span style="color: red">*</span></strong></label>
			<div class="col-sm-8 col-xs-8">
				<select class="form-control" id="type" name="type" onchange="showTypeEdit(this.value,1);">
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
	</div>
	<div class="col-sm-3 col-xs-3">
		<div class="form-group" id="foncform">
			<label class="control-label col-sm-4 col-xs-4" for="nsspatient" ><strong>NSS (patient):</strong></label>
			<input type="text" value="" id="nsspatient" name="nsspatient" placeholder="XXXXXXXXXXXX" class="col-xs-12 col-sm-6 nssform" maxlength =12 minlength =12/>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 starthidden">
		<div class="form-group">
			<label class="control-label col-sm-3 col-xs-3" for="description"><strong>Autre information :</strong></label>
			<div class="col-sm-8 col-xs-8">
				<textarea class="form-control" id="description" rows="1" name="description" placeholder="Description du la dérogation"></textarea>
			</div>
		</div>			
	</div>
</div>	