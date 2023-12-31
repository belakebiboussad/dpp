<h4 class="header  lighter blue">Assurance</h4>
<div class="row">
  <div class="form-group col-sm-4">
    <label class="control-label col-md-3 col-sm-3 required" for="nss">NSS</label>    
    <div class="col-sm-9">
      <input type="text" id="nss" name="nss" class="form-control nssform" placeholder="Numéro sécurité sociale"/>
       {!! $errors->first('nss', '<p class="alert-danger">:message</p>') !!}
    </div>
  </div>
</div>
<div id="asdemogData">
<h4 class="header lighter block blue">Informations démographiques</h4>
 <div class="row">
	<div class="form-group {{ $errors->has('nomf') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label required" for="nomf">Nom</label>
		<div class="col-sm-9">
			<input type="text" id="nomf" name="nomf" placeholder="Nom..." class="asdemogData form-control" value="{{ old('nomf') }}"/>{!! $errors->first('nomf', '<small class="alert-danger">:message</small>') !!}	
		</div>
	</div>	
	<div class="form-group {{ $errors->has('prenomf') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label required" for="prenomf">Prénom</label>
		<div class="col-sm-9">
			<input type="text" id="prenomf" name="prenomf" placeholder="Prénom..." class="asdemogData form-control"  value="{{ old('prenomf') }}"/>{!! $errors->first('prenomf', '<p class="alert-danger">:message</p>') !!}
		</div>
	</div>
</div>
<div class="row ">
	<div class="form-group {{ $errors->has('datenaissancef') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label text-nowrap" for="datenaissancef">Né(e) le</label>
		<div class="col-sm-9">
			<input class="asdemogData form-control date-picker ltnow" id="datenaissancef" name="datenaissancef" type="text" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" autocomplete="off"/>
			{!! $errors->first('datenaissancef', '<p class="alert-danger">:message</p>') !!}
		</div>
	</div>
	<div class="form-group {{ $errors->has('lieunaissancef') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label" for="pobf">Né(e) à</label>
		<div class="col-sm-9">
      <select name="pobf" id="pobf" class="form-control autoCommune"></select>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group {{ $errors->has('sexef') ? 'has-error' : '' }} col-sm-6">
		<label class="col-sm-3 control-label">Genre</label>
		<div class="col-sm-9">
			<div class="radio">
				<label><input name="sexef" value="M" type="radio" class="asdemogData ace" checked/><span class="lbl"> Masculin</span></label>
				<label><input name="sexef" value="F" type="radio" class="asdemogData ace"/><span class="lbl"> Féminin</span></label>
			</div>
		</div>	
	</div>
	<div class="form-group col-sm-6">
		<label class="col-sm-3 control-label text-nowrap" for="gsf">Groupe sanguin</label>
		<div class="col-sm-3">
			<select class="form-control groupeSanguin asdemogData" id="gsf" name="gsf" class="col-sm-12">
				<option value="">------</option>
				<option value="A">A</option><option value="B">B</option>
				<option value="O">O</option><option value="AB">AB</option>
			</select>
		</div>
		<label class="col-sm-3 control-label no-padding-right" for="rh">Rhésus</label>
		<div class="col-sm-3">
			<select id="rhf" name="rhf" class="form-control rhesus asdemogData" disabled>
				<option value="">------</option>
				<option value="+">+</option>
				<option value="-">-</option>
			</select>
		</div>
	</div>	
</div>{{-- row --}}
<div class="row">
	<div class="form-group col-sm-6">
		<label class="col-sm-3 control-label" for="SituationFamille">Civilité</label>
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
<h4 class="header lighter block blue">Contact</h4>
<div class="row">
	<div class="form-group col-sm-4">
		<label class="control-label col-sm-4" for="adressef">Adresse</label>
		<input type="text" value="" id="adressef" name="adressef" placeholder="Adresse..." class="asdemogData col-sm-8"/>
	</div>
	<div class="form-group  col-sm-4">
		<label class="control-label col-sm-4" for="idcommunef">Commune</label>
	  <div class="col-sm-8 col-xs-8">
      <select name="idcommunef" id="idcommunef" class="form-control asdemogData autoCommune">
      </select>
     </div> 
	</div>
	<div class="form-group  col-sm-4">
	  <label class="control-label col-sm-4" for="wilayaf">Wilaya</label>
	<input type="text" value="" id="wilayaf" placeholder="wilaya résidance" class="col-sm-8" value="Autre" readonly />
	</div>
</div>
</div><!-- end demog data-->