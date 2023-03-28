@foreach(json_decode($specialite->consConst ,true) as $const)
<?php $nom = App\modeles\Constante::FindOrFail($const)->nom ?>
<?php $desc = App\modeles\Constante::FindOrFail($const)->description ?>
<?php $min = App\modeles\Constante::FindOrFail($const)->min ?>
<div class="form-group m-b-30">
  <label ><strong>{{ $desc }}</strong> :</label>
  <input type="text" name="{{ trim($nom) }}" class="irs-hidden-input col-sm-12 {{ $nom }}" tabindex="-1" value="{{ $min }}">
</div> 
@endforeach
<div class="form-group">
<label class="control-label" for="etatgen">Etat géneral du patient :</label>
  <textarea type="text" name="etat" placeholder= "Etat Géneral du patient..." class="form-control"></textarea>
</div>
<div class="form-group">
  <label class="control-label" for="peaupha">Peau et phanéres :</label>
  <textarea type="text" id="peaupha" name="peaupha" placeholder= "Peau et phanéres ..."   class="form-control"></textarea>
</div>
<div class="form-group">
  <label class="control-label" for="autre">Autre :</label>
    <textarea id="autre" name="autre" placeholder="..." class="form-control" min ="30" step="any"></textarea>
</div>        