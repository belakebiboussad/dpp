<h3 class="section-heading">Générale</h3>
<div class="row"><div class="col-sm-12"><h4><u> Examens biologique</u></h4></div></div>
  <div class="row">@include('examenbio.bioExamList')</div>
<hr>
  <div class="row"><div class="col-sm-12"><h4><u>Examens Radiologique</u></h4></div></div>
  <div class="row">
    @foreach($examensImg as $exImg)
      <div class="col-xs-2">
        @if(isset($specExamsImg))
        <input name="exmsImg[]" type="checkbox" class="ace" value="{{ $exImg->id}}" {{ (in_array($exImg->id, $specExamsImg))? 'checked' : '' }}/>
        @else
        <input name="exmsImg[]" type="checkbox" class="ace" value="{{ $exImg->id}}"/>
        @endif   
        <span class="lbl">{{ $exImg->nom }} </span>
      </div>
    @endforeach
</div>
<hr>
<div class="row"><div class="col-sm-12"><h4><u>Vaccins</u></h4></div></div>
<div class="row">
  @foreach($vaccins as $vacc)
  <div class="col-xs-2">
    @if(isset($specvaccins))
    <input name="vaccs[]" type="checkbox" class="ace" value="{{ $vacc->id}}" {{ (in_array($vacc->id, $specvaccins))? 'checked' : '' }}/>
    @else
    <input name="vaccs[]" type="checkbox" class="ace" value="{{ $vacc->id}}"/>
    @endif
    <span class="lbl">{{ $vacc->nom }}</span>
  </div>
  @endforeach
</div>
@if( Auth::user()->role_id == 8)
<hr>
<div class="row"><div class="col-sm-12"><h4><u>Dérogations</u></h4></div></div>
<div class="form-group">
  <label class="col-sm-3 control-label" for="nom"><strong>Nombre de Dérogation par mois :</strong></label>
  <div class="col-sm-9">
    <input class="col-xs-12 col-sm-12"  name="derogationNbr" type="number" min="0" max="100"  />
  </div>
</div>
@endif