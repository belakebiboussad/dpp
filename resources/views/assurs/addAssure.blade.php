  <div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Informations démographiques</h3></div></div>
 <div class="row Asdemograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('nomf') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="nomf"><strong>Nom :</strong></label>
			<div class="col-sm-9">
				<input type="text" id="nomf" name="nomf" placeholder="Nom..." class="col-xs-12 col-sm-12" autocomplete= "off" value="{{ old('nomf') }}"/>
					{!! $errors->first('nomf', '<small class="alert-danger">:message</small>') !!}
			</div>
		</div>
	</div>	
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('prenomf') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="prenomf"><strong>Prénom :</strong></label>
			<div class="col-sm-9">
				<input type="text" id="prenomf" name="prenomf" placeholder="Prénom..." class="col-xs-12 col-sm-12"  value="{{ old('prenomf') }}"/>
				{!! $errors->first('prenomf', '<p class="alert-danger">:message</p>') !!}
			</div>
		</div>
	</div>
</div> {{-- row --}}
<div class="spce-12"></div>
<div class="row Asdemograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('datenaissancef') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="datenaissancef"><strong class="text-nowrap">Né(e) le :</strong></label>
			<div class="col-sm-9">
				<input class="col-xs-12 col-sm-12 date-picker" id="datenaissancef" name="datenaissancef" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD"/>
				{!! $errors->first('datenaissancef', '<p class="alert-danger">:message</p>') !!}
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('lieunaissancef') ? 'has-error' : '' }}">
			<label class="col-sm-3 control-label" for="lieunaissance"><strong class="text-nowrap">Né(e) à :</strong></label>
			<div class="col-sm-9">
			  	<input type="hidden" name="idlieunaissancef" id="idlieunaissancef">
					<input type="text" id="lieunaissancef" class="autoCommune col-xs-12 col-sm-12" placeholder="Lieu de naissance..." autocomplete ="on"/>		
			 		{!! $errors->first('lieunaissancef', '<small class="alert-danger">:message</small>') !!}
			</div>
		</div>
	</div>
</div>{{-- row --}}
<div class="row Asdemograph">
	<div class="col-sm-6">
		<div class="form-group {{ $errors->has('sexef') ? 'has-error' : '' }}"><!-- no-padding-right -->
			<label class="col-sm-3 control-label" for="sexef"><strong>Genre :</strong></label>
			<div class="col-sm-9">
				<div class="radio">
					<label><input name="sexef" value="M" type="radio" class="ace" checked /><span class="lbl"> Masculin</span></label>
					<label><input name="sexef" value="F" type="radio" class="ace" /><span class="lbl"> Féminin</span></label>
				</div>
			</div>	
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="col-sm-3 control-label text-nowrap" for="gsf"><strong>Groupe sanguin :</strong></label>
			<div class="col-sm-2">
				<select class="form-control" id="gsf" name="gsf">
					<option value="">------</option>
					<option value="A">A</option>
					<option value="B">B</option>
					<option value="O">O</option>
					<option value="AB">AB</option>
				</select>
			</div>
			<label class="col-sm-3 control-label no-padding-right" for="rh"><strong>Rhésus:</strong></label>
			<div class="col-sm-2">
				<select id="rhf" name="rhf">
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
			<label class="col-sm-3 control-label" for="SituationFamille"><strong class="text-nowrap">Civilité :</strong></label>
			<div class="col-sm-9">
				<select class="form-control" id="SituationFamille" name="SituationFamille">
					<option value="">------</option>
					<option value="célibataire">Célibataire(e)</option>
					<option value="marié">Marié(e)</option>
					<option value="divorcé">Divorcé(e)</option>
					<option value="veuf">Veuf(veuve)</option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Contact</h3></div></div>	
<div class="row Asdemograph"><!-- style="padding-left:7%" -->
	<div class="col-sm-4">
		<label class="col-sm-4" for="adressef" ><strong>Adresse:</strong></label>
		  <input type="text" value="" id="adressef" name="adressef" placeholder="Adresse..." class="col-sm-8"/>
	</div> <!-- style="margin-top: -0.1%;" -->
	<div class="col-sm-4">
		<label class="col-sm-4 text-nowrap" for="communef"><strong>Commune:</strong></label>
		<input type="hidden" name="idcommunef" id="idcommunef">
	 	<input type="text" value="" id="communef" placeholder="commune résidance" class="autoCommune col-sm-8"/>
	</div>
	<div class="col-sm-4">
		  <label class="col-sm-4" for="wilayaf"><strong>Wilaya:</strong></label>
		  <input type="hidden" name="idwilayaf" id="idwilayaf">
		  <input type="text" value="" id="wilayaf" placeholder="wilaya résidance" class="col-sm-8" readonly />
	</div>
</div>
<div class="space-12"></div>
<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Fonction</h3></div></div>	{{-- row --}}
<div class="row">
  <div class="col-sm-6" id="statut">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="Position"><strong>Position :</strong></label>		
			<div class="col-sm-9">
				<select name="Position" id="Position" class="col-xs-12 col-sm-12">
					<option value="">Sélectionner...</option>
					<option value="Activité">Activité</option>
					<option value="Retraité">Retraite</option>
					<option value="Congé Maladie" >Congé Maladie</option>
					<option value="Révoqué">Révoqué</option>
				</select>

			</div>
		</div>
	</div>
	<div class="col-sm-6" id = "serviceFonc">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="service">
				<strong>Service :</strong>
			</label>
			<div class="col-sm-9">
				<input type="text" name="service" id="service" class="col-xs-12 col-sm-12" placeholder="Service du Fonctionnaire">
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="col-sm-3 control-label " for="grade">
				<strong>Grade :</strong>
			</label>
			<div class="col-sm-9">
			<select id="grade" name="grade" class="col-xs-12 col-sm-12"/>
				@foreach($grades as $key=>$grade)
			    <option value="{{ $grade->id }}">{{ $grade->nom }}</option>
				@endforeach
			</select>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-3" for="mat">
				<strong>Matricule :</strong>
			</label>
			<div class="col-sm-9">
				<div class="clearfix">
					<input type="text" id="mat" name="mat" class="col-xs-12 col-sm-12" placeholder="Matricule..." maxlength =5 minlength =5 />
				</div>
			</div>
		</div>
</div>
</div>	{{-- row --}}
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-3" for="NMGSN">
				<strong>NMGSN :</strong>
			</label>
			<div class="col-sm-9">
				<div class="clearfix">
					<input type="text" id="NMGSN" name="NMGSN" class="col-xs-12 col-sm-12" placeholder="numéro mutuel" placeholder="XXXXXXXXXXXX" maxlength =12 minlength =12/>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-3" for="nss2"><strong>NSS :</strong></label>		
			<div class="col-sm-9">
			<div class="clearfix">
				<input type="text" id="nss" name="nss" class="col-xs-12 col-sm-12" placeholder="XXXXXXXXXXXX" maxlength =12 minlength =12 />
			</div>
			</div>
		</div>
	</div>
</div>	{{-- row --}}
