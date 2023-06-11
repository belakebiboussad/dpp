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
<input type="hidden" name="pid1" value="{{ $patient1->id}}">
<input type="hidden" name="pid2" value="{{ $patient2->id}}">
<table id ="PatiensMerge" class="table table-striped table-bordered merger">
  <thead>
    <th class="category narrow"></th>
      <th>Résultat</th>
      <th>Patient1 <q><mark>{{ $patient1->Nom }}-{{ $patient1->Prenom}}</mark></q></th>
      <th>Patient2  <q><mark>{{ $patient2->Nom }}-{{ $patient2->Prenom}}</mark></q></th>
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
      <td><input type="text" id ="dob" name="dob" value="{{$patientResult->sob }}"/></td>
      <td><input  type="radio" name="choixDob" onclick="setField('dob', '{{ $patient1->dob }}');" checked>{{ $patient1->dob->format('Y-m-d') }}</td>
      <td><input type="radio" name="choixDob" onclick="setField('dob','{{ $patient2->dob }}');">{{ $patient2->dob->format('Y-m-d') }}</td>
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
  </tbody>
</table>