 @extends('app')
@section('main-content')
<div class="row">  @include('patient._patientInfo',['patient'=>$demande->imageable->patient])</div>
  <div class="content">
  <div class="page-header"><h1>Détails de la demande d'examen biologique</h1>
    <div class=" pull-right">
      @if(Auth::user()->is(11))
       <a href="{{ route('home')}}" class="btn btn-xs btn-white"><i class="fa fa-search"></i> Rechercher</a>
       @else
       <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i> precedant</a>
    @endif
    @if($demande->imageable->medecin->id == Auth::user()->employ->id)
      <a href="/dbToPDF/{{ $demande->id }}" title = "Imprimer"  target="_blank" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-print"></i> Imprimer</a>
     <a href="{{ route('demandeexb.edit',$demande->id )}}" class="btn btn-sm btn-success{!! $isInprog($demande) !!}"><i class="ace-icon fa fa-pencil"></i> Modifier</a>
      @endif
      @if( Auth::user()->is(11) )
        <a href="/detailsdemandeexb/{{ $demande->id }}" title="attacher résultat" class="btn btn-xs btn-info{!! $isInprog($demande) !!}"><i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i> Attacher</a>
      @endif
    </div>
    </div>
    </div>
      <div class="row">
      <div class="col-xs-12">
        <div class="widget-box">
          <div class="widget-header"><h5 class="widget-title">Détails de la demande</h5></div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="user-profile row">
              <div class="col-xs-12 col-sm-5 center">
                <div class="profile-user-info profile-user-info-striped">
                  <div class="profile-info-row">
                    <div class="profile-info-name">Date </div>
                      <div class="profile-info-value"><span>{{ $demande->imageable->date->format('d/m/Y') }}</span>
                      </div>
                    </div>
                    <div class="profile-info-row"><div class="profile-info-name">Etat</div>
                      <div class="profile-info-value">{!! $formatStat
($demande) !!}</div>
                    </div>
                    <div class="profile-info-row"><div class="profile-info-name">Demandeur</div>
                      <div class="profile-info-value"><span class="editable">{{ $demande->imageable->medecin->full_name }}</span></div>
                   </div>
                </div>
              </div>
              </div><br/>{{-- user-profile row  --}}
                <div class="user-profile row">
                 <div class="col-xs-12 col-sm-12">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="center">#</th><th class="center">Nom examen</th>
                        <th class="center">Classe examen</th><th class="center">Etat</th>
                        <th class="center"><em class="fa fa-cog"></em></th>
                      </tr>
                    </thead>
                      <tbody>   
                       @foreach($demande->examensbios as $index => $exm)
                        <tr>
                          <td class="center">{{ $index + 1 }}</td>
                          <td>{{ $exm->nom }}</td><td>{{ $exm->specialite->nom }}</td>
                          @if($loop->first)
                          <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">{!! $formatStat
($demande) !!}</td>
                          @endif
                          @if($loop->first)
                          <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
                            @switch($demande->etat)
                              @case('En Cours')
                                @break
                              @case('Validée')
                                 <a href="{{ route('result.download',$demande->id)}}" class="btn btn-info btn-md" data-toggle="tooltip" title="téléchager le résultat" data-placement="bottom" target="_blank">
                                <i class="fa fa-download"></i></a>
                                @if( isset($demande->crb))
                                  <a href="{{ route('crbs.download',$demande->id )}}" title="télecharger le compte rendu" class="btn btn-default btn-md" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                @endif
                                 @break
                              @case('Rejeté')
                                @break
                             @endswitch
                          </td>
                          @endif
                        </tr>
                      @endforeach          
                      </tbody>
                    </table>
                    </div> {{-- col-xs-12 col-sm-12 --}}
                </div>{{-- user-profile row  --}}
                      </div> {{-- widget-main --}}
              </div>{{-- widget-body --}}
          </div>   {{-- widget-box --}}
          </div>{{-- col-xs-12 --}}
          </div><br> {{-- row --}}
          @if($demande->crb != null)
      <div class="row"><div class="col-sm-12"><label>Compte rendu biologique :</label></div></div>
       <div class="row">   
            <div class="col-sm-12"><textarea class="form-control" disabled rows="4" style="resize:none">{{ $demande->crb}}</textarea></div>
         </div>
    @endif
    </div>  {{-- content --}}
  @stop    