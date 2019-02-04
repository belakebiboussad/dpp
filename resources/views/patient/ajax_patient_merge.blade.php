<tr>
	<td align="center"><strong>nom</strong></td>
           <td><input type="text" id ="Nom" value=" {{ $patient1->Nom }}"/></td>
           <td><input  type="radio" name="choixNom" onclick="setField('Nom', '{{ $patient1->Nom }}');" checked>{{ $patient1->Nom }}</td>
           <td><input type="radio" name="choixNom" onclick="setField('Nom','{{ $patient2->Nom }}');">{{ $patient2->Nom }}</td>
</tr>
<tr>
	<td align="center"><strong>prenom</strong></td>
           <td><input type="text" id ="Prenom" value=" {{ $patient1->Prenom }}"/></td>
           <td><input  type="radio" name="choixPrenom" onclick="setField('Prenom', '{{ $patient1->Prenom }}');" checked>{{ $patient1->Prenom }}</td>
           <td><input type="radio" name="choixPrenom" onclick="setField('Prenom','{{ $patient2->Prenom }}');">{{ $patient2->Prenom }}</td>
</tr>
<tr>
	<td align="center"><strong>code</strong></td>
           <td><input type="text" id ="code_barre" value=" {{ $patient1->code_barre }}"/></td>
           <td><input  type="radio" name="choixcode_barre" onclick="setField('code_barre', '{{ $patient1->code_barre }}');" checked>{{ $patient1->code_barre }}</td>
           <td><input type="radio" name="choixcode_barre" onclick="setField('code_barre','{{ $patient2->code_barre }}');">{{ $patient2->code_barre }}</td>
</tr>
<tr>
	<td align="center"><strong>Né(e) le</strong></td>
           <td><input type="text" id ="Dat_Naissance" value=" {{ $patient1->Dat_Naissance }}"/></td>
           <td><input  type="radio" name="choixDat_Naissance" onclick="setField('Dat_Naissance', '{{ $patient1->Dat_Naissance }}');" checked>{{ $patient1->Dat_Naissance }}</td>
           <td><input type="radio" name="choixDat_Naissance" onclick="setField('Dat_Naissance','{{ $patient2->Dat_Naissance }}');">{{ $patient2->Dat_Naissance }}</td>
</tr>
<tr>
	<td align="center"><strong>à</strong></td>
           <td><input type="text" id ="Lieu_Naissance" value=" {{ $patient1->Lieu_Naissance }}"/></td>
           <td><input  type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance', '{{ $patient1->Lieu_Naissance }}');" checked>{{ $patient1->Lieu_Naissance }}</td>
           <td><input type="radio" name="choixLieu_Naissance" onclick="setField('Lieu_Naissance','{{ $patient2->Lieu_Naissance }}');">{{ $patient2->Lieu_Naissance }}</td>
</tr>
<tr>
	<td align="center"><strong>Sexe</strong></td>
	<td>
		<select  id ="Lieu_Naissance">
			<option value="">Select</option>
			<option value="M" @if($patient1->Sexe =="M")  selected @endif>Masculin</option>
			<option value="F" @if($patient1->Sexe =="F")  selected @endif >Féminin</option>
		</select>
	</td>
           {{-- <td>
           	<select  id ="Lieu_Naissance">
			 @if( $patient->group_sang =="A") selected @endif
			
			<option value="F" @if({{ $patient1->Sexe ==="F" }}) selected @endif>Féminin</option>
		</select>

           </td> --}}
           <td><input  type="radio" name="choixSexe" onclick="setField('Sexe', '{{ $patient1->Sexe }}');" checked>{{ $patient1->Sexe }}</td>
           <td><input type="radio" name="choixSexe" onclick="setField('Sexe','{{ $patient2->Sexe }}');">{{ $patient2->Sexe }}</td>
</tr>