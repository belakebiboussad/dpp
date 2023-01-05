@if($demandesExB->count()>0)
<div class="row">
  <div class="col-sm-7">
  <div class="widget-box widget-color-green2">
    <div class="widget-header">
      <h4 class="widget-title lighter smaller"> Resultats d'examens biologiques </h4>
    </div>
    <div class="widget-body">
      <div class="widget-main padding-8">
        <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree"> 
          @foreach($demandesExB as $demande)
          @if($demande->getEtatID($demande->etat) ===1)
          <li>
            <a href="/storage/files/{{ $demande->resultat }}" title="téléchager le résultat" target="_blank"><i class="ace-icon fa fa-file-text grey" aria-hidden="true"></i>&nbsp; {{ $demande->resultat }}</a>
            @isset($res->crb)    
            <a href="{{ route('crbs.download',$demande->id )}}" title=""><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Compte rendu</a>
            @endisset
            @if(isset($demande->consultation)) 
            <span class="smaller-80">( Consultation du {{ $demande->consultation->date->format('d/m/Y') }})</span>
            @else
            <span class="smaller-80">( Visite du {{ $demande->visite->date->format('d/m/Y') }})</span>
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
  @if(null != $demandesExR->count()>0)
<div class="row">
  <div class="col-sm-7">
  <div class="widget-box widget-color-blue">
    <div class="widget-header">
      <h4 class="widget-title lighter smaller"> Resultats d'examens radiologiques </h4>
    </div>
    <div class="widget-body">
      <div class="widget-main padding-8">
        <ul id="tree2" class="tree tree-unselectable tree-folder-select" role="tree"> 
         @foreach($demandesExR as $demande)
            @foreach($demande->examensradios as $ex)
            @if($ex->getEtatID($ex->etat) ===1) 
            <li>
              <a href="/storage/files/{{ $ex->resultat }}" title="téléchager le résultat {{ $ex->Type->nom }}" target="_blank"><i class="ace-icon fa fa-file-text grey" aria-hidden="true"></i>&nbsp; {{ $ex->resultat }}</a>
              @isset($ex->crr_id) 
                <a href="{{ route('crrs.download',$ex->crr_id )}}" title="télécharger le compte rendu" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Compte rendu</a>
              @endisset   
              {{-- <span class="smaller-80">({{ $demande->consultation->date->format('d/m/Y') }})</span> --}}
              @if(isset($demande->consultation))
              <span class="smaller-80">( Consultation du {{ $demande->consultation->date->format('d/m/Y') }})</span>
              @else
              <span class="smaller-80">( Visite du {{ $demande->visite->date->format('d/m/Y') }})</span>
              @endif
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