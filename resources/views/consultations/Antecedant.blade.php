<div class="col-xs-6 col-sm-8">
<div class="widget-main">
	<form action="" id ="antcdForm">
		
	
	<div class="form-group">
		<label for="Antecedant"><strong>Antécédant:</strong>
		</label><br><br>
		<select class="form-control" id="Antecedant" name="Antecedant" onchange="atcd();" required>
			<option value="Personnels">Personnels</option>
			<option value="Familiaux" selected>Familiaux</option>
		</select>
	</div>
	<br>
	<div id="sous_type" style="display: none;" class="form-group">
		<select class="form-control" id="typeAntecedant" name="typeAntecedant" onchange="atcdhide()">
			<option value="null" selected>Choisir...</option>
			<option value="Physiologiques">Physiologiques</option>
			<option value="Pathologiques">Pathologiques</option>
		</select>
	</div>
	<div id="atcdsstypehide" hidden="true" >
		<hr/>
		<label for="sstypeatcd"><strong>Type de l'antécédant :</strong></label>
		<select class="form-control" id="sstypeatcdc" name="sstypeatcdc" onchange="resetField();">
			<option value="null">Choisir...</option>
			<option value="Medicaux" >Médicaux</option>
			<option value="Chirurigicaux">Chirurigicaux</option>
		</select>
	</div>
	<div id="PhysiologieANTC" hidden="true" class="form-group" >
		<label for="habitudeAlim">
			<strong>habitude alimentaire :</strong>
		</label>
		<br><br>
		<input type="text" name="habitudeAlim" class="form-control d" id="habitudeAlim"  /><br>
		<label>
             			<input type="checkbox" class="ace"  id="tabac" name="tabac"/>
             			<span class="lbl" >&nbsp; &nbsp;tabac</span>
        		</label>
        		&nbsp; &nbsp; &nbsp;
        		<label>
            			<input type="checkbox" class="ace" id="ethylisme" name=""/>
            			<span class="lbl"> &nbsp; &nbsp;ethylisme</span>
        		</label>
	</div>
	<br>
	<div>
		<label for="dateatcd"><strong>Date :</strong></label>
		<input type="text" name="dateAntcd" class="form-control date-picker" id="dateAntcd"  data-date-format="yyyy-mm-dd" data-provide="datepicker" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required />
	</div>
	<br><br>
	<div>
		<label for="description"><strong>Description :</strong></label><br>
		<textarea class="form-control" id="description" name="description" required></textarea>
	</div>
	<div class="space-12"></div>
	<div style="text-align: center;">
		<button type="button" class="btn btn-primary btn-xs"  onclick="ajaxfunc({{$patient->id}});" style="width:40%;" id="AddANTCD">
		<i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>
			<span class="bigger-120">Ajouter</span> 
		</button>
		<div class="space-12"></div>
	</div>
      </form>
</div>{{-- widget-main --}}

</div>
<div class="space-12"></div>