 <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Informations administratives</h3></div></div>
 <div class="row demograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="nom"><strong>Nom :<span style="color: red">*</span></strong></label>
			<div class="col-sm-9">
				<input type="text" id="nom" name="nom" placeholder="Nom..." class="col-xs-12 col-sm-12" autocomplete= "off" value="{{ $nom }}" alpha/>
					{!! $errors->first('nom', '<small class="alert-danger">:message</small>') !!}
			</div>
		</div>
	</div>	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('prenom') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="prenom"><strong>Prénom :<span style="color: red">*</span></strong></label>
			<div class="col-sm-9">
				<input type="text" id="prenom" name="prenom" placeholder="Prénom..." class="col-xs-18 col-sm-12" autocomplete="off" value ="{{ $prenom }}"/>
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
				<input class="col-xs-12 col-sm-12 date-picker" id="datenaissance" name="datenaissance" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" autocomplete="off"/>
				{!! $errors->first('datenaissance', '<p class="alert-danger">:message</p>') !!}
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
				<select class="form-control groupeSanguin" id="gs" name="gs">
					<option value="">------</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="O">O</option>
					<option value="AB">AB</option>
				</select>
			</div>
			<label class="col-sm-3 control-label no-padding-right" for="rh"><strong>Rhésus:</strong></label>
			<div class="col-sm-2">
				<select id="rh" name="rh" class="rhesus" disabled>
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
</div>	{{-- row --}}
<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Contact</h3></div></div><div class="space-12"></div>
<div  class="row demograph">
	<div class="col-sm-4">
    <label class="col-sm-4" for="adresse" ><strong>Adresse:</strong></label>
	   <div class="col-sm-8">
		  <input type="text" value="" id="adresse" name="adresse" placeholder="Adresse..."/>
    </div>
	</div> 
	<div class="col-sm-4">
		<div class="form-group">
      <label class="col-sm-4" for="commune"><strong>Commune:</strong></label><input type="hidden" name="idcommune" id="idcommune">
	 	 <input type="text" value="" id="commune" placeholder="commune résidance" class="autoCommune col-sm-8"/>
    </div>
	</div>
	<div class="col-sm-4">
		<label class="col-sm-4" for="wilaya"><strong>Wilaya:</strong></label>
		<input type="hidden" name="idwilaya" id="idwilaya"/>
		<input type="text" value=""  id="wilaya" placeholder="wilaya résidance" class=" text-nowrap col-sm-8" readonly />
	</div>
</div><div class="space-12"></div>
<div class="row">
<div class="col-sm-4 col-xs-4">
		<div class="form-group" style="padding-left:15%;">
			<label class="control-label text-nowrap col-sm-4" for="mobile1"><i class="fa fa-phone"></i><strong>Mob1:</strong></label>
			<input name="mobile1" type="tel" class="col-sm-8 mobile" pattern="0[0-9][0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" placeholder="XXXXXXXXXX"/>	
		</div>		
		</div>	 
		<div class="col-sm-4 col-xs-4">
			<div class="form-group">
				<label class="col-sm-4 control-label" for="mobile2"><i class="fa fa-phone"></i><strong class="text-nowrap">Mob2 :</strong></label>
				<input name="mobile2" type="tel" class="col-sm-4 mobile" pattern="0[0-9][0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}"   placeholder="XX XX XX XX">
			</div>
		</div>		
		<div class="col-sm-4 col-xs-4">
			<div class="form-group">
				<div class="col-sm-2">
					<label class="control-label no-padding-right pull-right text-nowrap" style=" padding-top: 0px;"><strong>Type :<span style="color: red">*</span></strong></label>
				</div>
				<div class="col-sm-10">
					<select class="form-control col-xs-12 col-sm-6" id="type" name="type" disabled >
						<option value="0" @if( $type =='0') selected @endif>Assure</option>
						<option value="1" @if($type =='1') selected @endif >Conjoint(e)</option>
						<option value="2" @if($type =='2') selected @endif >Pere</option>
						<option value="3"@if($type =='3') selected @endif  >Mere</option>
						<option value="4" @if($type =='4') selected @endif >Enfant</option>
					</select>
				</div>
			</div>		
		</div>{{-- col-sm-4 --}}
</div> 
<div class="space-12"></div><div class="space-12"></div>
<div class="row" id="foncform">
	<div class="col-sm-6">
		<div class="form-group">
	   	    <label class="col-sm-4 control-label" for="nsspatient"><strong>NSS (patient):</strong></label>
			<div class="col-sm-8">
				<input type="text" class="form-control col-xs-12 col-sm-6 nssform" id="nsspatient" name="nsspatient" placeholder="XXXXXXXXXXXX"/><!-- pattern="^\[0-9]{2}+' '+\[0-9]{4} +' '+\[0-9]{4}+' '+[0-9]{2}$" -->
			</div>
		</div>		
	</div><div class="col-sm-6"></div> 			
</div>		