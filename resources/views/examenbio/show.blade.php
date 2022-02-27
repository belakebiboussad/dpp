 @extends('app')
@section('main-content')
 <div class="row" width="100%">  @include('patient._patientInfo', $patient) </div>
 <div class="content">
      <div class="row">
              <div class="col-sm-5"><h4><strong>Détails de la demande d'examen biologique</strong></h4></div>
              <div class="col-sm-7">
                @if($medecin->id == Auth::user()->employ->id)
                <a href="/dbToPDF/{{ $demande->id }}" title = "Imprimer"  target="_blank" class="btn btn-sm btn-primary pull-right">
                  <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
                </a>
                @endif
                <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp;precedant</a>
              </div>
      </div>   {{-- row --}}
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
                                                          @if($demande->etat == null)
                                                           <span class="badge badge-success">En Cours
                                                          @elseif($demande->etat == 1)
                                                           <span class="badge badge-primary">Validé  
                                                          @elseif($demande->etat == 0)
                                                           <span class="badge badge-warning">Rejeté
                                                      @endif
                                                      </span>
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
                                                        <th class="center"><strong>Nom Examen</strong></th>
                                                        <th class="center"><strong>Classe Examen</strong></th>
                                                        <th class="center">Etat</th>
                                                        <th class="center"><em class="fa fa-cog"></em></th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                     @foreach($demande->examensbios as $index => $exm)
                                                            <tr>
                                                              <td class="center">{{ $index + 1 }}</td>
                                                              <td>{{ $exm->nom }}</td>
                                                              <td>{{ $exm->Specialite->specialite }}</td>
                                                              @if($loop->first)
                                                              <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
                                                              @if($demande->etat == null)
                                                                <span class="badge badge-success">En Cours
                                                              @elseif($demande->etat == "1")
                                                                <span class="badge badge-primary">Validé       
                                                              @else
                                                                <span class="badge badge-warning">Rejeté
                                                              @endif
                                                              </span></td>
                                                              @endif
                                                              @if($loop->first)
                                                              <td rowspan ="{{ $demande->examensbios->count()}}" class="center align-middle">
                                                                @if($demande->etat == "1")
                                                                <a href='/download/{{ $demande->resultat }}' class="btn btn-info btn-md" data-toggle="tooltip" title="téléchager le résultat" data-placement="bottom">
                                                                  <i class="fa fa-download"></i></a>
                                                                  @if( isset($demande->crb))
                                                                    <a href="{{ route('crbs.download',$demande->id )}}" title="télecharger le compte rendu" class="btn btn-default btn-md" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                                                  @endif
                                                                @endif
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
      <div class="row"><div class="col-sm-6"><label class="">Compte rendu biologique :</label></div></div>
       <div class="row">   
            <div class="col-sm-11"><textarea class="form-control" disabled rows="4" style="resize:none">{{ $demande->crb}}</textarea></div>
         </div>
    @endif
    </div>  {{-- content --}}
  @endsection    