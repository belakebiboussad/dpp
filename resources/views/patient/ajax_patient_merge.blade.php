<table>
	<tr>
		<td>&nbsp;&nbsp;<strong>Afficher les Champs:</strong></td>
		<th>&nbsp;&nbsp;<label for=""><input onclick="$('tr.duplicate').toggle();" type="checkbox" checked>&nbsp;&nbsp; avec valeurs identiques<strong>({{$counts['duplicate']}} valeurs) &nbsp;&nbsp;</strong></label></th>
		<th><label for=""><input onclick="$('tr.unique').toggle();" type="checkbox" checked>&nbsp;&nbsp; avec valeurs uniques <strong>({{$counts['unique']}} valeurs) </label></th>
	</tr>
</table>
<input type="hidden" name="patient1_id" value="{{ $patient1->id}}">
<input type="hidden" name="patient2_id" value="{{ $patient2->id}}">
<table id ="PatiensMerge" class="table table-striped table-bordered merger">

 	<thead>
		<th class="category narrow"></th>
	      	<th>Résultat</th>
	      	<th>Patient1 <q><mark>{{ $patient1->Nom }}-{{ $patient1->Prenom}}</mark></q></th>
	      	<th>Patient2	<q><mark>{{ $patient2->Nom }}-{{ $patient2->Prenom}}</mark></q></th>
	</thead>
	<tbody id="mergepatients">		
		<tr class="{{ $statuses['Nom'] }}">
			<td align="center"><strong>nom</strong></td>
		           <td><input type="text" id ="Nom" name="nom" value=" {{ $patientResult->Nom }}"/></td>
		           <td><input  type="radio" name="choixNom" onclick="setField('Nom', '{{ $patient1->Nom }}');" checked>{{ $patient1->Nom }}</td>
		           <td><input type="radio" name="choixNom" onclick="setField('Nom','{{ $patient2->Nom }}');">{{ $patient2->Nom }}</td>
		</tr>
		
		<tr class="{{ $statuses['Prenom'] }}">
		         <td align="center"><strong>prenom</strong></td>
		           <td><input type="text" id ="Prenom" name="prenom" value=" {{ $patientResult->Prenom }}"/></td>
		           <td><input  type="radio" name="choixPrenom" onclick="setField('Prenom', '{{ $patient1->Prenom }}');" checked>{{ $patient1->Prenom }}</td>
		           <td><input type="radio" name="choixPrenom" onclick="setField('Prenom','{{ $patient2->Prenom }}');">{{ $patient2->Prenom }}</td>
		</tr>	
		<tr class="{{ $statuses['IPP'] }}">
			<td align="center"><strong>IPP</strong></td>
		      <td><input type="text" id ="code_barre" name="code" value=" {{ $patientResult->IPP }}"/></td>
		       <td><input  type="radio" name="choixcode_barre" onclick="setField('code_barre', '{{ $patient1->IPP }}');" checked>{{ $patient1->IPP }}</td>
		      <td><input type="radio" name="choixcode_barre" onclick="setField('code_barre','{{ $patient2->IPP }}');">{{ $patient2->IPP }}</td>
		</tr>
		<tr class="{{ $statuses['Dat_Naissance'] }}">
			<td align="center"><strong>Né(e) le</strong></td>
		      <td><input type="text" id ="Dat_Naissance" name="datenaissance" value=" {{ $patientResult->Dat_Naissance }}"/></td>
		       <td><input  type="radio" name="choixDat_Naissance" onclick="setField('Dat_Naissance', '{{ $patient1->Dat_Naissance }}');" checked>{{ $patient1->Dat_Naissance }}</td>
		      <td><input type="radio" name="choixDat_Naissance" onclick="setField('Dat_Naissance','{{ $patient2->Dat_Naissance }}');">{{ $patient2->Dat_Naissance }}</td>
		</tr>
		<tr class="{{ $statuses['Lieu_Naissance'] }}">
			<td align="center"><strong>à</strong></td>
		           <td><input type="text" id ="Lieu_Naissance" name="lieunaissance" value=" {{ $patientResult->Lieu_Naissance }}"/></td>
		           <td><input  type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance', '{{ $patient1->Lieu_Naissance }}');" checked>{{ $patient1->lieuNaissance->nom_commune }}</td>
		           <td><input type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance','{{ $patient2->Lieu_Naissance }}');">{{ $patient2->lieuNaissance->nom_commune }}</td>
		</tr>
		<tr class="{{ $statuses['Sexe'] }}">
			<td align="center"><strong>Sexe</strong></td>
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
		<tr class="{{ $statuses['situation_familiale'] }}">
			<td align="center"><strong>Civilité</strong></td>
			<td>
				<select  id ="situation_familiale" name="sf">
					<option value="">------</option>
					<option value="celibataire" @if($patientResult->situation_familiale =="celibataire")  selected @endif>Célibataire(e)</option>
					<option value="marie" @if($patient1->situation_familiale =="marie")  selected @endif>Marié(e)</option>
					<option value="divorce" @if($patient1->situation_familiale =="divorce")  selected @endif>Divorcé(e)</option>
					<option value="veuf" @if($patient1->situation_familiale =="veuf")  selected @endif>Veuf(veuve)</option>
				</select>
			</td>
		           <td><input  type="radio" name="choixCivilite" onclick="setField('situation_familiale', '{{ $patient1->situation_familiale }}');" checked>{{ $patientResult->situation_familiale }}</td>
		           <td><input type="radio" name="choixCivilite" onclick="setField('situation_familiale','{{ $patient2->situation_familiale }}');">{{ $patient2->situation_familiale }}</td>
		</tr>
		<tr class="{{ $statuses['Adresse'] }}">
			<td align="center"><strong>Adresse</strong></td>
			<td><input type="text" id ="Adresse" name="adresse" value=" {{ $patientResult->Adresse }}"/>	</td>
		           <td><input  type="radio" name="choixAdresse" onclick="setField('Adresse', '{{ $patient1->Adresse }}');" checked>{{ $patient1->Adresse }}</td>
		           <td><input type="radio" name="choixAdresse" onclick="setField('Adresse','{{ $patient2->Adresse }}');">{{ $patient2->Adresse }}</td>
		</tr>
		<tr class="{{ $statuses['tele_mobile1'] }}">
			<td align="center"><strong>Mob1</strong></td>
			<td><input type="text" id ="tele_mobile1" name="mobile1" value=" {{ $patientResult->tele_mobile1 }}"/>	</td>
		           <td><input  type="radio" name="choixtele_mobile1" onclick="setField('tele_mobile1', '{{ $patient1->tele_mobile1 }}');" checked>{{ $patient1->tele_mobile1 }}</td>
		           <td><input type="radio" name="choixtele_mobile1" onclick="setField('tele_mobile1','{{ $patient2->tele_mobile1 }}');">{{ $patient2->tele_mobile1 }}</td>
		</tr>
		<tr class="{{ $statuses['tele_mobile2'] }}">
			<td align="center"><strong>Mobile2</strong></td>
			<td><input type="text" id ="tele_mobile2" name="" value=" {{ $patientResult->tele_mobile2 }}"/>	</td>
		       <td>
		     		@if($patient1->tele_mobile2  != "" )
		           	<input  type="radio" name="choixtele_mobile2" onclick="setField('tele_mobile2', '{{ $patient1->tele_mobile2 }}');" checked>{{ $patient1->tele_mobile2 }}
		           	@endif
		       </td>
		       <td>
		           	   	@if($patient2->tele_mobile2  != "" )
		           		<input type="radio" name="choixtele_mobile2" onclick="setField('tele_mobile2','{{ $patient2->tele_mobile2 }}');">{{ $patient2->tele_mobile2 }}</td>
		           		@endif
		</tr>
		<tr class="{{ $statuses['NSS'] }}">
			<td align="center"><strong>N° Sec Soc</strong></td>
			<td><input type="text" id ="NSS" name="NSS" value=" {{ $patientResult->NSS }}"/>	</td>
		           <td><input  type="radio" name="choixNSS" onclick="setField('NSS', '{{ $patient1->NSS }}');" checked>{{ $patient1->NSS }}</td>
		           <td><input type="radio" name="choixNSS" onclick="setField('NSS','{{ $patient2->NSS }}');">{{ $patient2->NSS }}</td>
		</tr>
		<tr class="{{ $statuses['group_sang'] }}">
			<td align="center"><strong>Groupe Sanguin</strong></td>
			<td><input type="text" id ="group_sang" name="gs" value=" {{ $patientResult->group_sang }}"/>	</td>
		           <td><input  type="radio" name="choixgroup_sang" onclick="setField('group_sang', '{{ $patient1->group_sang }}');" checked>{{ $patient1->group_sang }}</td>
		           <td><input type="radio" name="choixgroup_sang" onclick="setField('group_sang','{{ $patient2->group_sang }}');">{{ $patient2->group_sang }}</td>
		</tr>
		<tr class="{{ $statuses['rhesus'] }}">
			<td align="center"><strong>Rihesus</strong></td>
			<td><input type="text" id ="Rihesus" name="rh" value=" {{ $patientResult->rhesus }}"/>	</td>
		           <td><input  type="radio" name="choixRihesus" onclick="setField('Rihesus', '{{ $patient1->rhesus }}');" checked>{{ $patient1->rhesus }}</td>
		           <td><input type="radio" name="choixRihesus" onclick="setField('Rihesus','{{ $patient2->rhesus }}');">{{ $patient2->rhesus }}</td>
		</tr>
		<tr class="{{ $statuses['Type'] }}">
			<td align="center"><strong>Type</strong></td>
			<td><input type="text" id ="Type" name="type" value=" {{ $patientResult->Type }}"/>	</td>
		           <td><input  type="radio" name="choixType" onclick="setField('Type', '{{ $patient1->Type }}');" checked>{{ $patient1->Type }}</td>
		           <td><input type="radio" name="choixType" onclick="setField('Type','{{ $patient2->Type }}');">{{ $patient2->Type }}</td>
		</tr>
		@if(($patient1->Type == "Ayant_droit") || ($patient2->Type == "Ayant_droit")  )
		<tr class="{{ $statuses['Type_p'] }}">
			<td align="center"><strong>Relation</strong></td>
			<td><input type="text" id ="Type_p" name="Type_p" value=" {{ $patientResult->Type_p }}"/>	</td>
		       <td>
		       @if($patient1->Type == "Ayant_droit" )
		       	<input  type="radio" name="choixType_p" onclick="setField('Type_p', '{{ $patient1->Type_p }}');" checked>{{ $patient1->Type_p }}
		       @endif
		       </td>
		       <td>
		       @if($patient2->Type == "Ayant_droit" )
		       <input type="radio" name="choixType_p" onclick="setField('Type_p','{{ $patient2->Type_p }}');">{{ $patient2->Type_p }}
		       @endif
		       </td>
		</tr>
		@endif
		<tr class="{{ $statuses['description'] }}">
			<td align="center"><strong>Description</strong></td>
			<td><input type="text" id ="description" name="description" value=" {{ $patientResult->description }}"/>	</td>
		           <td><input  type="radio" name="choixdescription" onclick="setField('description', '{{ $patient1->description }}');" checked>{{ $patient1->description }}</td>
		           <td><input type="radio" name="choixdescription" onclick="setField('description','{{ $patient2->description }}');">{{ $patient2->description }}</td>
		</tr>
		<tr class="{{ $statuses['Date_creation'] }}">
			<td align="center"><strong>Date Création</strong></td>
			<td><input type="text" id ="Date_creation" name="date" value=" {{ $patientResult->Date_creation }}"/>	</td>
		           <td><input  type="radio" name="choixDate_creation" onclick="setField('Date_creation', '{{ $patient1->Date_creation }}');" checked>{{ $patient1->Date_creation }}</td>
		           <td><input type="radio" name="choixDate_creation" onclick="setField('Date_creation','{{ $patient2->Date_creation }}');">{{ $patient2->Date_creation }}</td>
		</tr>
		
	</tbody>
</table>