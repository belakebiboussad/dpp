<div class="row"><div class="col-sm-12"><h4><u>Constantes médicaux</u></h4></div></div>
<div class="row">
  @foreach($consts as $const)
  <div class="col-xs-2">
  @if(isset($hospConsts))
    <input name="hospConsts[]" type="checkbox" class="ace" value="{{ $const->id}}" {{ (in_array($const->id, $hospConsts))? 'checked' : '' }}/>
  @else
    <input name="hospConsts[]" type="checkbox" class="ace" value="{{ $const->id}}"/>
  @endif
   <span class="lbl">{{ $const->nom }}</span>
   </div>
   @endforeach

</div>