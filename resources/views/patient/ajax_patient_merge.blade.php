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
  @foreach($patientResult->getFillable() as $key=>$field)
<tr class="{{ $statuses['Nom'] }}">
  <td align="center">{{ $field}}</td>
</tr>
  @endforeach
  </tbody>
  </table>
