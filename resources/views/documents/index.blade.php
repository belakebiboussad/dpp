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
        <li>
          @if($demande->getEtatID() === 1)
            <a href="/storage/files/{{ $demande->resultat }}" title="téléchager le résultat" target="_blank"><i class="ace-icon fa fa-file-text grey bigger-110" aria-hidden="true" ></i>  {{ $demande->resultat }}</a>
            @isset($demande->crb)    
            <a href="{{ route('crbs.download',$demande->id )}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Compte rendu</a>
            @endisset
          @else
            <a href="#"  id="uploadBio" data-id ="{{ $demande->id }}" data-toggle="modal"  data-toggle="tooltip"  title="uploader le résultat"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i></a>
          @endif 
          <span class="smaller-80">({{ ($demande->imageable_type === 'App\modeles\visite')?'Visite':'Consultation' }} du 
                  {{ $formatDateF($demande->imageable->date) }})</span>
            </li>
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
            <li>
             @if($demande->getEtatID() === 1)
              <a href="/storage/files/{{ $ex->resultat }}" title="téléchager le résultat {{ $ex->Type->nom }}" target="_blank"><i class="ace-icon fa fa-file-text grey" aria-hidden="true"></i>&nbsp; {{ $ex->resultat }}</a>
              @isset($ex->crr_id) 
                 <a href="{{ route('crrs.download',$ex->crr_id )}}" title="télécharger le compte rendu" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Compte rendu</a>
              @endisset 
              @else
                 <a href="#"  id="uploadImg" data-id ="{{ $demande->id }}" data-toggle="modal"  data-toggle="tooltip"  title="uploader le résultat"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i></a>
              @endif
              <span class="smaller-80">({{ ($demande->imageable_type === 'App\modeles\visite')?'Visite':'Consultation' }} du 
                {{ $demande->imageable->date->format('d/m/Y') }}) </span>  
             </li>
            @endforeach
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  </div>
</div>
@endif
<div class="row">
  <div class="col-sm-7">
  <div class="widget-box widget-color-info">
        <div class="widget-header">
      <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Fichiers</h5>
      <div class="widget-toolbar widget-toolbar-light no-border">
        <a href="#uploadModal"  data-toggle="modal"  tabindex="-1"><i class="fa fa-plus-circle bigger-180"></i></a>
    
      </div>
    </div>
    <div class="widget-body">
      <div class="widget-main padding-8">
        <ul  class="tree tree-unselectable tree-folder-select" role="tree">
        </ul>
        </div>
        </div>
      </div>
    </div>
</div>
<script>
$(function(){
$("#uploadBio").click(function(){
    var url = '{{ route("bioResultAdd", ":slug") }}'; 
    url = url.replace(':slug', $(this).data('id'));
    $.get(url, function (data) {
      $('#uploadBioRes .modal-body').html(data);
      $('#uploadBioRes').modal('show');
    });
  });
$("#uploadImg").click(function(){
      var url = '{{ route("exmbio.edit", ":slug") }}'; 
      url = url.replace(':slug', $(this).data('id'));
      $.get(url, function (data) {
            $('#uploadBioRes .modal-body').html(data);
            $('#uploadBioRes').modal('show');
    });
}) ; 
}) ; 
</script>
@include('examenbio.ModalFoms.detailsModal')