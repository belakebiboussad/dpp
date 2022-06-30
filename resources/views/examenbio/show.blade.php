 @extends('app')
@section('main-content')
 <div class="row" width="100%">  @include('patient._patientInfo', $patient) </div>
 <div class="content">
    <div class="row">
        <div class="col-sm-5"><h4><strong>Détails de la demande d'examen biologique</strong></h4></div>
        <div class="col-sm-7">
          @if( Auth::user()->role_id == 11)
            @if( $demande->etat =="En Cours" )
            <a href="/detailsdemandeexb/{{ $demande->id }}" title="attacher résultat" class="btn btn-sm btn-info pull-right">
               <i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>Attacher
            </a>
            @endif
          @endif           
          @if($medecin->id == Auth::user()->employ->id)
            <a href="/dbToPDF/{{ $demande->id }}" title = "Imprimer"  target="_blank" class="btn btn-sm btn-primary pull-right">
              <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
            </a>
            @if( $demande->etat =="En Cours" )
            <a href="{{ route('demandeexb.edit',$demande->id )}}" class="btn btn-sm btn-success pull-right">
              <i class="ace-icon fa fa-pencil"></i>Modifier
            </a>
            @endif
          @endif
          <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp;precedant</a>
        </div>
    </div>
      <div class="row">
      <div class="col-xs-12">
        <div class="widget-box">
          <div class="widget-header"><h5 class="widget-title"><strong>Détails de la demande :</strong></h5></div>
        <div class="widget-body">
          <div class="widget-main">
            <div class="user-profile row">
              <div class="col-xs-12 col-sm-5 center">
                <div class="profile-user-info profile-user-info-striped">
                  <div class="profile-info-row">
                    <div class="profile-info-name">Date : </div>
                      <div class="profile-info-value"><span class="editable">
                        @if(isset($demande->consultation))
                          {{  (\Carbon\Carbon::parse($demande->consultation->date))->format('d/m/Y') }}
                        @else
                          {{  (\Carbon\Carbon::parse($demande->visite->date))->format('d/m/Y') }}
                        @endif 
                        </span>
                      </div>
                    </div>
                    <div class="profile-info-row">
                      <div class="profile-info-name">Etat :</div>
                      <div class="profile-info-value">
                        <span class="badge badge-{{ ( $demande->getEtatID($demande->etat) == "0" ) ? 'warning':'primary' }}">{{ $demande->etat }}</span>
                      </div>
                    </div> {{-- profile-info-row --}}
                    <div class="profile-info-row">
                      <div class="profile-info-name"> Demandeur : </div>
                      <div class="profile-info-value"><span class="editable">{{ $medecin->full_name }}</span></div>
                   </div>
                </div> {{-- profile-user-info   profile-user-info-striped--}}
              </div> {{-- col-sm-5 --}}
              </div><br/>{{-- user-profile row  --}}
                <div class="user-profile row">
                 <div class="col-xs-12 col-sm-12">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="center"><strong>#</strong></th>
                        <th class="center"><strong>Nom examen</strong></th>
                        <th class="center"><strong>Classe examen</strong></th>
                        <th class="center">Etat</th>
                        <th class="center"><em class="fa fa-cog"></em></th>
                      </tr>
                    </thead>
                      <tbody>   
                       @foreach($demande->examensbios as $index => $exm)
                        <tr>
                          <td class="center">{{ $index + 1 }}</td>
                          <td>{{ $exm->nom }}</td><td>{{ $exm->specialite->nom }}</td>
                          @if($loop->first)
                          <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
                            <span class="badge badge-{{ ( $demande->getEtatID($demande->etat) == "0" ) ? 'warning':'primary' }}">
                            {{ $demande->etat }}
                            </span>
                          </td>
                          @endif
                          @if($loop->first)
                          <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
                            @switch($demande->etat)
                              @case('En Cours')
                                @break
                              @case('Validée')
                                <a href='/storage/files/{{ $demande->resultat }}' class="btn btn-info btn-md" data-toggle="tooltip" title="téléchager le résultat" data-placement="bottom" target="_blank">
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
      <div class="row"><div class="col-sm-12"><label class="">Compte rendu biologique :</label></div></div>
       <div class="row">   
            <div class="col-sm-12"><textarea class="form-control" disabled rows="4" style="resize:none">{{ $demande->crb}}</textarea></div>
         </div>
    @endif
    </div>  {{-- content --}}
  @endsection    