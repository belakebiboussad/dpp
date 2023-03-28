 @if(Auth::user()->role_id == 14)
 <div class="row"><div class="col-sm-12"><h4><u>Constantes médicaux</u></h4></div></div>
<div class="row">
@foreach($consts as $const)
  <div class="col-xs-2">
    @if(isset($hospConsts))
    <label><input type="checkbox" name="consts[]" class="ace" value="{{ $const->id}}"  {{ (in_array($const->id, $hospConsts))? 'checked' : '' }} />
    @else
    <label><input type="checkbox" name="consts[]" class="ace" value="{{ $const->id}}" />
    @endif
    <span class="lbl">&nbsp;{{ $const->nom }}</span></label>
  </div> 
@endforeach
</div>
@endif