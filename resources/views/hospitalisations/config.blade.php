 @if(Auth::user()->role_id == 14)
<div class="row"><div class="col-sm-12"><h4><u>Demandes d'hospitalisation</u></h4></div></div>
<div class="row">
  <div class="col-xs-4">
       <label><input type="checkbox" name="dhValid" class="ace" value="1" {{ isset($specialite->dhValid) ? 'checked' : '' }}/>
         <span class="lbl">&nbsp;Validation des demandes d'hospitalisation</span>
        </label> 
  </div>
</div>
@endif
@if(Auth::user()->role_id == 13)
<div class="row"><div class="col-sm-12"><h4><u>Modes d'hôspitalisations</u></h4></div></div>
<div class="row">
@foreach($modesHosp as $mode)
  <div class="col-xs-2">
      <label><input type="checkbox" name="hospModes[]" class="ace" value="{{ $mode->id}}" @if($mode->selected) checked @endif/>
    <span class="lbl">&nbsp;{{ $mode->nom }}</span></label>
  </div> 
@endforeach
</div>
@endif
