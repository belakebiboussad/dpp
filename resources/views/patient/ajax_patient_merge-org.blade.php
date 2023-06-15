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
      <th>Patient1 <q><mark>{{ $patient1->full_name }}</mark></q></th>
      <th>Patient2 <q><mark>{{ $patient2->full_name }}</mark></q></th>
  </thead>
  <tbody id="mergepatients">  
    <tr class="{{ $statuses['Nom'] }}">
      <td align="center">nom</td>
      <td><input type="text" id ="nom" name="nom" value=" {{ $patientResult->Nom }}" class="form-control"/></td>
      <td><input  type="radio" name="choixNom" onclick="setField('nom', '{{ $patient1->Nom }}');" checked>{{ $patient1->Nom }}</td>
      <td><input type="radio" name="choixNom" onclick="setField('nom','{{ $patient2->Nom }}');">{{ $patient2->Nom }}</td>
    </tr>
    <tr class="{{ $statuses['Prenom'] }}">
      <td align="center">prenom</td>
      <td><input type="text" id ="prenom" name="prenom" value=" {{ $patientResult->Prenom }}"class="form-control"/></td>
      <td><input  type="radio" name="choixPrenom" onclick="setField('prenom', '{{ $patient1->Prenom }}');" checked>{{ $patient1->Prenom }}</td>
      <td><input type="radio" name="choixPrenom" onclick="setField('prenom','{{ $patient2->Prenom }}');">{{ $patient2->Prenom }}</td>
    </tr>
    <tr class="{{ $statuses['IPP'] }}">
      <td align="center">IPP</td>
      <td><input type="text" id ="code_barre" name="code" value=" {{ $patientResult->IPP }}" class="form-control"/></td>
      <td><input  type="radio" name="choixcode_barre" onclick="setField('code_barre', '{{ $patient1->IPP }}');" checked>{{ $patient1->IPP }}</td>
      <td><input type="radio" name="choixcode_barre" onclick="setField('code_barre','{{ $patient2->IPP }}');">{{ $patient2->IPP }}</td>
    </tr>
    <tr class="{{ $statuses['dob'] }}">
      <td align="center">Né(e) le</td>
      <td><input type="date" id ="dob" name="dob" value="{{ $patientResult->dob->format('Y-m-d')}}" class="form-control"/></td>
      <td><input  type="radio" name="choixDob" onclick="setField('dob', '{{ $patient1->dob }}');" checked>{{ $patient1->dob->format('Y-m-d') }}</td>
      <td><input type="radio" name="choixDob" onclick="setField('dob','{{ $patient2->dob }}');">{{ $patient2->dob->format('Y-m-d') }}</td>
    </tr>
     <tr class="{{ $statuses['pob'] }}">
      <td align="center">à</td>
  <td><input type="text" id ="pob" name="lieunaissance" value="{{ $patientResult->pob }}" class="form-control autoCommune1"/>
  </td>
  <td>
   <input  type="radio" name="choixPob" onclick="setField('pob', '{{(is_null($patient1->pob))?'':$patient1->POB->name}}');" checked>
    {{(is_null($patient1->pob))?'':$patient1->POB->name}}
  </td>
  <td>
    <input  type="radio" name="choixPob" onclick="setField('pob', '{{(is_null($patient2->pob))?'':$patient2->POB->name}}');">{{(is_null($patient2->pob))?'':$patient2->POB->name}}
  </td>
    </tr>
    <tr class="{{ $statuses['Sexe'] }}">
      <td align="center">Sexe</td>
      <td>
        <select  id ="sexe" name="sexe" class="form-control">
          <option value="">------</option>
          <option value="M" @if($patientResult->Sexe =="M")  selected @endif>Masculin</option>
          <option value="F" @if($patientResult->Sexe =="F")  selected @endif >Féminin</option>
        </select>
      </td>
      <td><input  type="radio" name="choixSexe" onclick="setField('Sexe', '{{ $patient1->Sexe }}');" checked>{{ $patient1->Sexe }}</td>
      <td><input type="radio" name="choixSexe" onclick="setField('Sexe','{{ $patient2->Sexe }}');">{{ $patient2->Sexe }}</td>
    </tr>
    <tr class="{{ $statuses['sf'] }}">
      <td align="center">Civilité</td>
      <td>
        <select id ="sf" name="sf" class="form-control">
          <option value="">------</option>
          <option value="C" @if($patientResult->sf =="C")  selected @endif>Célibataire(e)</option>
          <option value="M" @if($patientResult->sf =="marie")  selected @endif>Marié(e)</option>
          <option value="D" @if($patientResult->sf =="divorce")  selected @endif>Divorcé(e)</option>
          <option value="V" @if($patientResult->sf =="veuf")  selected @endif>Veuf(veuve)</option>
        </select>
      </td>
      <td><input  type="radio" name="choixCivilite" onclick="setField('sf', '{{ $patient1->sf }}');" checked>{{ $patientResult->sf }}</td>
     <td><input type="radio" name="choixCivilite" onclick="setField('sf','{{ $patient2->sf }}');">{{ $patient2->sf }}</td>
    </tr>
    <tr class="{{ $statuses['Adresse'] }}">
      <td align="center">Adresse</td>
      <td><input type="text" id ="adresse" name="adresse" value=" {{ $patientResult->Adresse }}" class="form-control"/></td>
      <td><input  type="radio" name="choixAdresse" onclick="setField('adresse', '{{ $patient1->Adresse }}');" checked>{{ $patient1->Adresse }}</td>
      <td><input type="radio" name="choixAdresse" onclick="setField('adresse','{{ $patient2->Adresse }}');">{{ $patient2->Adresse }}</td>
    </tr>
    <tr class="{{ $statuses['mob'] }}">
      <td align="center">Mobile1</td>
      <td><input type="text" id ="tele_mobile1" name="mobile1" value="{{ $patientResult->mob }}" class="form-control"/></td>
      <td><input  type="radio" name="choixtele_mobile1" onclick="setField('tele_mobile1', '{{ $patient1->mob }}');" checked>{{ $patient1->mob }}</td>
      <td><input type="radio" name="choixtele_mobile1" onclick="setField('tele_mobile1','{{ $patient2->mob }}');">{{ $patient2->mob }}</td>
    </tr>
    <tr class="{{ $statuses['mob2'] }}">
      <td align="center">Mobile2</td>
      <td><input type="text" id="tele_mobile2" value="{{ $patientResult->mob2 }}" class="form-control"/></td>
      <td>
        <input type="radio" name="choixtele_mobile2" onclick="setField('tele_mobile2', '{{$patient1->mob2 }}');" checked>{{ $patient1->mob2 }}
      </td>
      <td>
        <input type="radio" name="choixtele_mobile2" onclick="setField('tele_mobile2','{{ $patient2->mob2 }}');">{{ $patient2->mob2 }}</td>
      </tr>
      <tr class="{{ $statuses['NSS'] }}">
        <td align="center">NSS</td>
        <td><input type="text" id ="NSS" name="NSS" value=" {{ $patientResult->NSS }} "class="form-control"/> </td>
        <td><input  type="radio" name="choixNSS" onclick="setField('NSS', '{{ $patient1->NSS }}');" checked>{{ $patient1->NSS }}</td>
        <td><input type="radio" name="choixNSS" onclick="setField('NSS','{{ $patient2->NSS }}');">{{ $patient2->NSS }}</td>
      </tr>
        <tr class="{{ $statuses['gs'] }}">
      <td align="center"><b>Groupe Sanguin</b></td>
      <td><input type="text" id ="group_sang" name="gs" value=" {{ $patientResult->gs }}"/> </td>
               <td><input  type="radio" name="choixgroup_sang" onclick="setField('group_sang', '{{ $patient1->gs }}');" checked>{{ $patient1->gs }}</td>
               <td><input type="radio" name="choixgroup_sang" onclick="setField('group_sang','{{ $patient2->gs }}');">{{ $patient2->gs }}</td>
    </tr>
    <tr class="{{ $statuses['rh'] }}">
      <td align="center"><b>Rihesus</b></td>
      <td><input type="text" id ="Rihesus" name="rh" value=" {{ $patientResult->rh }}"/>  </td>
               <td><input  type="radio" name="choixRihesus" onclick="setField('Rihesus', '{{ $patient1->rh }}');" checked>{{ $patient1->rh }}</td>
               <td><input type="radio" name="choixRihesus" onclick="setField('Rihesus','{{ $patient2->rh }}');">{{ $patient2->rh }}</td>
    </tr>
    <tr class="{{ $statuses['type_id'] }}">
      <td align="center"><b>Type</b></td>
      <td><input type="text" id ="Type" name="type" value=" {{ $patientResult->type_id }}"/> </td>
      <td><input  type="radio" name="choixType" onclick="setField('Type', '{{ $patient1->type_id }}');" checked>{{ $patient1->type_id }}</td>
      <td><input type="radio" name="choixType" onclick="setField('Type','{{ $patient2->type_id }}');">{{ $patient2->type_id }}</td>
    </tr>
    <tr class="{{ $statuses['description'] }}">
      <td align="center"><b>Description</b></td>
      <td><input type="text" id ="description" name="description" value=" {{ $patientResult->description }}"/>  </td>
     <td><input  type="radio" name="choixdescription" onclick="setField('description', '{{ $patient1->description }}');" checked>{{ $patient1->description }}</td>
     <td><input type="radio" name="choixdescription" onclick="setField('description','{{ $patient2->description }}');">{{ $patient2->description }}</td>
    </tr>
{{--   <tr class="{{ $statuses['created_at'] }}">
<td align="center"><b>Date Création</b></td>
      <td><input type="text" id ="created_at" name="date" value=" {{ $patientResult->created_at }}"/> </td>
      <td><input  type="radio" name="choixDate_creation" onclick="setField('created_at', '{{ $patient1->created_at }}');" checked>{{ $patient1->created_at }}</td>
      <td><input type="radio" name="choixDate_creation" onclick="setField('created_at','{{ $patient2->created_at }}');">{{ $patient2->created_at }}</td>
    </tr>  --}}
  </tbody>
</table>