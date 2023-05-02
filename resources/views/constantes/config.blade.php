@if(Auth::user()->is(14))
<div class="row"><div class="col-sm-12"><h4><u>Constantes médicaux</u></h4></div></div>
<div class="row">
@foreach($consts as $const)
<div class="col-xs-2">
  <label>
    <input type="checkbox" name="consts[]" class="ace" value="{{ $const->id}}" @if(in_array($const->id,$specialite->Consts()->pluck('id')->toArray())) checked="checked" @endif/>
    <span class="lbl">&nbsp;{{ $const->nom }}</span>
  </label>
  </div> 
@endforeach
</div>
@endif
