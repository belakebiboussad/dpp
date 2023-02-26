@if($demandesExB->count()>0)
<div class="row">
  <div class="col-sm-7">
  <div class="widget-box widget-color-green2">
    <div class="widget-header">
      <h4 class="widget-title lighter smaller">Examens biologiques </h4>
    </div>
    <div class="widget-body">
      <div class="widget-main padding-8">
        <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree"> 
          @foreach($demandesExB as $demande)
            @if($demande->getEtatID() ===1)
          <li>
            <a href="/storage/files/{{ $demande->resultat }}" title="téléchager le résultat" target="_blank"><i class="ace-icon fa fa-file-text grey" aria-hidden="true"></i>&nbsp; {{ $demande->resultat }}</a>
            @isset($res->crb)    
            <a href="{{ route('crbs.download',$demande->id )}}" title=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Compte rendu</a>
            @endisset
            @if(isset($demande->consultation))
            <small>( Consultation du {{ $demande->consultation->date->format('d/m/Y') }})</small>
            @else
            <small>( Visite du {{ $demande->visite->date->format('d/m/Y') }})</small>
            @endif
          </li>
          @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  </div>
</div>
@endif
@if($demandesExR->count() > 0)
<div class="row">
  <div class="col-sm-7">
  <div class="widget-box widget-color-blue">
    <div class="widget-header">
      <h4 class="widget-title lighter smaller">Examens radiologiques </h4>
    </div>
    <div class="widget-body">
      <div class="widget-main padding-8">
        <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree"> 
         @foreach($demandesExR as $demande)
            @foreach($demande->examensradios as $ex)
            @if($ex->getEtatID() ===1) 
            <li>
              <a href="/storage/files/{{ $ex->resultat }}" title="téléchager le résultat {{ $ex->Type->nom }}" target="_blank"><i class="ace-icon fa fa-file-text grey" aria-hidden="true"></i>&nbsp; {{ $ex->resultat }}</a>
              @isset($ex->crr_id) 
                &nbsp;&nbsp;<a href="{{ route('crrs.download',$ex->crr_id )}}" title="télécharger le compte rendu" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Compte rendu</a>
              @endisset 
              <span class="smaller-80">({{ ($demande->imageable_type === 'App\modeles\visite')?'Visite':'Consultation' }} du 
                {{ $demande->imageable->date->format('d/m/Y') }}) </span>  
             </li>
             @endif
            @endforeach
          @endforeach
        </ul><!-- / -->
      </div>
    </div>
  </div>
  </div>
</div>
@endif
 @if($ordonnances->count() > 0)
<div class="row">
  <div class="col-sm-7">
  <div class="widget-box widget-color-pink">
    <div class="widget-header"><h4 class="widget-title lighter">Ordonnances</h4></div>
    <div class="widget-body">
      <div class="widget-main padding-8">
        <ul  class="tree tree-unselectable tree-folder-select" role="tree">
         @foreach($ordonnances as $ord)
         <li>
            <a href="{{ route('ordonnancePdf',$ord->id ) }}" title="télécharger l'Ordonnance" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Ordonnance</a>
            <span class="smaller-80">
            ( Consultation du {{ $ord->consultation->date->format('d/m/Y') }})
            </span>
         </li>
         @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endif