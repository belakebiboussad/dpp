<!-- <table>
	<tr>
		<td>Afficher les Champs :</td>
		<td>
      <label><input onclick="$('tr.duplicate').toggle();" type="checkbox" checked> avec valeurs identiques ({{$counts['duplicate']}} valeurs) </label>
    </td>
		<td>
      <label><input onclick="$('tr.unique').toggle();" type="checkbox" checked>&nbsp;&nbsp; avec valeurs uniques ({{$counts['unique']}} valeurs) </label>
    </td>
	</tr><div class="col-sm-8 input-group">
</table> -->
<div class="form-group">
  <label class="coltrol-label">Afficher les Champs</label>
  <div class="input-group">
    <label class="inline">
      <input type="checkbox" class="ace" onclick="$('tr.duplicate').toggle();" checked/>
      <span class="lbl"> avec valeurs identiques ({{$counts['duplicate']}})</span>
    </label>
    <label class="inline">
      <input type="checkbox" class="ace" onclick="$('tr.unique').toggle();" checked/>
      <span class="lbl"> avec valeurs uniques ({{$counts['unique']}})</span>
    </label>
  </div> 
</div>
<input type="hidden" name="patient1_id" value="{{ $patient1->id}}">
<input type="hidden" name="patient2_id" value="{{ $patient2->id}}">
<table id ="PatiensMerge" class="table table-striped table-bordered merger">
 	<thead>
		<th class="category narrow"></th>
    	<th>Résultat</th>
    	<th>Patient1 &quot;<mark>{{ $patient1->Nom }}-{{ $patient1->Prenom}}</mark><&quot;</th>
    	<th>Patient2 &quot;<mark>{{ $patient2->Nom }}-{{ $patient2->Prenom}}</mark>&quot;</th>
	</thead>
	<tbody id="mergepatients">		
		<tr class="{{ $statuses['Nom'] }}">
			<td align="center"><b>nom</b></td>
		  <td><input type="text" id ="Nom" name="nom" value=" {{ $patientResult->Nom }}"/></td>
		  <td><input  type="radio" name="choixNom" onclick="setField('Nom', '{{ $patient1->Nom }}');" checked>{{ $patient1->Nom }}</td>
		  <td><input type="radio" name="choixNom" onclick="setField('Nom','{{ $patient2->Nom }}');">{{ $patient2->Nom }}</td>
		</tr>
		<tr class="{{ $statuses['Prenom'] }}">
		  <td align="center"><b>prenom</b></td>
		  <td><input type="text" id ="Prenom" name="prenom" value=" {{ $patientResult->Prenom }}"/></td>
		  <td><input  type="radio" name="choixPrenom" onclick="setField('Prenom', '{{ $patient1->Prenom }}');" checked>{{ $patient1->Prenom }}</td>
		  <td><input type="radio" name="choixPrenom" onclick="setField('Prenom','{{ $patient2->Prenom }}');">{{ $patient2->Prenom }}</td>
		</tr>	
		<tr class="{{ $statuses['IPP'] }}">
			<td align="center"><b>IPP</b></td>
		  <td><input type="text" id ="code_barre" name="code" value=" {{ $patientResult->IPP }}"/></td>
		  <td><input  type="radio" name="choixcode_barre" onclick="setField('code_barre', '{{ $patient1->IPP }}');" checked>{{ $patient1->IPP }}</td>
		  <td><input type="radio" name="choixcode_barre" onclick="setField('code_barre','{{ $patient2->IPP }}');">{{ $patient2->IPP }}</td>
		</tr>
		<tr class="{{ $statuses['dob'] }}">
			<td align="center"><b>Né(e) le</b></td>
		      <td><input type="text" id ="Dat_Naissance" name="datenaissance" value=" {{ $patientResult->sob }}"/></td>
		       <td><input  type="radio" name="choixDat_Naissance" onclick="setField('Dat_Naissance', '{{ $patient1->dob }}');" checked>{{ $patient1->dob->format('Y-m-d') }}</td>
		      <td><input type="radio" name="choixDat_Naissance" onclick="setField('Dat_Naissance','{{ $patient2->dob }}');">{{ $patient2->dob->format('Y-m-d') }}</td>
		</tr>
		<tr class="{{ $statuses['pob'] }}">
			<td align="center"><b>à</b></td>
      <td><input type="text" id ="Lieu_Naissance" name="lieunaissance" value=" {{ $patientResult->pob }}"/></td>
      <td>
       	@if(isset($patient1->pob))
       	<input  type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance', '{{ $patient1->pob }}');" checked>
       	{{ $patient1->POB->name }}
       	@else
       	<input  type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance', '');" checked>
       	@endif
     	</td>
      <td>
       	@if(isset($patient2->pob))
     	  	<input type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance','{{ $patient2->pob }}');">
     	  	{{ $patient2->POB->name }}
     	  @else
     	   <input type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance','');">
     	  @endif
     	</td>
		</tr>
		<tr class="{{ $statuses['Sexe'] }}">
			<td align="center"><b>Sexe</b></td>
			<td>
				<select  id ="sexe" name="sexe">
					<option value="">------<</option>
					<option value="M" @if($patientResult->Sexe =="M")  selected @endif>Masculin</option>
					<option value="F" @if($patientResult->Sexe =="F")  selected @endif >Féminin</option>
				</select>
			</td>
		           <td><input  type="radio" name="choixSexe" onclick="setField('Sexe', '{{ $patient1->Sexe }}');" checked>{{ $patient1->Sexe }}</td>
		           <td><input type="radio" name="choixSexe" onclick="setField('Sexe','{{ $patient2->Sexe }}');">{{ $patient2->Sexe }}</td>
		</tr>
		<tr class="{{ $statuses['sf'] }}">
			<td align="center"><b>Civilité</b></td>
			<td>
				<select  id ="situation_familiale" name="sf">
					<option value="">------</option>
					<option value="celibataire" @if($patientResult->sf =="celibataire")  selected @endif>Célibataire(e)</option>
					<option value="marie" @if($patient1->sf =="marie")  selected @endif>Marié(e)</option>
					<option value="divorce" @if($patient1->sf =="divorce")  selected @endif>Divorcé(e)</option>
					<option value="veuf" @if($patient1->sf =="veuf")  selected @endif>Veuf(veuve)</option>
				</select>
			</td>
		           <td><input  type="radio" name="choixCivilite" onclick="setField('situation_familiale', '{{ $patient1->sf }}');" checked>{{ $patientResult->sf }}</td>
		           <td><input type="radio" name="choixCivilite" onclick="setField('situation_familiale','{{ $patient2->sf }}');">{{ $patient2->sf }}</td>
		</tr>
		<tr class="{{ $statuses['Adresse'] }}">
			<td align="center"><b>Adresse</b></td>
			<td><input type="text" id ="Adresse" name="adresse" value=" {{ $patientResult->Adresse }}"/>	</td>
		           <td><input  type="radio" name="choixAdresse" onclick="setField('Adresse', '{{ $patient1->Adresse }}');" checked>{{ $patient1->Adresse }}</td>
		           <td><input type="radio" name="choixAdresse" onclick="setField('Adresse','{{ $patient2->Adresse }}');">{{ $patient2->Adresse }}</td>
		</tr>
		<tr class="{{ $statuses['mob'] }}">
			<td align="center"><b>Mob1</b></td>
			<td><input type="text" id ="tele_mobile1" name="mobile1" value=" {{ $patientResult->mob }}"/>	</td>
		           <td><input  type="radio" name="choixtele_mobile1" onclick="setField('tele_mobile1', '{{ $patient1->mob }}');" checked>{{ $patient1->mob }}</td>
		           <td><input type="radio" name="choixtele_mobile1" onclick="setField('tele_mobile1','{{ $patient2->mob }}');">{{ $patient2->mob }}</td>
		</tr>
		<tr class="{{ $statuses['mob2'] }}">
			<td align="center"><b>Mobile2</b></td>
			<td><input type="text" id ="tele_mobile2" value="{{ $patientResult->mob2 }}"/></td>
		  <td>
		  @if($patient1->mob2  != "" )
		  <input type="radio" name="choixtele_mobile2" onclick="setField('mob2', '{{patient1->mob2 }}');" checked>{{ $patient1->mob2 }}
		  @endif
		  </td>
		  <td>
     	@if($patient2->mob2  != "" )
     		<input type="radio" name="choixtele_mobile2" onclick="setField('tele_mobile2','{{ $patient2->mob2 }}');">{{ $patient2->mob2 }}</td>
     		@endif
		</tr>
		<tr class="{{ $statuses['NSS'] }}">
			<td align="center"><b>N° Sec Soc</b></td>
			<td><input type="text" id ="NSS" name="NSS" value=" {{ $patientResult->NSS }}"/>	</td>
		           <td><input  type="radio" name="choixNSS" onclick="setField('NSS', '{{ $patient1->NSS }}');" checked>{{ $patient1->NSS }}</td>
		           <td><input type="radio" name="choixNSS" onclick="setField('NSS','{{ $patient2->NSS }}');">{{ $patient2->NSS }}</td>
		</tr>
		<tr class="{{ $statuses['gs'] }}">
			<td align="center"><b>Groupe Sanguin</b></td>
			<td><input type="text" id ="group_sang" name="gs" value=" {{ $patientResult->gs }}"/>	</td>
		           <td><input  type="radio" name="choixgroup_sang" onclick="setField('group_sang', '{{ $patient1->gs }}');" checked>{{ $patient1->gs }}</td>
		           <td><input type="radio" name="choixgroup_sang" onclick="setField('group_sang','{{ $patient2->gs }}');">{{ $patient2->gs }}</td>
		</tr>
		<tr class="{{ $statuses['rh'] }}">
			<td align="center"><b>Rihesus</b></td>
			<td><input type="text" id ="Rihesus" name="rh" value=" {{ $patientResult->rh }}"/>	</td>
		           <td><input  type="radio" name="choixRihesus" onclick="setField('Rihesus', '{{ $patient1->rh }}');" checked>{{ $patient1->rh }}</td>
		           <td><input type="radio" name="choixRihesus" onclick="setField('Rihesus','{{ $patient2->rh }}');">{{ $patient2->rh }}</td>
		</tr>
		<tr class="{{ $statuses['Type'] }}">
			<td align="center"><b>Type</b></td>
			<td><input type="text" id ="Type" name="type" value=" {{ $patientResult->Type }}"/>	</td>
		           <td><input  type="radio" name="choixType" onclick="setField('Type', '{{ $patient1->Type }}');" checked>{{ $patient1->Type }}</td>
		           <td><input type="radio" name="choixType" onclick="setField('Type','{{ $patient2->Type }}');">{{ $patient2->Type }}</td>
		</tr>
		<tr class="{{ $statuses['description'] }}">
			<td align="center"><b>Description</b></td>
			<td><input type="text" id ="description" name="description" value=" {{ $patientResult->description }}"/>	</td>
		           <td><input  type="radio" name="choixdescription" onclick="setField('description', '{{ $patient1->description }}');" checked>{{ $patient1->description }}</td>
		           <td><input type="radio" name="choixdescription" onclick="setField('description','{{ $patient2->description }}');">{{ $patient2->description }}</td>
		</tr>
	{{-- 	<tr class="{{ $statuses['created_at'] }}">
			<td align="center"><b>Date Création</b></td>
			<td><input type="text" id ="created_at" name="date" value=" {{ $patientResult->created_at }}"/>	</td>
		           <td><input  type="radio" name="choixDate_creation" onclick="setField('created_at', '{{ $patient1->created_at }}');" checked>{{ $patient1->created_at }}</td>
		           <td><input type="radio" name="choixDate_creation" onclick="setField('created_at','{{ $patient2->created_at }}');">{{ $patient2->created_at }}</td>
		</tr> --}}
		
	</tbody>
</table>