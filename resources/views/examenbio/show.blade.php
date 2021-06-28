@extends('app')
@section('main-content')
  <div class="row" width="100%"> 
  <?php
    if(isset($demande->id_consultation))
      $patient = $demande->consultation->patient;
    else
     $patient = $demande->visite->hospitalisation->patient;
  ?>
  @include('patient._patientInfo', $patient) </div>
  <div class="content">
    <div class="row">
      <div class="col-sm-5"><h4><strong>Détails de la demande biologique</strong></h4></div> <div class="col-sm-5"></div>
      <div class="col-sm-7">
        @if($medecin->id == Auth::user()->employ->id)
        <a href="/dbToPDF/{{ $demande->id }}" title = "Imprimer"  target="_blank" class="btn btn-sm btn-primary pull-right">
          <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
        </a>
        @endif
        <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp;precedant</a>
      </div>
    </div><div class="space-12 hidden-xs"></div>
    <div class="row">
  <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Détails de la demande :</strong></h5></div>
      <div class="widget-body">
        <div class="widget-main">
          <div class="row">
            <div class="col-xs-12">
              <div class="user-profile row">
                <div class="col-xs-12 col-sm-3 center">
                  <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                      <div class="profile-info-name">Date : </div>
                      <div class="profile-info-value"><span class="editable">
                        @if(isset($demande->consultation))
                    {{  (\Carbon\Carbon::parse($demande->consultation->Date_Consultation))->format('d/m/Y') }}
                 @else
                    {{  (\Carbon\Carbon::parse($demande->visite->date))->format('d/m/Y') }}
                  @endif 
                      </span></div>
                    </div>
                  </div>
                  <div class="profile-user-info profile-user-info-striped">
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
                    </div>
                    <div class="profile-info-row">
                      <div class="profile-info-name"> Demandeur : </div>
                      <div class="profile-info-value">
                        <span class="editable">
                              {{ $medecin->nom }} &nbsp;{{ $medecin->prenom }}
                        </span>
                      </div>
                    </div>
                  </div><!-- profile-user-info  -->
                </div>
              </div><br><!-- user-profile -->
              <div class="user-profile row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                        <th class="center"><strong>#</strong></th><th class="center"><strong>Nom Examen</strong></th><th class="center">Etat</em></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($demande->examensbios as $index => $exm)
                      <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $exm->nom_examen }}</td>
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
                      </tr>
                    @endforeach          
                    </tbody>
                  </table>
              </div>
              <div class="user-profile row">
                @if($demande->etat == "1")
                  <label>Résultat :</label>&nbsp;&nbsp;
                  <span><a href='/download/{{ $demande->resultat }}'>{{ $demande->resultat }} &nbsp;<i class="fa fa-download"></i></a></span>
                @endif
              </div> 
            </div><!-- col-xs-12 -->
          </div><!-- row -->
        </div>
      </div><!-- widget-body -->
    </div>
  </div>

@endsection