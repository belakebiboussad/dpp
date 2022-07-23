 <!-- begin -->
 <div id="asdemogData">
 <div class="row"><div class="col-sm-12"><h4 class="header  lighter blue">Informations démographiques</h4></div></div>
 <div class="row">
	<div class="form-group {{ $errors->has('nomf') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="nomf">Nom :<span class="red">*</span></label>
		<div class="col-sm-9">
			<input type="text" id="nomf" name="nomf" placeholder="Nom..." class="asdemogData col-xs-12 col-sm-12"  value="{{ old('nomf') }}"/>
				{!! $errors->first('nomf', '<small class="alert-danger">:message</small>') !!}
		</div>
	</div>	
	<div class="form-group {{ $errors->has('prenomf') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="prenomf">Prénom :<span class="red">*</span></label>
		<div class="col-sm-9">
			<input type="text" id="prenomf" name="prenomf" placeholder="Prénom..." class="asdemogData col-xs-12 col-sm-12"  value="{{ old('prenomf') }}"/>
			{!! $errors->first('prenomf', '<p class="alert-danger">:message</p>') !!}
		</div>
	</div>
</div>
<div class="row ">
	<div class="form-group {{ $errors->has('datenaissancef') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label text-nowrap" for="datenaissancef">Né(e) le :</label>
		<div class="col-sm-9">
			<input class="asdemogData col-xs-12 col-sm-12 date-picker ltnow" id="datenaissancef" name="datenaissancef" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" autocomplete="off"/>
			{!! $errors->first('datenaissancef', '<p class="alert-danger">:message</p>') !!}
		</div>
	</div>
	<div class="form-group {{ $errors->has('lieunaissancef') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="lieunaissance">Né(e) à :</label>
		<div class="col-sm-9">
		  	<input type="hidden" name="idlieunaissancef" id="idlieunaissancef">
				<input type="text" id="lieunaissancef" class="autoCommune asdemogData col-xs-12 col-sm-12" placeholder="Lieu de naissance..." autocomplete ="on"/>		
		 		{!! $errors->first('lieunaissancef', '<small class="alert-danger">:message</small>') !!}
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group {{ $errors->has('sexef') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="sexef">Genre :</label>
		<div class="col-sm-9">
			<div class="radio">
				<label><input name="sexef" value="M" type="radio" class="asdemogData ace" checked/><span class="lbl"> Masculin</span></label>
				<label><input name="sexef" value="F" type="radio" class="asdemogData ace"/><span class="lbl"> Féminin</span></label>
			</div>
		</div>	
	</div>
	<div class="form-group col-sm-6">
		<label class="col-sm-3 control-label text-nowrap" for="gsf">Groupe sanguin :<span  class="red">*</span></label>
		<div class="col-sm-3">
			<select class="form-control groupeSanguin asdemogData" id="gsf" name="gsf" class="col-sm-12">
				<option value="">------</option>
				<option value="A">A</option>
				<option value="B">B</option>
				<option value="O">O</option>
				<option value="AB">AB</option>
			</select>
		</div>
		<label class="col-sm-3 control-label no-padding-right" for="rh">Rhésus :<span class="red">*</span></label>
		<div class="col-sm-3">
			<select id="rhf" name="rhf" class="col-sm-12 rhesus asdemogData" disabled>
				<option value="">------</option>
				<option value="+">+</option>
				<option value="-">-</option>
			</select>
		</div>
	</div>	
</div>{{-- row --}}
<div class="row">
	<div class="form-group col-sm-6">
		<label class="col-sm-3 control-label" for="SituationFamille">Civilité :</label>
		<div class="col-sm-9">
			<select class="form-control asdemogData" id="SituationFamille" name="SituationFamille">
				<option value="">------</option>
				<option value="C">Célibataire(e)</option>
				<option value="M">Marié(e)</option>
				<option value="D">Divorcé(e)</option>
				<option value="V">Veuf(veuve)</option>
			</select>
		</div>
	</div>
</div>
<div class="row"><div class="col-sm-12"><h4 class="header  lighter blue">Contact</h4></div></div>	
<div class="row">
	<div class="form-group col-sm-4">
		<label class="control-label col-sm-4" for="adressef" >Adresse:</label>
		  <input type="text" value="" id="adressef" name="adressef" placeholder="Adresse..." class="asdemogData col-sm-8"/>
	</div>
	<div class="form-group  col-sm-4">
		<label class="control-label col-sm-4" for="communef">Commune:</label>
		<input type="hidden" name="idcommunef" id="idcommunef">
	 	<input type="text" value="" id="communef" placeholder="commune résidance" class="autoCommune asdemogData col-sm-8" value="Autre"/>
	</div>
	<div class="form-group  col-sm-4">
	  <label class="control-label col-sm-4" for="wilayaf">Wilaya:</label>
	  <input type="hidden" name="idwilayaf" id="idwilayaf"  value="49">
	  <input type="text" value="" id="wilayaf" placeholder="wilaya résidance" class="col-sm-8" value="Autre" readonly />
	</div>
</div>
</div><!-- / -->
<!-- end demog data-->
<div class="row"><div class="col-sm-12"><h4 class="header  lighter blue">Fonction</h4></div></div>	{{-- row --}}
<div class="row">
	<div class="form-group col-sm-4">
		<label class="col-sm-3 control-label" for="grade">Grade :</label>
		<div class="col-sm-9">
			<select id="grade" name="grade" class=" col-xs-12 col-sm-12 asProfData"/>
				<option value="">Sélectionner...</option>
				@foreach ($grades as $key=>$grade)
				<option value="{{ $grade->id }}">{{ $grade->nom }}</option>
				@endforeach
			</select>
		</div>
	</div>
      <div class="form-group col-sm-4" id="statut">
		<label class="col-sm-3 control-label" for="Position">Position :<span class="red">*</span></label>		
		<div class="col-sm-9">
			<select name="Position" id="Position" class="col-sm-12">
				<option value="">Sélectionner...</option>
				<option value="Activité">Activité</option>
				<option value="Détachement">Détachement</option>
				<option value="Mise en Disponibilité">Mise en disponibilité</option>
				<option value="Licencié">Licencié</option>
				<option value="Démission">Démission</option>
				<option value="Congé non rémunéré">Congé non rémunéré</option>
				<option value="Retraite">Retraite</option>
				<option value="Congé Longue Durée">Congé longue durée</option>
				<option value="Assurance Invalidité">Assurance invaliditéé</option>
				<option value="Décédé">Décédé</option>
				<option value="Service National">Service national</option>
				<option value="Contrat résilié">Contrat résilié</option>
				<option value="Congé Maladie" >Congé Maladie</option>
				<option value="Révoqué">Révoqué</option>
			</select>
		</div>
	</div>
	<div class="form-group col-sm-4" id ="serviceFonc">
		<label class="col-sm-3 control-label no-padding-right" for="service">Service :</label>
		<div class="col-sm-9">
			<input type="text" name="service" id="service" class="col-xs-12 col-sm-12" placeholder="Service du Fonctionnaire">
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-sm-4">
		<label class="control-label col-xs-12 col-sm-3" for="mat">Matricule :</label>
			<div class="col-sm-9">
			<div class="clearfix">
				<input type="text" id="mat" name="mat" class="col-sm-12" placeholder="Matricule..." maxlength =5 minlength =5 />
			</div>
		</div>
	</div>
      <div class="form-group col-sm-4">
		<label class="control-label col-xs-12 col-sm-3" for="nss2">NSS :<span class="red">*</span></label>		
		<div class="clearfix col-sm-9">
			<input type="text" id="nss" name="nss" class="col-sm-12 nssform" placeholder="XXXXXXXXXXXX"/>
		</div>
	</div>
	<div class="form-group col-sm-4">
		<label class="control-label col-xs-12 col-sm-3" for="NMGSN">NMGSN :</label>
		<div class="clearfix col-sm-9">
			<input type="text" id="NMGSN" name="NMGSN" class="col-sm-12 nssform" placeholder="numéro mutuel" placeholder="XXXXXXXXXXXX" />
		</div>
	</div>
</div>	{{-- row --}}