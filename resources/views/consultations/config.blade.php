  <h3 class="section-heading">Consultation</h3>  
<div class="row"><div class="col-sm-12"><h4><u>Types antecédants</u></h4></div></div>
<div class="row">
@foreach($antecTypes as $antecType)
  <div class="col-xs-2">
  @if(isset($specAntecTypes))
    <input name="antecTypes[]" type="checkbox" class="ace" value="{{ $antecType->id}}" {{ (in_array($antecType->id, $specAntecTypes))? 'checked' : '' }}/>
  @else
    <input name="antecTypes[]" type="checkbox" class="ace" value="{{ $antecType->id}}"/>
  @endif   
  <span class="lbl">{{ $antecType->nom_complet }}</span>
  </div>
@endforeach
</div><div class="space-12"></div>
<div class="row"><div class="col-sm-12"><h4><u>Appareils</u></h4></div></div>
<div class="row">
@foreach($appareils as $appar)
<div class="col-xs-2">
  @if(isset($specappreils))
   <input name="appareils[]" type="checkbox" class="ace" value="{{ $appar->id}}" {{ (in_array($appar->id, $specappreils))? 'checked' : '' }}/>
  @else
  <input name="appareils[]" type="checkbox" class="ace" value="{{ $appar->id}}"/>
  @endif
  <span class="lbl">{{ $appar->nom }}</span>
</div>
@endforeach
</div>