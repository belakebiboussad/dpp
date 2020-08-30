 <div class="row demograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="nom"><strong>Nom :</strong></label>
			<div class="col-sm-9">
				<input type="text" id="nom" name="nom" placeholder="Nom..." class="col-xs-12 col-sm-12" autocomplete= "off" value="{{ old('nom') }}" alpha/>
					{!! $errors->first('nom', '<small class="alert-danger">:message</small>') !!}
			</div>
		</div>
	</div>	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('prenom') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="prenom"><strong>Prénom :</strong></label>
			<div class="col-sm-9">
				<input type="text" id="prenom" name="prenom" placeholder="Prénom..." class="col-xs-18 col-sm-12" autocomplete="off"/>
				{!! $errors->first('prenom', '<p class="alert-danger">:message</p>') !!}
			</div>
		</div>
	</div>
</div> {{-- row --}}
<div class="spce-12"></div>
<div class="row demograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('datenaissance') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="datenaissance"><strong>Né(e) le :</strong></label>
			<div class="col-sm-9">
				<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="Date de naissance..." pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"/>
				{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('lieunaissance') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="lieunaissance"><strong class="text-nowrap">Né(e) à :</strong></label>
			<div class="col-sm-9">
			  	<input type="hidden" name="idlieunaissance" id="idlieunaissance">
					<input type="text" id = "lieunaissance" class="typeahead com_typeahead typeaheadcol-sm-12" placeholder="Lieu de naissance..." autocomplete ="on"/>		
			 		{!! $errors->first('lieunaissance', '<small class="alert-danger">:message</small>') !!}
			</div>
		</div>
	</div>
</div>{{-- row --}}
<div class="row demograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('sexe') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="sexe"><strong>Genre :</strong></label>
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
			<div class="col-sm-2">
				<select class="form-control" id="gs" name="gs">
					<option value="">------</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="O">O</option>
					<option value="AB">AB</option>
				</select>
			</div>
			<label class="col-sm-3 control-label no-padding-right" for="rh"><strong>Rhésus:</strong></label>
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
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="sf"><strong class="text-nowrap">Civilité :</strong></label>
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
		<label class="col-sm-3 control-label" for="nom_jeune_fille"><strong class="text-nowrap">Nom  jeune fille:</strong></label>
		<div class="col-sm-9">
			<input type="text" id="nom_jeune_fille" name="nom_jeune_fille" placeholder="Nom jeune fille..."  autocomplete = "off" class="col-xs-12 col-sm-12" />
			 {!! $errors->first('nom_jeune_fille', '<small class="alert-danger">:message</small>') !!}
		</div>
	</div>{{-- col-sm-6 --}}{{-- /nom de jeune fille --}}
</div>	{{-- row --}}
<div class="row">
	<div class="col-sm-12">
		<h3 class="header smaller lighter blue">Contact</h3>
	</div>
</div>	{{-- row --}}
<div class="space-12"></div>		
<div  class="row demograph"><!-- style="padding-left:7%" -->
	<div class="col-sm-4">
		<label class="col-sm-4  text-nowrap" for="adresse" ><strong>Adresse:</strong></label>
		  <input type="text" value="" id="adresse" name="adresse" placeholder="Adresse..." class="col-sm-8"/>
	</div> <!-- style="margin-top: -0.1%;" -->
	<div class="col-sm-4">
		<label class="col-sm-4 text-nowrap" for="commune"><strong>Commune:</strong></label>
		<input type="hidden" name="idcommune" id="idcommune">
	 	 <input type="text" value="" id="commune" placeholder="commune résidance" class="com_typeahead col-sm-8"/>
	</div>
	<div class="col-sm-4">
		  <label class="col-sm-4" for="wilaya"><strong>Wilaya:</strong></label>
		  <input type="hidden" name="idwilaya" id="idwilaya">
		  <input type="text" value=""  id="wilaya" placeholder="wilaya résidance" class=" text-nowrap col-sm-8" readonly />
	</div>
</div>
<div class="space-12"></div>
<div class="row">
{{--<div class="col-sm-5" {{ $errors->has('mobile1') ? 'has-error' : '' }}">	<!-- <div class="form-group" style="padding-left:10%;"> -->
<label class="col-sm-5 control-label" for="mobile1"><i class="fa fa-phone"></i><strong class="text-nowrap">Mob1 :</strong>	</label>
<div class="col-sm-3" {{ $errors->has('operateur1') ? 'has-error' : '' }}">	<select name="operateur1" id="operateur1" class="form-control">
<option value="">XX</option><option value="05">05</option><option value="06">06</option><option value="07">07</option></select>	
</div><input id="mobile1" name="mobile1"  maxlength =8 minlength =8 type="tel" class="col-sm-4" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX"/>	
</div><div class="col-sm-5">
		<label class="col-sm-5 control-label" for="mobile2">
			<i class="fa fa-phone"></i><strong class="text-nowrap">Mob2 :</strong>
		</label>
		<div class="col-sm-3">
		  <select name="operateur2" id="operateur2" class="form-control">
		 		<option value="">XX</option>
				<option value="05">05</option>         
		 		<option value="06">06</option>
			  <option value="07">07</option>
	      </select>
    </div>
		<input id="mobile2" name="mobile2"  maxlength =8 minlength =8  type="tel" autocomplete="off" class="col-sm-4" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XXXXXXXX"/></div>--}}
<div class="col-sm-4 col-xs-4">
		<div class="form-group" style="padding-left:15%;">
			<label class="control-label text-nowrap col-sm-4" for="mobile1"><i class="fa fa-phone"></i><strong>Mob1:</strong></label>
			<div class="col-sm-4" >
				<select name="operateur1" id="operateur1" class="form-control">
					<option value="" selected >XX</option>
					<option value="05">05</option>         
				  <option value="06">06</option>
				  <option value="07">07</option>
	      </select>	
			</div>
			<input id="mobile1" name="mobile1"  maxlength =8 minlength =8 type="tel" autocomplete="off" class="col-sm-4" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXX"/>	
		</div>		
		</div>	 
		<div class="col-sm-4 col-xs-4">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="mobile2"><i class="fa fa-phone"></i><strong class="text-nowrap">Mob2 :</strong></label>
				<div class="col-sm-4">
					<select name="operateur2" id="operateur2" class="form-control">
					  <option value="" selected >XX</option>
				    <option value="05" >05</option>
						<option value="06">06</option>
						<option value="07">07</option>
			    </select>
				</div>
				<input id="mobile2" name="mobile2"  maxlength =8 minlength =8  type="tel" autocomplete="off" class="col-sm-4" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XX XX XX XX">
			</div>
		</div>		
		<div class="col-sm-4 col-xs-4">
			<div class="form-group">
				<div class="col-sm-2">
					<label class="control-label no-padding-right pull-right text-nowrap" style=" padding-top: 0px;"><strong>Type:</strong></label>
				</div>
				<div class="col-sm-10">
					<label class="line-height-1 blue">
						<input id="fonc" name="type" value="Assure" type="radio" class="ace" onclick="showType('Assure',1)"/>
						<span class="lbl">Assuré</span>
					</label>
					<label class="line-height-1 blue">
						<input id="ayant" name="type" value="Ayant_droit" type="radio" class="ace" onclick="showType('Ayant_droit',1)" Checked/>
						<span class="lbl">Ayant droit</span>
					</label>
					<label class="line-height-1 blue">
						<input id="autre" name="type" value="Autre" type="radio" class="ace" onclick="showType('Autre',1)"/>
						<span class="lbl">Autre</span>
					</label>	
				</div>
			</div>		
		</div>{{-- col-sm-4 --}}
</div> 
<div class="space-12"></div>
<div class="space-12"></div>
	<div class="row" id="foncform">
		<div class="col-sm-6">
			<div class="form-group">
				 <label class="col-sm-3 control-label" for="Type_p">	<strong>Type :</strong></label>
			        <div class="col-sm-9">
				<select class="form-control col-xs-12 col-sm-6" id="Type_p" name="Type_p">
					<option value="">------</option>
					<option value="Ascendant">Ascendant</option>
					<option value="Descendant">Descendant</option>
					<option value="Conjoint(e)">Conjoint(e)</option>
				</select>
				</div>
			</div>				
		</div>	
	<div class="col-sm-6">
	<div class="form-group">
		 <label class="col-sm-4 control-label" for="nsspatient"><strong>NSS (patient):</strong></label>
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
<div class="row">
	<div class="col-sm-12">
		<h3 class="header smaller lighter blue">Homme de Confiance</h3>
	</div>
</div>
<div class="row">
 	<div class="col-sm-1"></div>		
	<div class="col-sm-11">
		<div class="form-group padding-left">
			<input  type="checkbox" name = "hommeConf" id="hommeConf" value="1"  class="ace input-lg"/>
			<span class="lbl lighter blue"><strong>Ajouter un Correspondant</strong></span>
		</div>
	</div>				
</div>		
