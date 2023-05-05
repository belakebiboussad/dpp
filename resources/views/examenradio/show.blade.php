@extends('app')
@section('page-script')
<script>
$(function(){
  $('body').on('click', '.obsShow', function (e) {
    Swal.fire($(this).val());
  });
})
</script>
@stop
@section('main-content')
<div class="container-fluid">
  <div class="page-header"> @include('patient._patientInfo')</div>
  <div class="row">
  <div class="col-sm-12">
    <h1>Détails de la demande d'examens radiologiques</h1>
    <div class="pull-right"> 
    @if(Auth::user()->is(12))
       <a href="{{ route('home')}}" class="btn btn-xs btn-white"><i class="fa fa-search"></i> Rechercher</a>
       @else
       <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning"><i class="ace-icon fa fa-backward"></i> precedant</a>
    @endif
      @if((!$demande->hasResult()) && (( $demande->imageable->medecin->id == Auth::user()->employ->id)))
       <a href="{{ route('demandeexr.edit',$demande->id )}}" class="btn btn-xs btn-success"><i class="ace-icon fa fa-pencil"></i> Modifier</a>
       @endif
        @if( Auth::user()->is(12) )
         <a href="/details_exr/{{ $demande->id }}" class="btn btn-xs btn-info  {!! $isInprog($demande) !!}"> <i class="glyphicon glyphicon-upload glyphicon glyphicon-white" title="attacher résultat"></i>Attacher</a>
      @endif
       <a href="/drToPDF/{{ $demande->id }}" target="_blank" class="btn btn-xs btn-success"><i class="ace-icon fa fa-print"></i> Imprimer</a>
    </div>
    </div>
  </div><hr>
  <div class="row ">
    <div class="col-sm-7">
       @include('examenradio.partials._show')<div class="space-12"></div>
      <div class="row"> 
        <div class="col-sm-12">
        <div class="tabpanel">  
          <ul class = "nav nav-pills nav-justified list-group" role="tablist">
            <li class="active" role= "presentation">
              <a href="#exams" role="tab" data-toggle="tab"><i class="fa fa-image" aria-hidden="true"></i> Examens Radilogique
            </a></li>
            @if($demande->hasCCR())
            <li  role="presentation">
              <a href="#crr" role="tab" data-toggle="tab"><i class="fa fa-file" aria-hidden="true"></i> Compte rendu radiologique
              </a>
            </li>
            @endif
          </ul>
          <div class="tab-content no-border">
            <div class="tab-pane in active" id="exams">
                <div class="widget-box widget-color-blue">
                  <div class="widget-header">
                    <h5 class="widget-title lighter pull-left"><i class="ace-icon fa fa-table"></i>Examens radiologique demandés</h5>
                  </div>
                  <div class="widget-body"> 
                    <div class="widget-main">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th class="center" width="5%">N°</th><th class="center" width="30%">Nom</th>
                            <th class="center" width="7%">Type</th><th class="center" width="7%">Etat</th><th class="center" width="20%"><em class="fa fa-cog"></em></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($demande->examensradios as $index => $ex)
                        <tr id = "{{ $ex->id }}">
                          <td class="center" width="5%">{{ $index +1}}</td><td>{{ $ex->Examen->nom }}</td>
                          <td>{{ $ex->Type->nom }}</td><td>{!! $formatStat
($ex) !!}</td>
                          <td class="center" width="20%">
                            @switch($ex->etat)
                              @case('En Cours')
                                @break
                              @case('Validé')
                                @if((pathinfo($ex->resultat, PATHINFO_EXTENSION) == 'dcm')||(pathinfo($ex->resultat, PATHINFO_EXTENSION) == ""))
                                <button type="button" class="btn btn-info btn-xs dicom_viewer" value="{{ $ex->resultat }}" title="Voir le résultat">
                                  <i class="ace-icon fa fa-eye-slash"></i></button>
                                @endif
                                <a href='/storage/files/{{ $ex->resultat }}' class="btn btn-success btn-xs" target="_blank"><i class="fa fa-download"></i></a>
                                @break
                              @case('Rejeté')
                                <a href="#" class="btn btn-xs show-details-btn green" title="Afficher Details" data-toggle="collapse" id="{{ $index }}" data-target=".{{$index}}collapsed" ><i class="fa fa-eye-slash" aria-hidden="true"></i><span class="sr-only">Details</span>  
                                </a>
                                @break
                            @endswitch
                            @isset($ex->Crr) 
                              <a href="{{ route('crrs.download',$ex->crr_id )}}" title="télécharger le compte rendu" class="btn btn-default btn-xs" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                            @endisset 
                          </td>
                        </tr>
                        @if($ex->etat == "0")
                        <tr class="collapse out budgets {{$index}}collapsed">
                          <td colspan="12">
                            <div class="table-detail"><div class="row">
                              <div class="col-xs-6 col-sm-6">
                                <div class="space visible-xs"></div>
                                <div class="profile-user-info profile-user-info-striped">
                                  <div class="profile-info-row">
                                    <div class="profile-info-name text-center"><b>Observation:</b></div>
                                    <div class="profile-info-value"> <span>{{ $ex->observation }} </span></div>
                                  </div>
                                </div>
                              </div>
                            </div></div>
                          </td>
                        @endif
                        @endforeach
                        </tbody>
                      </table>
                    </div>{{-- widget-maint --}}
                  </div>{{-- widget-body --}}
                </div>{{-- widget-box --}}
            </div>{{-- exams --}}
            @if($demande->hasCCR())
            <div class="tab-pane" id="crr">
              <div class="row"><div class="col-sm-12"><label class="">Compte rendu radiologique :</label></div></div>
              <div class="row">
                <div class="col-sm-12">
                  <textarea class="col-sm-12" disabled rows ="12" style="resize:none">
                    @foreach($demande->examensradios as $index => $examen)
                      @isset($examen->crr_id)
                        {!! $examen->Crr->conclusion !!}
                      @endisset
                    @endforeach
                  </textarea>
                </div>
            </div>
          </div><!-- tab-pane -->
          @endif
          </div> {{-- tabpanel --}}
        </div>{{-- col-sm-12 --}}
        </div> 
      </div><!-- row -->
    </div><!-- col-lg-7 -->
    <div class="col-sm-5 container" id="dicom"  hidden="true">@include('DICOM.show')</div>
  </div><!-- row no-gutters -->
</div><!-- container-fluid -->
@stop