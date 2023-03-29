@foreach($specialite->Consts as $const)
 <div class="form-group row">
 <label >{{ $const->description }}</label>
 <input type="text" name="{{ $const->nom }}" class="irs-hidden-input col-sm-12 {{ $const->nom }}" tabindex="-1" value="{{ $const->min }}">
</div>

@endforeach
<div class="form-group row">
<label class="control-label" for="etatgen">Etat géneral du patient</label>
  <textarea type="text" name="etat" placeholder= "Etat Géneral du patient..." class="form-control"></textarea>
</div>
<div class="form-group row">
  <label class="control-label" for="peaupha">Peau et phanéres</label>
  <textarea type="text" id="peaupha" name="peaupha" placeholder= "Peau et phanéres ..."   class="form-control"></textarea>
</div>
<div class="form-group row">
  <label class="control-label" for="autre">Autre</label>
    <textarea id="autre" name="autre" placeholder="..." class="form-control" min ="30" step="any"></textarea>
</div>      