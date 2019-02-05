<table>
	<tr>
		<td>&nbsp;&nbsp;<strong>Afficher les Champs:</strong></td>
		<th>&nbsp;&nbsp;<label for=""><input onclick="$('tr.duplicate').toggle();" type="checkbox">&nbsp;&nbsp; avec valeurs identiques<strong>({{$counts['duplicate']}} valeurs)</strong></label></th>
		<th><label for=""><input onclick="$('tr.unique').toggle();" type="checkbox">&nbsp;&nbsp; avec valeurs uniques <strong>({{$counts['unique']}} valeurs) </label></th>
	</tr>
</table>
<table id ="PatiensMerge" class="table table-striped table-bordered merger">
 	<thead>
		<th class="category narrow"></th>
	      	<th>Résultat</th>
	      	<th>Patient1 <q><mark>{{ $patient1->Nom }}-{{ $patient1->Prenom}}</mark></q></th>
	      	<th>Patient2	<q><mark>{{ $patient2->Nom }}-{{ $patient2->Prenom}}</mark></q></th>
	</thead>
	<tbody id="mergepatients">		
		<tr @if($patient1->Nom !== $patient2->Nom) class="multiple" @else class="duplicate" hidden @endif>
			<td align="center"><strong>nom</strong></td>
		           <td><input type="text" id ="Nom" name="nom" value=" {{ $patient1->Nom }}"/></td>
		           <td><input  type="radio" name="choixNom" onclick="setField('Nom', '{{ $patient1->Nom }}');" checked>{{ $patient1->Nom }}</td>
		           <td><input type="radio" name="choixNom" onclick="setField('Nom','{{ $patient2->Nom }}');">{{ $patient2->Nom }}</td>
		</tr>
		
		<tr @if($patient1->Prenom !== $patient2->Prenom) class="multiple" @else class="duplicate" hidden @endif>
			<td align="center"><strong>prenom</strong></td>
		           <td><input type="text" id ="Prenom" name="prenom" value=" {{ $patient1->Prenom }}"/></td>
		           <td><input  type="radio" name="choixPrenom" onclick="setField('Prenom', '{{ $patient1->Prenom }}');" checked>{{ $patient1->Prenom }}</td>
		           <td><input type="radio" name="choixPrenom" onclick="setField('Prenom','{{ $patient2->Prenom }}');">{{ $patient2->Prenom }}</td>
		</tr>	
		<tr @if($patient1->code_barre !== $patient2->code_barre) class="multiple" class="duplicate" hidden @endif>
			<td align="center"><strong>code</strong></td>
		           <td><input type="text" id ="code_barre" name="code" value=" {{ $patient1->code_barre }}"/></td>
		           <td><input  type="radio" name="choixcode_barre" onclick="setField('code_barre', '{{ $patient1->code_barre }}');" checked>{{ $patient1->code_barre }}</td>
		           <td><input type="radio" name="choixcode_barre" onclick="setField('code_barre','{{ $patient2->code_barre }}');">{{ $patient2->code_barre }}</td>
		</tr>
		<tr @if($patient1->Dat_Naissance !== $patient2->Dat_Naissance) class="multiple" @else class="duplicate" hidden @endif>
			<td align="center"><strong>Né(e) le</strong></td>
		           <td><input type="text" id ="Dat_Naissance" name="datenaissance" value=" {{ $patient1->Dat_Naissance }}"/></td>
		           <td><input  type="radio" name="choixDat_Naissance" onclick="setField('Dat_Naissance', '{{ $patient1->Dat_Naissance }}');" checked>{{ $patient1->Dat_Naissance }}</td>
		           <td><input type="radio" name="choixDat_Naissance" onclick="setField('Dat_Naissance','{{ $patient2->Dat_Naissance }}');">{{ $patient2->Dat_Naissance }}</td>
		</tr>
		<tr @if($patient1->Lieu_Naissance != $patient2->Lieu_Naissance) class="multiple" @else class="duplicate" hidden @endif>
			<td align="center"><strong>à</strong></td>
		           <td><input type="text" id ="Lieu_Naissance" name="lieunaissance" value=" {{ $patient1->Lieu_Naissance }}"/></td>
		           <td><input  type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance', '{{ $patient1->Lieu_Naissance }}');" checked>{{ $patient1->Lieu_Naissance }}</td>
		           <td><input type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance','{{ $patient2->Lieu_Naissance }}');">{{ $patient2->Lieu_Naissance }}</td>
		</tr>
		{{-- situation_familiale	 --}}
		
		<tr @if($patient1->Sexe != $patient2->Sexe) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Sexe</strong></td>
			<td>
				<select  id ="sexe" name="sexe">
					<option value="">------<</option>
					<option value="M" @if($patient1->Sexe =="M")  selected @endif>Masculin</option>
					<option value="F" @if($patient1->Sexe =="F")  selected @endif >Féminin</option>
				</select>
			</td>
		           <td><input  type="radio" name="choixSexe" onclick="setField('Sexe', '{{ $patient1->Sexe }}');" checked>{{ $patient1->Sexe }}</td>
		           <td><input type="radio" name="choixSexe" onclick="setField('Sexe','{{ $patient2->Sexe }}');">{{ $patient2->Sexe }}</td>
		</tr>
		<tr @if($patient1->situation_familiale != $patient2->situation_familiale) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Civilité</strong></td>
			<td>
				<select  id ="situation_familiale" name="sf">
					<option value="">------</option>
					<option value="celibataire" @if($patient1->situation_familiale =="celibataire")  selected @endif>Célibataire(e)</option>
					<option value="marie" @if($patient1->situation_familiale =="marie")  selected @endif>Marié(e)</option>
					<option value="divorce" @if($patient1->situation_familiale =="divorce")  selected @endif>Divorcé(e)</option>
					<option value="veuf" @if($patient1->situation_familiale =="veuf")  selected @endif>Veuf(veuve)</option>
				</select>
			</td>
		           <td><input  type="radio" name="choixCivilite" onclick="setField('situation_familiale', '{{ $patient1->situation_familiale }}');" checked>{{ $patient1->situation_familiale }}</td>
		           <td><input type="radio" name="choixCivilite" onclick="setField('situation_familiale','{{ $patient2->situation_familiale }}');">{{ $patient2->situation_familiale }}</td>
		</tr>
		<tr @if($patient1->Adresse != $patient2->Adresse) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Adresse</strong></td>
			<td><input type="text" id ="Adresse" name="adresse" value=" {{ $patient1->Adresse }}"/>	</td>
		           <td><input  type="radio" name="choixAdresse" onclick="setField('Adresse', '{{ $patient1->Adresse }}');" checked>{{ $patient1->Adresse }}</td>
		           <td><input type="radio" name="choixAdresse" onclick="setField('Adresse','{{ $patient2->Adresse }}');">{{ $patient2->Adresse }}</td>
		</tr>
		<tr @if($patient1->tele_mobile1 != $patient2->tele_mobile1) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Mob1</strong></td>
			<td><input type="text" id ="tele_mobile1" name="mobile1" value=" {{ $patient1->tele_mobile1 }}"/>	</td>
		           <td><input  type="radio" name="choixtele_mobile1" onclick="setField('tele_mobile1', '{{ $patient1->tele_mobile1 }}');" checked>{{ $patient1->tele_mobile1 }}</td>
		           <td><input type="radio" name="choixtele_mobile1" onclick="setField('tele_mobile1','{{ $patient2->tele_mobile1 }}');">{{ $patient2->tele_mobile1 }}</td>
		</tr>
		<tr @if($patient1->tele_mobile2 != $patient2->tele_mobile2) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Mobile2</strong></td>
			<td><input type="text" id ="tele_mobile2" name="" value=" {{ $patient1->tele_mobile2 }}"/>	</td>
		           <td><input  type="radio" name="choixtele_mobile2" onclick="setField('tele_mobile2', '{{ $patient1->tele_mobile2 }}');" checked>{{ $patient1->tele_mobile2 }}</td>
		           <td><input type="radio" name="choixtele_mobile2" onclick="setField('tele_mobile2','{{ $patient2->tele_mobile2 }}');">{{ $patient2->tele_mobile2 }}</td>
		</tr>
		<tr @if($patient1->NSS != $patient2->NSS) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>N° Sec Soc</strong></td>
			<td><input type="text" id ="NSS" name="mobile2" value=" {{ $patient1->NSS }}"/>	</td>
		           <td><input  type="radio" name="choixNSS" onclick="setField('NSS', '{{ $patient1->NSS }}');" checked>{{ $patient1->NSS }}</td>
		           <td><input type="radio" name="choixNSS" onclick="setField('NSS','{{ $patient2->NSS }}');">{{ $patient2->NSS }}</td>
		</tr>
		<tr @if($patient1->group_sang != $patient2->group_sang) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Groupe Sanguin</strong></td>
			<td><input type="text" id ="group_sang" name="gs" value=" {{ $patient1->group_sang }}"/>	</td>
		           <td><input  type="radio" name="choixgroup_sang" onclick="setField('group_sang', '{{ $patient1->group_sang }}');" checked>{{ $patient1->group_sang }}</td>
		           <td><input type="radio" name="choixgroup_sang" onclick="setField('group_sang','{{ $patient2->group_sang }}');">{{ $patient2->group_sang }}</td>
		</tr>
		<tr @if($patient1->rhesus != $patient2->rhesus) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Rihesus</strong></td>
			<td><input type="text" id ="Rihesus" name="rh" value=" {{ $patient1->rhesus }}"/>	</td>
		           <td><input  type="radio" name="choixRihesus" onclick="setField('Rihesus', '{{ $patient1->rhesus }}');" checked>{{ $patient1->rhesus }}</td>
		           <td><input type="radio" name="choixRihesus" onclick="setField('Rihesus','{{ $patient2->rhesus }}');">{{ $patient2->rhesus }}</td>
		</tr>
		<tr @if($patient1->Type != $patient2->Type) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Type</strong></td>
			<td><input type="text" id ="Type" name="type" value=" {{ $patient1->Type }}"/>	</td>
		           <td><input  type="radio" name="choixType" onclick="setField('Type', '{{ $patient1->Type }}');" checked>{{ $patient1->Type }}</td>
		           <td><input type="radio" name="choixType" onclick="setField('Type','{{ $patient2->Type }}');">{{ $patient2->Type }}</td>
		</tr>
		<tr @if($patient1->Date_creation != $patient2->Date_creation) class="multiple" @else  class="duplicate" hidden @endif>
			<td align="center"><strong>Date Création</strong></td>
			<td><input type="text" id ="Date_creation" name="date" value=" {{ $patient1->Date_creation }}"/>	</td>
		           <td><input  type="radio" name="choixDate_creation" onclick="setField('Date_creation', '{{ $patient1->Date_creation }}');" checked>{{ $patient1->Date_creation }}</td>
		           <td><input type="radio" name="choixDate_creation" onclick="setField('Date_creation','{{ $patient2->Date_creation }}');">{{ $patient2->Date_creation }}</td>
		</tr>
		
	</tbody>
</table>